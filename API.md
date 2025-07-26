# 🚀 TechBlog API Documentation

## 📋 Visão Geral

O TechBlog é uma aplicação de blog moderna construída com CodeIgniter 4 e Eloquent ORM.

## 🏗️ Arquitetura

### Estrutura de Controllers
```
app/Controllers/
├── Admin/
│   ├── AuthController.php    # Autenticação administrativa
│   └── PostController.php    # Gerenciamento de posts
├── Blog/
│   └── BlogController.php    # Interface pública do blog
└── BaseController.php        # Controller base
```

### Models
```
app/Models/
├── User.php                  # Model de usuários
└── Post.php                  # Model de posts
```

## 🔗 Rotas da API

### Public Routes
| Method | Route | Controller | Description |
|--------|------|------------|-----------|
| GET | `/` | Blog\BlogController::index | Página inicial (redireciona para /blog) |
| GET | `/blog` | Blog\BlogController::index | Lista de posts |
| GET | `/blog/details/{id}` | Blog\BlogController::details | Detalhes do post |

### Authentication Routes
| Method | Route | Controller | Description |
|--------|------|------------|-----------|
| GET | `/admin` | Admin\AuthController::loginForm | Formulário de login admin |
| POST | `/admin` | Admin\AuthController::login | Login admin |
| GET | `/logout` | Admin\AuthController::logout | Logout admin |
| GET | `/auth/users` | Admin\AuthController::userAuthForm | Formulário de autenticação usuário |
| POST | `/auth/login` | Admin\AuthController::userLogin | Login usuário |
| POST | `/auth/register` | Admin\AuthController::userRegister | Registro usuário |
| GET | `/auth/logout` | Admin\AuthController::userLogout | Logout usuário |

### Administrative Routes
| Method | Route | Controller | Description |
|--------|------|------------|-----------|
| GET | `/admin/posts` | Admin\PostController::index | Lista de posts (admin) |
| GET | `/admin/posts/blogManager` | Admin\PostController::create | Criar novo post |
| POST | `/admin/posts/store` | Admin\PostController::store | Salvar novo post |
| GET | `/admin/posts/edit/{id}` | Admin\PostController::edit | Editar post |
| POST | `/admin/posts/update/{id}` | Admin\PostController::update | Atualizar post |
| GET | `/admin/posts/delete/{id}` | Admin\PostController::delete | Deletar post |
| GET | `/admin/posts/search` | Admin\PostController::search | Buscar posts |

## 📊 Models

### User Model
```php
class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status',
        'session_token', 'remember_token'
    ];

    // Relacionamentos
    public function posts() // hasMany

    // Scopes
    public function scopeAdmins($query)
    public function scopeUsers($query)
    public function scopeActive($query)

    // Helpers
    public function isAdmin()
    public function isUser()
    public function isActive()
    public function getDisplayName()
    public function getInitials()
}
```

### Post Model
```php
class Post extends Model
{
    protected $fillable = [
        'title', 'image', 'description', 'user_id'
    ];

    // Relacionamentos
    public function user() // belongsTo

    // Scopes
    public function scopePublished($query)
    public function scopeRecent($query, $limit = 10)
    public function scopeSearch($query, $term)

    // Accessors
    public function getFormattedDateAttribute()
    public function getExcerptAttribute()
    public function getImageUrlAttribute()

    // Helpers
    public function getAuthorName()
    public function getReadingTime()
}
```

## 🎨 Frontend

### Assets Organizados
```
public/assets/
├── css/
│   ├── blog.css              # Estilos do blog público
│   ├── blogManager.css       # Estilos do painel admin
│   ├── login.css             # Estilos de autenticação
│   ├── authUsers.css         # Estilos de usuários
│   └── unavailable.css       # Estilos de elementos indisponíveis
└── js/
    ├── blog.js               # JavaScript do blog público
    ├── blogManager.js        # JavaScript do painel admin
    ├── login.js              # JavaScript de autenticação
    ├── authUsers.js          # JavaScript de usuários
    └── unavailable.js        # Sistema de elementos indisponíveis
```

## 🔧 Configurações

### Dependências Principais
- **CodeIgniter 4**: Framework PHP
- **Eloquent ORM**: ORM para banco de dados
- **Bootstrap 5**: Framework CSS
- **Font Awesome**: Ícones
- **jQuery**: JavaScript library

### Scripts Disponíveis
```bash
composer serve    # Iniciar servidor de desenvolvimento
composer optimize # Otimizar aplicação
```

## 🚀 Deploy

### Requisitos
- PHP 8.1+
- MySQL/MariaDB
- Composer

### Instalação
```bash
composer install
cp env .env
# Configurar .env com dados do banco
php spark migrate
php spark serve
```

## 📝 Notas de Desenvolvimento

### Padrões Utilizados
- **PSR-4**: Autoloading
- **MVC**: Arquitetura
- **Eloquent**: ORM
- **Bootstrap**: UI Framework

### Funcionalidades Implementadas
- ✅ Sistema de autenticação (admin/usuário)
- ✅ CRUD de posts
- ✅ Interface responsiva
- ✅ Sistema de busca
- ✅ Upload de imagens
- ✅ Dark mode (indisponível)
- ✅ Sistema de comentários (indisponível)

### Funcionalidades Futuras
- 🔄 Sistema de categorias
- 🔄 Sistema de tags
- 🔄 API REST
- 🔄 Cache de consultas
- 🔄 Sistema de notificações 