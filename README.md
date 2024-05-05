
# Agendamento de consultas

Projeto MVC para agendamento de consultas para avaliação de conhecimentos em PHP.

## Stack utilizada

**Front-end:** Blade, Bootstrap-5

**Back-end:** Laravel 11.5


# Agendamento de consultas

Projeto MVC para agendamento de consultas para avaliação de conhecimentos em PHP.

## Execução

Para fazer o executar o projeto, primeiramente deve ajustar o arquivo .env para as credenciais do banco de dados.

Depois disso, deve se rodar o seguinte comando na raiz do projeto para instalar as dependências necessárias:

```bash
composer install
```
Depois de instaladas as dependências é necessário executar os seguintes comandos para executar as migrations e fazer o seed de dados no banco:
```bash
php artisan migrate
```

```bash
php artisan db:seed
```
Após realizados esses procedimentos, a aplicação está pronta para execução e para iniciar, deve se rodar o seguinte comando:

```bash
php artisan serve
```

A aplicação estará disponível em http://localhost:8000/.
## Autor

- [Dagnei Filho](https://github.com/dagneifilho/)

