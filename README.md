# Blog Management System

Sistema de gerenciamento de blog desenvolvido com CodeIgniter 4, Eloquent ORM e Bootstrap.

## Tecnologias Utilizadas

- **PHP 8.1+** - Linguagem de programação
- **CodeIgniter 4** - Framework PHP
- **Eloquent ORM** - ORM do Laravel para CodeIgniter
- **Bootstrap 5** - Framework CSS
- **jQuery** - Biblioteca JavaScript
- **MySQL** - Banco de dados
- **Git** - Controle de versão

## Funcionalidades

### Área Administrativa
- Login de administrador
- CRUD completo de posts
- Upload de imagens
- Editor HTML para descrição
- Interface responsiva

### Blog Público
- Listagem de posts
- Busca por título/conteúdo
- Visualização detalhada de posts
- Design responsivo
- Modo escuro/claro

### Sistema de Usuários
- Registro e login de usuários
- Autenticação separada para admin
- Gerenciamento de sessões

## Instalação

### Pré-requisitos
- PHP 8.1 ou superior
- Composer
- MySQL/MariaDB
- Git

### Passos de Instalação

1. **Clonar o repositório**
```bash
git clone https://github.com/leandrosuza/web-developer-junior.git
cd web-developer-junior
```

2. **Instalar dependências**
```bash
composer install
```

3. **Configurar banco de dados**
```bash
# Criar banco de dados
mysql -u root -p
CREATE DATABASE blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# Importar estrutura
mysql -u root -p blog < docs/db/blog.sql
```

4. **Configurar arquivos**
Editar `app/Config/Database.php`:
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => 'sua_senha', // se necessário
'database' => 'blog',
```

Editar `app/Config/Eloquent.php`:
```php
'host'      => 'localhost',
'username'  => 'root',
'password'  => 'sua_senha', // se necessário
'database'  => 'blog',
```

5. **Criar diretórios necessários**
```bash
mkdir writable/cache
mkdir writable/logs
mkdir writable/session
mkdir public/uploads/posts
```

6. **Executar o projeto**
```bash
php spark serve
```

### Acessos

- **Blog Público**: http://localhost:8080/blog
- **Admin**: http://localhost:8080/admin
- **Login Admin**: admin@gmail.com / admin123
- **Login Usuário**: user@gmail.com / user123

## Estrutura do Projeto

```
web-developer-junior/
├── app/
│   ├── Controllers/
│   │   ├── Admin/          # Controllers administrativos (Auth, Post)
│   │   └── Blog/           # Controllers do blog público
│   ├── Models/             # Modelos Eloquent (User, Post)
│   ├── Views/              # Templates
│   │   ├── admin/          # Views do painel administrativo
│   │   ├── auth/           # Views de autenticação
│   │   ├── blog/           # Views do blog público
│   │   └── errors/         # Páginas de erro
│   └── Config/             # Configurações da aplicação
├── public/                 # Arquivos públicos
│   ├── assets/
│   │   ├── css/            # Folhas de estilo
│   │   ├── js/             # Arquivos JavaScript
│   │   └── uploads/        # Arquivos enviados pelos usuários
├── docs/                   # Documentação
│   └── db/                 # Arquivos do banco de dados
├── tests/                  # Testes automatizados
├── vendor/                 # Dependências do Composer
├── writable/               # Diretórios graváveis
│   ├── cache/              # Cache da aplicação
│   ├── logs/               # Logs do sistema
│   ├── session/            # Sessões dos usuários
│   └── uploads/            # Uploads do sistema
├── composer.json           # Dependências PHP
├── composer.lock           # Versões travadas
├── spark                   # CLI do CodeIgniter
└── README.md               # Este arquivo
```

## Banco de Dados

### Tabelas Principais

**Users**
- id, name, email, password, role, status, timestamps

**Posts**
- id, title, description, image, user_id, timestamps

### Arquivos do Banco
- `docs/db/blog.sql` - Script completo do banco
- `docs/db/diagrama_workbench.sql` - Diagrama do Workbench
- `docs/db/diagrama_png.png` - Imagem do diagrama

## Rotas Principais

### Públicas
- `/` - Página inicial
- `/blog` - Listagem de posts
- `/blog/details/{id}` - Detalhes do post

### Administrativas
- `/admin` - Login admin
- `/admin/posts` - Gerenciar posts
- `/admin/posts/blogManager` - Criar/editar posts

### Usuários
- `/auth/users` - Login usuário
- `/auth/register` - Registro

## Desenvolvimento

### Branch Strategy
- `main` - Código estável
- `development` - Desenvolvimento ativo

### Comandos Úteis
```bash
# Regenerar autoloader
composer dump-autoload

# Verificar dependências
composer outdated

# Validar composer.json
composer validate
```

## Solução de Problemas

### Erro: "Could not open input file: spark"
```bash
# Verificar se está no diretório correto
pwd
cd web-developer-junior
```

### Erro: "Class Config\Eloquent not found"
```bash
composer dump-autoload
```

### Erro: "Cache unable to write"
```bash
mkdir writable/cache
```

### Erro: "Database connection failed"
- Verificar se MySQL está rodando
- Verificar credenciais em `app/Config/Database.php`
- Verificar se banco 'blog' existe

### Páginas carregam lentamente
- Cache já está configurado como 'dummy' para desenvolvimento
- Debug toolbar desabilitado para performance

## Avaliação Técnica

### Atividade 1 - Gerenciador de Posts ✅
- [x] Sistema de login implementado
- [x] CRUD completo de posts
- [x] Upload de imagens
- [x] Editor HTML para descrição
- [x] Projeto monolítico (sem separação front/back)

### Atividade 2 - Blog Público ✅
- [x] Listagem de posts
- [x] Campo de busca
- [x] Tela de detalhes do post
- [x] Interface responsiva

### Extras Implementados
- [x] Sistema de usuários
- [x] Autenticação separada admin/usuário
- [x] Design moderno com Bootstrap
- [x] Modo escuro/claro
- [x] Busca avançada
- [x] Upload de imagens
- [x] Validações de formulário
- [x] Tratamento de erros
- [x] Código organizado com namespaces
- [x] Relacionamentos Eloquent
- [x] Documentação completa

## Contato

Para dúvidas sobre a implementação, entre em contato através do repositório.

## Licença

MIT License
