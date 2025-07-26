# 🚀 TechBlog - Modern Blog Management System

**A complete, professional blog management system built with CodeIgniter 4 and modern web technologies.**

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-blue" alt="PHP Version"/>
  <img src="https://img.shields.io/badge/CodeIgniter-4.6.2-red" alt="CodeIgniter"/>
  <img src="https://img.shields.io/badge/Eloquent-ORM-orange" alt="Eloquent ORM"/>
  <img src="https://img.shields.io/badge/Bootstrap-5.3-purple" alt="Bootstrap"/>
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License"/>
  <img src="https://img.shields.io/badge/Status-Production%20Ready-brightgreen" alt="Status"/>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.1%2B-blue" alt="PHP Version"/>
  <img src="https://img.shields.io/badge/CodeIgniter-4.x-red" alt="CodeIgniter"/>
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License"/>
  <img src="https://img.shields.io/badge/Status-In%20Development-yellow" alt="Status"/>
</p>

---

## 📑 Table of Contents
- [About the Project](#about-the-project)
- [Technologies Used](#technologies-used)
- [Features](#features)
- [How to Run the Project](#how-to-run-the-project)
- [Project Structure](#project-structure)
- [Assessment Tasks](#assessment-tasks)
- [Challenges and Solutions](#challenges-and-solutions)
- [How to Contribute](#how-to-contribute)
- [Preview](#preview)

---

## 📝 About the Project

**TechBlog** is a modern, production-ready blog management system that evolved from a technical assessment into a professional-grade application. Built with CodeIgniter 4 and Eloquent ORM, it features a complete admin panel, modern public interface, and follows senior-level development practices.

### 🎯 **Key Features:**
- **Complete CRUD Operations** for blog posts with image upload
- **Modern Admin Panel** with responsive design and real-time interactions
- **Public Blog Interface** with search, filtering, and dark mode
- **User Authentication System** for both admin and regular users
- **Professional Code Structure** with proper namespacing and organization
- **Production-Ready** with security measures and error handling

### 🔄 **Recent Major Updates:**
- **Complete Project Restructuring** - Professional namespace organization
- **Enhanced Models** - Added relationships, scopes, accessors, and helper methods
- **Improved Admin Interface** - Modal-based CRUD operations with AJAX
- **Portuguese Localization** - All user-facing content in Brazilian Portuguese
- **Code Quality Improvements** - English comments, removed debug code, updated dependencies

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

## 🏁 How to Run the Project

1. Clone the repository
2. Install dependencies with `composer install`
3. Configure the `.env` file with your MySQL database credentials (see example below)
4. Run migrations/seeds if needed
5. Start the built-in CodeIgniter server: `php spark serve`
6. Access:
   - Public blog: [http://localhost:8080/blog](http://localhost:8080/blog)
   - Admin: [http://localhost:8080/admin](http://localhost:8080/admin)

**Admin Access (template):**
- Email: `admin@gmail.com`
- Password: `admin123`

**User Access (template):**
- Email: `user@gmail.com`
- Password: `user123`

### Example `.env`
```ini
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = blog
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

> **Tip:** Rename the `env` file to `.env` and adjust it for your environment.

---

## 🗂️ Project Structure

```
web-developer-junior/
├── 📁 app/
│   ├── 📁 Controllers/
│   │   ├── 📁 Admin/           # Admin controllers (Auth, Post)
│   │   └── 📁 Blog/            # Public blog controllers
│   ├── 📁 Models/              # Eloquent models (User, Post)
│   ├── 📁 Views/               # Blade-like templates
│   │   ├── 📁 admin/           # Admin panel views
│   │   ├── 📁 auth/            # Authentication views
│   │   ├── 📁 blog/            # Public blog views
│   │   └── 📁 errors/          # Error pages
│   └── 📁 Config/              # Application configuration
├── 📁 public/                  # Web root
│   ├── 📁 assets/
│   │   ├── 📁 css/             # Stylesheets
│   │   ├── 📁 js/              # JavaScript files
│   │   └── 📁 uploads/         # User uploaded files
├── 📁 docs/                    # Documentation & assets
│   └── 📁 db/                  # Database files
├── 📄 API.md                   # API documentation
├── 📄 composer.json            # PHP dependencies
└── 📄 README.md                # This file
```

### **Key Files:**
- **`API.md`** - Complete API documentation with routes and models
- **`docs/db/blog.sql`** - Database schema and sample data
- **`composer.json`** - Project metadata and dependencies

## 🗄️ Database & Diagrams

Database files and diagrams are organized in `/docs/db`:

- [`blog.sql`](docs/db/blog.sql): Complete SQL script to import the database into MySQL.
- [`diagrama_workbench.sql`](docs/db/diagrama_workbench.sql): Workbench diagram script.
- [`diagrama_png.png`](docs/db/diagrama_png.png): Database diagram image.

### Database Schema

#### **Users Table:**
- `id` - Primary key
- `name` - User full name
- `email` - Unique email address
- `password` - Hashed password
- `role` - User role (admin/user)
- `status` - Account status (active/inactive)
- `session_token` - Session management
- `remember_token` - Remember me functionality
- `created_at` / `updated_at` - Timestamps

#### **Posts Table:**
- `id` - Primary key
- `title` - Post title
- `description` - HTML content
- `image` - Image file path
- `user_id` - Author reference
- `created_at` / `updated_at` - Timestamps

### How to Import Database
1. Open MySQL or phpMyAdmin
2. Import the `docs/db/blog.sql` file to create tables and initial data

### View Diagram
- Open `diagrama_workbench.sql` in MySQL Workbench to edit/view the model
- Or see the diagram directly in the image below:

![Database Diagram](docs/db/diagrama_png.png)

---

## 📄 Assessment Tasks

### ✅ **Task 1 - Blog Post Manager**
- ✅ Create a blog post manager
- ✅ The manager must have login
- ✅ Each post must have a title, image, and HTML description
- ✅ The project must be monolithic (no separation between front and back)

### ✅ **Task 2 - Public Blog**
- ✅ Create the public blog
- ✅ Post listing page with search field
- ✅ Post details page

### 🚀 **Bonus Features Implemented:**
- ✅ **User Authentication System** - Separate admin and user login
- ✅ **Modern UI/UX** - Responsive design with dark mode
- ✅ **Real-time CRUD** - AJAX-powered admin operations
- ✅ **Professional Code Structure** - Namespaces, models, relationships
- ✅ **Security Features** - Session management, route protection
- ✅ **Database Relationships** - User-Post associations
- ✅ **Image Upload** - File management for post images
- ✅ **Search & Filter** - Advanced post discovery

---

## 🔧 Challenges and Solutions

### **Initial Development Challenges:**
- **Login/Admin route:** Standardized to /admin for consistency and better UX
- **Admin route protection:** Implemented session validation on all admin routes
- **Unavailable features overlay:** Created unavailable.js for visual feedback
- **404 on post details:** Fixed route and method naming conventions
- **Assets organization:** Created /docs folder following GitHub best practices

### **Recent Major Improvements:**

#### **🔄 Project Restructuring:**
- **Issue:** Code organization wasn't following professional standards
- **Solution:** Implemented proper namespacing (`App\Controllers\Admin`, `App\Controllers\Blog`)
- **Result:** Clean, maintainable code structure

#### **📊 Enhanced Models:**
- **Issue:** Basic models without relationships or helper methods
- **Solution:** Added Eloquent relationships, scopes, accessors, and helper methods
- **Result:** More robust data handling and cleaner code

#### **🎨 Admin Interface Improvements:**
- **Issue:** Basic CRUD operations without real-time feedback
- **Solution:** Implemented AJAX-powered modals with instant feedback
- **Result:** Professional admin experience

#### **🌍 Localization:**
- **Issue:** Mixed languages in user interface
- **Solution:** Standardized all user-facing content to Brazilian Portuguese
- **Result:** Consistent user experience

#### **🔧 Code Quality:**
- **Issue:** Debug code and inconsistent comments
- **Solution:** Removed debug code, standardized English comments
- **Result:** Production-ready codebase

---

## 🆕 Latest Updates (v2.0.0)

### **Major Improvements:**

#### **🏗️ Architecture & Code Quality:**
- **Complete Project Restructuring** - Professional namespace organization
- **Enhanced Models** - Added Eloquent relationships, scopes, accessors, and helper methods
- **Code Standardization** - English comments, removed debug code, updated dependencies
- **Composer Optimization** - Removed development dependencies, updated to CodeIgniter 4.6.2

#### **🎨 User Interface:**
- **Portuguese Localization** - All user-facing content in Brazilian Portuguese
- **Modal-based CRUD** - AJAX-powered admin operations with real-time feedback
- **Enhanced Admin Panel** - Improved post management with image preview
- **Better Error Handling** - User-friendly error messages and notifications

#### **🔧 Technical Improvements:**
- **Database Schema** - Enhanced with proper relationships and constraints
- **Security Enhancements** - Improved session management and route protection
- **Performance Optimization** - Cleaner code structure and better resource management
- **Documentation** - Complete API documentation and updated README

### **Breaking Changes:**
- **Namespace Changes** - Controllers moved to `App\Controllers\Admin` and `App\Controllers\Blog`
- **Route Updates** - Some routes have been reorganized for better structure
- **Database Updates** - New columns and relationships added

### **Migration Guide:**
1. **Update Composer Dependencies:** `composer install --no-dev`
2. **Import Updated Database:** Use the latest `docs/db/blog.sql`
3. **Clear Cache:** Remove any cached files if needed
4. **Test Functionality:** Verify all features work as expected

---

## 🤝 How to Contribute

1. Fork this repository
2. Create a branch for your feature or fix: `git checkout -b my-feature`
3. Commit your changes: `git commit -m 'feat: my new feature'`
4. Push to your fork: `git push origin my-feature`
5. Open a Pull Request explaining your changes

---

## 🖼️ Preview

### 📊 Admin Panel

#### Dashboard Manager
![Dashboard Manager](docs/DashboardManager.png)

#### Posts Manager
![Posts Manager](docs/PostsManager.png)

#### Settings Manager
![Settings Manager](docs/SettingsManager.png)

#### Authentication Page
![Authentication Page](docs/AuthPage.png)

### 🌐 Public Blog

#### Home Page
![Blog Home Page](docs/BlogHome.png)

#### Post Details Page
![Blog Post Details](docs/BlogDetailsPosts.png)

### 🗄️ Database Schema

#### Database Diagram
![Database Diagram](docs/db/diagrama_png.png)
