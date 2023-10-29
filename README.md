1. **Clone o repositório**
   Primeiro, você precisa clonar o repositório usando o seguinte comando:

    git clone https://github.com/MarcusAbagnale/Desafio-Laravel-BackEnd


2. **Navegue até o diretório clonado**
    Em seguida, navegue até o diretório que acabou de clonar usando o comando:

    cd Desafio-Laravel-BackEnd


3. **Execute o Docker**
    Agora, você pode iniciar os serviços do Docker com os seguintes comandos:

   docker build -t desafio-b .
   docker-compose up -d


5. **Execute as migrações do Laravel**
    Com os serviços do Docker em execução, você pode executar as migrações do Laravel com este comando:

    docker exec -it desafio-b php artisan migrate


6. **Crie um usuário**
    Em seguida, crie um novo usuário executando o seguinte comando:

    docker exec -it desafio-b php artisan user:create


7. **Obtenha o token**
    Finalmente, você pode obter o token enviando uma solicitação POST com as seguintes informações para a API:

 ```json
 {
     "email": "marcus@marcus.com",
     "password": "manaus"
 }
 ```

7. **Exibição da imagem**
    Execute docker exec -it desafio-b php artisan storage:link para exibir corretamente a imagem do produto cadastrado.


