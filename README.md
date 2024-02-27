# Processo Seletivo Mentes Notaveis

Api em PHP puro.

## Pré-requisitos

Certifique-se de ter os seguintes itens instalados em sua máquina:

- Docker: [https://www.docker.com/get-started](https://www.docker.com/get-started)
- Docker Compose: [https://docs.docker.com/compose/install/](https://docs.docker.com/compose/install/)

## Setup do Ambiente de Desenvolvimento

1. Clone o repositório:

    ```bash
    git clone https://github.com/thiagormoreira/mn-php-api.git
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd mn-php-api
    ```

3. Inicie os contêineres Docker. O comando roda tambem uma importação para o banco de dados.

    ```bash
    docker-compose up -d
    ```
   
4. Instale as dependências do projeto:

    ```bash
    docker-compose exec php composer install
    ```

5. Rodar testes PHPUnit

    ```bash
    ./vendor/bin/phpunit
    ```

6. Abra o navegador e acesse [http://localhost](http://localhost) para visualizar seu aplicativo.

## Comandos Úteis

- Iniciar o ambiente de desenvolvimento:

    ```bash
    docker-compose up -d
    ```

- Parar o ambiente de desenvolvimento:

    ```bash
    docker-compose down
    ```