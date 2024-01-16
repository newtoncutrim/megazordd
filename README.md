# API de Gerenciamento de Fotos e Usuários
## Template vue
![Texto Alternativo]()


![Texto Alternativo]()
## Introdução

A API é projetada para oferecer funcionalidades de gerenciamento de tarefas e usuários. Ela permite que os usuários realizem operações básicas em tarefas, como, ver, atualizar e excluir (CRUD), bem como operações semelhantes em usuários. Além disso, a API oferece autenticação JWT para proteger as rotas e recursos.

## Rotas da API Tarefas

Aqui estão exemplos de como fazer solicitações para cada rota da API:

- **GET /api/tasks**:
  - Para obter uma lista de fotos, faça uma solicitação GET para `/api/tasks`.

- **GET /api/tasks/{id}**:
  - Para obter uma foto específica com base no ID, faça uma solicitação GET para `/api/tasks/{id}`, onde `{id}` é o ID da foto desejada.

- **POST /api/tasks**:
  - Para fazer upload de uma nova foto, faça uma solicitação POST para `/api/tasks` e forneça os dados da foto no corpo da solicitação. 

- **put /api/tasks/{id}**:
  - Para atualizar uma foto existente, faça uma solicitação PUT para `/api/tasks/{id}` e forneça os dados atualizados no corpo da solicitação.

- **DELETE /api/tasks/{id}**:
  - Para excluir uma foto, faça uma solicitação DELETE para `/api/tasks/{id}`, onde `{id}` é o ID da foto a ser excluído.

O mesmo padrão de solicitações se aplica às rotas de usuário.

## API de Usuários


### Obter Usuários (GET)
- **URL:** `http://localhost:8989/api/users`
- **Método:** GET
- **Descrição:** Obtém informações dos usuários no sistema.

### Autenticar Usuário para Obter Token JWT (POST)
- **URL:** `http://localhost:8989/api/auth/login`
- **Método:** POST
- **Descrição:** Gera um token JWT para autenticar um usuário. Credenciais (nome de usuário e senha) são enviadas para obter o token.

### Criar Novo Usuário (POST)
- **URL:** `http://localhost:8989/api/users`
- **Método:** POST
- **Descrição:** Cria um novo usuário no sistema. Dados do usuário, como nome, email e senha, são enviados.

### Atualizar Usuário (PUT)
- **URL:** `http://localhost:8989/api/users/3`
- **Método:** PUT
- **Descrição:** Atualiza as informações de um usuário específico identificado pelo ID 3. Novos dados do usuário são enviados.

### Excluir Usuário (DELETE)
- **URL:** `http://localhost:8989/api/users/3`
- **Método:** DELETE
- **Descrição:** Remove um usuário específico identificado pelo ID 3 do sistema.


## Autenticação JWT

A autenticação JWT (JSON Web Token) é usada para proteger as rotas da API. Para obter um token JWT, os usuários devem fazer uma solicitação POST para `/api/auth/login` com as credenciais (email e senha). Um token JWT será gerado e retornado na resposta. Esse token deve ser incluído nos cabeçalhos de autorização das solicitações subsequentes para acessar as rotas protegidas.

## Configuração e Requisitos
- Docker instalado
- Linux https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04
- Windows https://docs.docker.com/desktop/install/windows-install/

## Instruções de Execução

Para configurar e executar o aplicativo em um ambiente local:

1. Clone o repositório.
```
git clone https://github.com/newtoncutrim/TaskHub.git
cd TaskHub
```
2. Execute os seguintes comandos para configurar o ambiente:
```
docker compose up -d --build
docker compose exec app composer install
docker compose exec app cp .env.example .env
docker compose exec app php artisan key:generate
```
3. Configure o arquivo `.env` com as seguintes configurações para o ambiente de desenvolvimento:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

```
4. Para rodar as migrações de banco de dados
```
docker compose exec app php artisan migrate

```

## Exemplos
link do projeto http://localhost:8989/

## Licença

Este aplicativo/API é disponibilizado sob a licença MIT.


## Contato

- E-mail: newtonplay007@gmail.com
- Telefone: (98) 984212805
