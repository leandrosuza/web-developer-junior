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

---

## 🛠️ Technologies Used

### **Backend:**
- **PHP 8.2+** - Modern PHP with type hints and features
- **CodeIgniter 4.6.2** - Latest stable version with enhanced features
- **Eloquent ORM** - Laravel's Eloquent for CodeIgniter 4
- **MySQL/MariaDB** - Reliable database system

### **Frontend:**
- **Bootstrap 5.3** - Modern CSS framework with responsive design
- **jQuery 3.6** - DOM manipulation and AJAX requests
- **Font Awesome 6.4** - Professional icon library
- **Owl Carousel 2.3.4** - Smooth carousel functionality

### **Development Tools:**
- **Composer** - PHP dependency management
- **Git** - Version control
- **PSR-4** - Autoloading standard

---

## 🚀 Features

### 👨‍💻 **Admin Panel**
- **Secure Authentication** - Admin login with session management
- **Complete CRUD Operations** - Create, read, update, delete posts with image upload
- **Modern Interface** - Responsive dashboard with Bootstrap 5 and animations
- **Real-time Interactions** - AJAX-powered modals for seamless operations
- **Post Management** - Title, image, HTML description with preview
- **Security Features:**
  - Authentication and session validation on all admin routes
  - Protection against unauthorized access
  - Invalid session destruction
  - Secure redirection to login

### 🌐 **Public Blog**
- **Post Listing** - Responsive grid with search and filtering
- **Post Details** - Full article view with sidebar highlights
- **Dark Mode** - Toggle between light and dark themes
- **Modern Design** - Clean, professional interface
- **Mobile Responsive** - Optimized for all devices
- **Search & Filter** - Find posts by title, content, or date

### 🔐 **User Authentication**
- **Dual System** - Separate admin and user authentication
- **Registration** - User signup with validation
- **Login/Logout** - Secure session management
- **Remember Me** - Persistent login functionality

### 🎨 **UI/UX Features**
- **Responsive Design** - Works on desktop, tablet, and mobile
- **Dark/Light Mode** - User preference toggle
- **Smooth Animations** - CSS transitions and micro-interactions
- **Loading States** - Visual feedback for user actions
- **Error Handling** - User-friendly error messages

---

## 🚀 Quick Installation Guide

### 📋 Prerequisites
- **PHP 8.2+** installed
- **MySQL/MariaDB** running
- **Composer** installed
- **Git** installed

### ⚡ Quick Start 

1. **Clone the repository**
   ```bash
   git clone [repository-url]
   cd web-developer-junior
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Configure database**
   - Rename the env file to .env and remove # from lines if present (e.g., #app.baseURL → app.baseURL)
   - Update database settings in `.env`:
   ```ini
   app.baseURL = 'http://localhost:8080/'
   database.default.hostname = localhost
   database.default.database = blog
   database.default.username = root
   database.default.password = your_password
   database.default.DBDriver = MySQLi
   ```

4. **Import database**
   - Open MySQL/phpMyAdmin
   - Import `docs/db/blog.sql` to create tables and sample data

5. **Start the server**
   ```bash
   php spark serve
   ```

6. **Access the application**
   - 🌐 **Public Blog:** http://localhost:8080/blog
   - 👨‍💻 **Admin Panel:** http://localhost:8080/admin

### 🔑 Default Login Credentials

**Admin Access:**
- Email: `admin@gmail.com`
- Password: `admin123`

**User Access:**
- Email: `user@gmail.com`
- Password: `user123`

### 📁 Directory Structure (Auto-created)
The following directories are automatically included when you clone the repository:
- ✅ `writable/cache` - System cache
- ✅ `writable/logs` - Application logs  
- ✅ `writable/session` - Session data
- ✅ `public/uploads/posts` - Post images

> **Note:** No need to create these directories manually - they come with the project!

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
