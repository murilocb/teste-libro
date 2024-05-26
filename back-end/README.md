# Projeto Laravel com Docker

Este é um projeto básico em Laravel configurado para rodar com Docker. Ele inclui um ambiente Docker pré-configurado e instruções sobre como executar o projeto, realizar migrações de banco de dados, entre outras operações comuns.

## Requisitos

Certifique-se de ter os seguintes requisitos instalados em sua máquina local:

- Docker
- Docker Compose

## Configuração

1. Navegue até o diretório do projeto:

    ```bash
    cd seu-projeto
    ```

2. Copie o arquivo de exemplo `.env` e ajuste conforme necessário:

    ```bash
    cp .env.example .env
    ```

3. Instale as dependências do Laravel via Composer:

    ```bash
    composer install
    ```

## Executando o Projeto

Para iniciar o ambiente Docker e executar o projeto Laravel, siga estas etapas:

1. Construa os contêiner Docker:

    ```bash
    docker-compose up -d
    ```

2. Execute as migrações do banco de dados para criar as tabelas necessárias:

    ```bash
    php artisan migrate
    ```

3. Para rodar o projeto. 
    ```bash
    php artisan serve
    ```
