<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta de CEP - PHP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Consulta de CEP (PHP)</h3>

                    <!-- FORMULÁRIO -->
                    <form method="GET">
                        <div class="mb-3">
                            <label class="form-label">Digite o CEP</label>
                            <input type="text" name="cep" class="form-control" placeholder="Ex: 01001000" maxlength="8" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Consultar
                        </button>
                    </form>

                    <?php
                    if (isset($_GET['cep'])) {
                        $cep = str_replace("-", "", $_GET['cep']);
                        $url = "https://viacep.com.br/ws/$cep/json/";
                        $response = file_get_contents($url);
                        $data = json_decode($response, true);
                        if (!isset($data['erro'])) {
                    ?>

                    <hr>

                    <h5>Resultado:</h5>

                    <p><strong>Rua:</strong> <?= $data['logradouro'] ?></p>
                    <p><strong>Bairro:</strong> <?= $data['bairro'] ?></p>
                    <p><strong>Cidade:</strong> <?= $data['localidade'] ?></p>
                    <p><strong>UF:</strong> <?= $data['uf'] ?></p>

                    <?php
                        } else {
                            echo "<div class='alert alert-danger mt-3'>CEP não encontrado</div>";
                        }
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>