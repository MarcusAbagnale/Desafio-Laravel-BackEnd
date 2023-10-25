# Desafio-Laravel-BackEnd
Desafio de desenvolvimento do Backend em Laravel
# Projeto Laravel com Docker

Este repositório contém um projeto Laravel configurado para ser executado em um ambiente Docker. Você também encontrará um backup do banco de dados para restaurar os dados.

## Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas em sua máquina:

- Docker: [Instalação do Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Instalação do Docker Compose](https://docs.docker.com/compose/install/)

## Executando o Projeto

Siga os passos abaixo para executar o projeto em seu ambiente local:

```bash
# Clone o repositório
git clone <URL_DO_REPOSITÓRIO>

# Navegue até o diretório do projeto
cd meu-projeto-laravel-docker

# Construa e inicie os contêineres Docker
docker-compose up -d

# Instale as dependências do Laravel usando o Composer
docker-compose exec app composer install

# Copie o arquivo de ambiente .env
docker-compose exec app cp .env.example .env

# Gere uma chave de criptografia do Laravel
docker-compose exec app php artisan key:generate

# Execute as migrações do banco de dados
docker-compose exec app php artisan migrate
