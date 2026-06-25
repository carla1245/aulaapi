<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Integração de Sistemas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
    function mostrarCep() {
        document.getElementById("cepBox").style.display = "block";
        document.getElementById("pythonBox").style.display = "none";
    }
    function mostrarPython() {
        document.getElementById("pythonBox").style.display = "block";
        document.getElementById("cepBox").style.display = "none";
    }
       window.onload = function () {
        const acao = new URLSearchParams(window.location.search).get("acao");
        if (acao === "cep") {
            mostrarCep();        
        }
        if (acao === "python") {
            mostrarPython();
        }
    }
</script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">
                        Integração PHP + Python + API CEP
                    </h3>

                    <!-- BOTÕES -->
                    <div class="d-flex gap-2 mb-4">
                        <button onclick="mostrarCep()" class="btn btn-success w-50">
                            Consultar CEP (PHP)
                        </button>

                        <button onclick="mostrarPython()" class="btn btn-primary w-50">
                            Consumir API Python
                        </button>
                    </div>
                    <hr>
                    <!-- ================= CEP ================= -->
                    <div id="cepBox" style="display:none;">
                        <form method="GET">
                            <input type="hidden" name="acao" value="cep">
                            <label class="form-label">Digite o CEP</label>
                            <input type="text" name="cep" class="form-control mb-2" placeholder="Ex: 01001000">
                            <button class="btn btn-success w-100">
                                Buscar CEP
                            </button>
                        </form>
                        <br>
                        <?php
                        if (isset($_GET['acao']) && $_GET['acao'] == 'cep') {
                            $cep = str_replace("-", "", $_GET['cep']);
                            $url = "https://viacep.com.br/ws/$cep/json/";
                            $response = file_get_contents($url);
                            $data = json_decode($response, true);
                            if (!isset($data['erro'])) {
                                echo "<h5>Resultado:</h5>";
                                echo "<p><strong>Rua:</strong> {$data['logradouro']}</p>";
                                echo "<p><strong>Bairro:</strong> {$data['bairro']}</p>";
                                echo "<p><strong>Cidade:</strong> {$data['localidade']}</p>";
                                echo "<p><strong>UF:</strong> {$data['uf']}</p>";
                            } else {
                                echo "<div class='alert alert-danger'>CEP não encontrado</div>";
                            }
                        }
                        ?>

                    </div>

                    <!-- ================= PYTHON ================= -->
                    <div id="pythonBox" style="display:none;">

                        <?php
                        if (isset($_GET['acao']) && $_GET['acao'] == 'python') {

                            $url = "http://127.0.0.1:5000/produto";

                            $response = file_get_contents($url);
                            $data = json_decode($response, true);

                            echo "<h5>API Python:</h5>";
                            echo "<p><strong>Produto:</strong> {$data['nome']}</p>";
                            echo "<p><strong>Preço:</strong> R$ {$data['preco']}</p>";
                        }
                        ?>

                        <form method="GET">
                            <input type="hidden" name="acao" value="python">
                            <button class="btn btn-primary w-100">
                                Carregar API Python
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
