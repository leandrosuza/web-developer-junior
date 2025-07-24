# Web Developer Junior

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
Monolithic system for managing and publishing blog posts, featuring a complete admin panel and a modern public interface. Developed for a technical assessment, focusing on best practices, responsiveness, and the use of the required technologies.

---

## 🛠️ Technologies Used
- **CodeIgniter 4** (PHP Framework)
- **Eloquent** (ORM)
- **Bootstrap 5** (UI/Template)
- **jQuery** (Interactions)
- **MySQL** (Database)
- **Git** (Version Control)

---

## 🚀 Features

### 👨‍💻 Admin Panel
- Admin login
- CRUD for posts (title, image, HTML description)
- Management of categories, comments, users, and settings
- Modern, responsive interface with animations
- Custom login screen
- **Security:**
  - Authentication and session validation on all admin routes
  - Protection against unauthorized access (route tampering)
  - Invalid session destruction
  - Secure redirection to login on unauthorized attempts

### 🌐 Public Blog
- Post listing with search
- Post details page
- Styled footer and navbar
- **Unavailable Features:**
  - Uses `unavailable.js` to display overlays and block features/buttons that are not yet available, providing visual feedback and preventing unintended interactions.

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
- `README.md`: main documentation (project root)
- `/docs`: preview images, diagrams, and extra documentation
- `/app` and `/public`: main source code
- `/docs/db-diagram.png`: database diagram (add here if available)

[View database diagram](docs/db-diagram.png) <!-- Remove or adjust if not available -->

## 🗄️ Database and Diagrams

Database and diagram files are organized in `/docs/db`:

- [`blog.sql`](docs/db/blog.sql): Full SQL script for database import in MySQL.
- [`diagrama_workbench.sql`](docs/db/diagrama_workbench.sql): Workbench diagram script.
- [`diagrama_png.png`](docs/db/diagrama_png.png): Database diagram image.

### How to import the database
1. Open MySQL or phpMyAdmin.
2. Import the `docs/db/blog.sql` file to create tables and initial data.

### View the diagram
- Open `diagrama_workbench.sql` in MySQL Workbench to edit/view the model.
- Or view the diagram directly in the image [`diagrama_png.png`](docs/db/diagrama_png.png).

---

## 📄 Assessment Tasks

### Task 1
- Create a blog post manager
- The manager must have login
- Each post must have a title, image, and HTML description
- The project must be monolithic (no separation between front and back)

### Task 2
- Create the public blog
- Post listing page with search field
- Post details page

---

## Challenges and Solutions

- **Login/Admin route:**
  - Issue: The default login route was /login, but it was requested to standardize to /admin.
  - Solution: All routes, forms, and redirects were updated to /admin for consistency and better UX.

- **Admin route protection:**
  - Issue: Possibility of unauthorized access to the admin panel.
  - Solution: Session/token validation implemented on all admin routes, destroying invalid sessions and showing an access denied page.

- **Unavailable features overlay:**
  - Issue: Users could try to access features not yet implemented.
  - Solution: Created unavailable.js to block and visually signal unavailable features/buttons.

- **404 on post details:**
  - Issue: Accessing /blog/details/{id} returned 404 due to route and method in Portuguese.
  - Solution: Standardized routes and methods to English, fixing post details access.

- **Assets and documentation organization:**
  - Issue: Preview images were in a non-standard folder.
  - Solution: Created the /docs folder to centralize images, diagrams, and extra documentation, following GitHub best practices.

---

## 🤝 How to Contribute

1. Fork this repository
2. Create a branch for your feature or fix: `git checkout -b my-feature`
3. Commit your changes: `git commit -m 'feat: my new feature'`
4. Push to your fork: `git push origin my-feature`
5. Open a Pull Request explaining your changes

---

## 🖼️ Preview

### Admin Panel

![Dashboard](docs/DashboardManager.png)
![Posts Manager](docs/PostsManager.png)
![Settings Manager](docs/SettingsManager.png)
![Login](docs/AuthPage.png)

### Public Blog

![Home Page](docs/BlogHome.png)
![Post Details](docs/BlogDetailsPosts.png)
