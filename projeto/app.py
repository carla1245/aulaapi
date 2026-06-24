from flask import Flask, render_template, request
import requests

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def index():
    endereco = {}
    if request.method == 'POST':
        cep = request.form['cep']
        endereco = requests.get(
            f'https://viacep.com.br/ws/{cep}/json/'
        ).json()

    return render_template('ceppython.html', endereco=endereco)
app.run(debug=True)

#instalar  flask e o request(pip install requests)
#executar o flask python app.py