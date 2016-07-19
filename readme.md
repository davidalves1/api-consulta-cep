# IntegraCep API

API para consulta de CEP na base de dados dos Correios.

## Requisitos

[Composer](https://getcomposer.org/doc/00-intro.md)

## Instalação

- Clonar o repositório com o comando: `$ git clone https://github.com/davidalves1/api-consulta-cep.git 'nome_da_pasta'` :)
- Executar o comando: `$ composer install`

## Utilização

- Para rodar a API localmente execute o comando: `$ php -S localhost:8000 -t public/`

- O endereço para consulta do CEP, com a API rodando localmente, é: `http://localhost:8000/api/v1/{cep}`

- Substitua o {cep} pelo número do CEP que queira consultar. Por exemplo: `http://localhost:8000/api/v1/29730000` ou `http://localhost:8000/api/v1/29730-000`

- Se realizou a consulta corretamente, a API irá retornar um JSON, como por exemplo:

```json
{
    "bairro": "",
    "cep": "29730000",
    "cidade": "Baixo Guandu",
    "complemento": "",
    "complemento2": "",
    "end": "",
    "id": 0,
    "uf": "ES"
}
```

- Se ocorrer algum erro na consulta, a API retorna um JSON com o erro, como por exemplo:

```json
{
    "error": "O CEP informado é inválido"
}
```

## Observações

- Este projeto já possui o arquivo .htaccess na raiz, que realiza o redirecionamento para a pasta '/public' ao hospedar a API na WEB

- Ao hospedar esta API na WEB, é necessário alterar o caminho da aplicação em bootstrap/app.php acrescentando após '/../' o caminho para a pasta de sua aplicação. Por exemplo, sua aplicação está na pasta 'public_html' no seu servidor, então o arquivo ficará assim:

```php
$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../public_html/')
);
```

### Exemplo

[http://cep.integrapp.mobi/api/v1/29730000](http://cep.integrapp.mobi/api/v1/29730000)

### Contribuições

Crie uma [issue](https://github.com/davidalves1/clima-app/issues/new) ou envie um **pull request** e nos ajude a melhorar o projeto, toda contribuição é muito bem vinda!

### Licença

ISC © David Alves de Souza
