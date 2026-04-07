# 🏢 HR Management System

A comprehensive, production-ready Human Resources Management System built with Laravel 12, featuring complete employee management, role-based access control, and permission management.

## ✨ Key Features

### 🔐 Authentication & Security
- Secure user login and registration
- Password hashing with bcrypt
- Session management
- CSRF protection
- Role-based access control (RBAC)

### 📊 Dashboard
- Real-time HR statistics
- Employee count tracking
- Recent employees list
- Quick action buttons
- User role display

### 👥 Employee Management
- **Create**: Add new employees with complete information
- **Read**: View employee list with pagination and search
- **Update**: Modify employee details and status
- **Delete**: Remove employees from system
- Search by name, email, or position
- Status tracking (active, on leave, inactive)

### 🎭 Role Management
- Create and manage roles
- Assign/revoke permissions
- Track users per role
- Edit role descriptions
- Default roles: Admin, HR, Employee

### 🔒 Permission Management
- 14 pre-configured permissions
- Organize permissions by module
- Dynamic permission assignment
- Create custom permissions
- Module-based organization

## 📦 Installation

### Prerequisites
- PHP 8.2+
- MySQL 5.7+
- Composer
- Laravel 12

### Setup Steps

```bash
# 1. Install dependencies
composer install

# 2. Configure environment
cp .env.example .env
php artisan key:generate

# 3. Update database credentials in .env
# Edit DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 4. Run migrations and seeders
php artisan migrate:fresh
php artisan db:seed

# 5. Start development server
php artisan serve

# 6. Access application
# Navigate to http://localhost:8000
```

## 🔑 Test Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| HR | hr@example.com | password |
| Employee | test_1@example.com | password |
| Employee | test_2@example.com | password |
| Employee | test_3@example.com | password |
| Employee | test_4@example.com | password |
| Employee | test_5@example.com | password |

## 📚 Documentation

### Quick Start
- **[QUICK_START.md](QUICK_START.md)** - Setup and basic usage
- **[HR_SYSTEM_GUIDE.md](HR_SYSTEM_GUIDE.md)** - Comprehensive system guide
- **[ARCHITECTURE.md](ARCHITECTURE.md)** - Technical architecture
- **[IMPLEMENTATION_SUMMARY.md](IMPLEMENTATION_SUMMARY.md)** - What's been implemented
- **[DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md)** - Deployment guide

## 🎯 Core Modules

### Dashboard
- View HR statistics
- Monitor employee metrics
- Quick access to main functions

### Employees
- Manage employee records
- Track employment status
- Search and filter employees
- View detailed profiles

### Roles
- Create and edit roles
- Assign permissions to roles
- Manage user roles
- Track role assignments

### Permissions
- Create custom permissions
- Organize by module
- Assign to roles
- Manage access control

## 🏗️ System Architecture

```
┌─────────────────────────────────────────┐
│        User Authentication             │
│     (Login/Register/Session)            │
└──────────────┬──────────────────────────┘
               │
┌──────────────▼──────────────────────────┐
│        Role-Based Access Control       │
│  (Middleware/Route Protection)          │
└──────────────┬──────────────────────────┘
               │
┌──────────────▼──────────────────────────┐
│         Application Modules             │
│  Dashboard, Employees, Roles, Perms     │
└──────────────┬──────────────────────────┘
               │
┌──────────────▼──────────────────────────┐
│          Database Layer                 │
│    (Models, Migrations, Seeders)        │
└────────────────────────────────────────┘
```

## 📁 Project Structure

```
nmcdata-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Business logic
│   │   └── Middleware/       # Request filters
│   └── Models/               # Database models
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Initial data
├── resources/
│   └── views/               # Blade templates
├── routes/
│   └── web.php              # Route definitions
├── QUICK_START.md           # Quick reference
├── HR_SYSTEM_GUIDE.md       # Complete guide
├── ARCHITECTURE.md          # Technical details
└── README.md                # This file
```

## 🔐 Security Features

✅ Password Hashing (Bcrypt)
✅ CSRF Token Protection
✅ Session Security
✅ Role-Based Access Control
✅ Permission-Based Authorization
✅ Input Validation
✅ SQL Injection Prevention (ORM)
✅ XSS Protection (Blade)

## 🚀 Features

### Authentication
- [x] User registration
- [x] User login
- [x] Secure logout
- [x] Password hashing
- [x] Session management

### Dashboard
- [x] HR statistics
- [x] Recent employees
- [x] Quick actions
- [x] User information

### Employees
- [x] CRUD operations
- [x] Search functionality
- [x] Pagination
- [x] Status tracking
- [x] Detailed profiles

### Roles
- [x] Create/Edit/Delete
- [x] Permission assignment
- [x] User tracking
- [x] Role descriptions

### Permissions
- [x] Create/Edit/Delete
- [x] Module organization
- [x] Role assignment
- [x] Custom permissions

### Access Control
- [x] Role-based routes
- [x] Permission checks
- [x] Menu visibility
- [x] View authorization

## 📊 Database Schema

### Tables
- **users** - User accounts with roles
- **roles** - System roles
- **permissions** - System permissions
- **role_permission** - Role-permission mapping
- **employees** - Employee records

## 🛠️ Technology Stack

- **Framework**: Laravel 12
- **Database**: MySQL 5.7+
- **Frontend**: Bootstrap 5
- **Language**: PHP 8.2+
- **ORM**: Eloquent
- **Authentication**: Laravel Auth

## 📖 Routes

### Public Routes
```
GET  /login           - Login page
GET  /register        - Registration page
POST /login           - Handle login
POST /register        - Handle registration
```

### Protected Routes (Authenticated)
```
GET  /dashboard       - Dashboard
GET  /employees       - Employee list
GET  /roles          - Role list
GET  /permissions    - Permission list
POST /logout         - Logout
```

## 🚦 Getting Started

1. **Review Documentation**
   - Start with [QUICK_START.md](QUICK_START.md)
   - Reference [HR_SYSTEM_GUIDE.md](HR_SYSTEM_GUIDE.md) for details

2. **Install & Setup**
   - Follow installation steps above
   - Run migrations and seeders
   - Start development server

3. **Login & Explore**
   - Use test credentials
   - Explore different roles
   - Test all features

4. **Customize**
   - Add new employees
   - Create custom roles
   - Assign permissions
   - Manage users

## 📝 Usage Examples

### Create New Employee
1. Login as Admin or HR
2. Click "Employees" menu
3. Click "Add Employee" button
4. Fill in employee details
5. Click "Save"

### Create New Role
1. Login as Admin or HR
2. Click "Roles" menu
3. Click "Add Role" button
4. Enter role name and description
5. Edit role to assign permissions

### Assign Permissions
1. Login as Admin
2. Go to "Roles"
3. Click "Edit" on a role
4. Select permissions to assign
5. Save changes

## 🐛 Troubleshooting

### Database Connection Error
```bash
# Check .env file and MySQL service
php artisan config:clear
php artisan cache:clear
```

### Login Issues
```bash
# Clear application cache
php artisan cache:clear
php artisan config:clear
```

### Permission Denied
- Verify user has correct role
- Check role has required permissions
- Clear middleware cache

See [QUICK_START.md](QUICK_START.md) for more troubleshooting.

## 🔄 Development Workflow

```bash
# Start development server
php artisan serve

# Run migrations
php artisan migrate

# Create new model with migration
php artisan make:model Employee -m

# Create controller
php artisan make:controller EmployeeController

# Run seeders
php artisan db:seed

# Clear cache
php artisan cache:clear
php artisan config:clear
```

## 📋 Feature Checklist

- [x] User Authentication
- [x] User Authorization (RBAC)
- [x] Dashboard Module
- [x] Employee Management
- [x] Role Management
- [x] Permission Management
- [x] Search Functionality
- [x] Form Validation
- [x] Error Handling
- [x] Responsive UI
- [x] Complete Documentation

## 🎓 Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap 5](https://getbootstrap.com)
- [MySQL Tutorial](https://dev.mysql.com)
- [PHP Documentation](https://php.net)

## 📞 Support

For questions or issues:
1. Check relevant documentation file
2. Review troubleshooting section
3. Examine application logs
4. Check database connectivity

## 📄 License

This project is provided as-is for demonstration and learning purposes.

## 🎉 Status

✅ **PRODUCTION READY**

All features implemented and tested. Ready for deployment.

---

**Last Updated**: February 26, 2026  
**Version**: 1.0.0  
**Status**: Complete ✓

### Quick Links
- [Quick Start Guide](QUICK_START.md)
- [Comprehensive Guide](HR_SYSTEM_GUIDE.md)
- [Technical Architecture](ARCHITECTURE.md)
- [Deployment Guide](DEPLOYMENT_CHECKLIST.md)

Start with [QUICK_START.md](QUICK_START.md) for the fastest way to get up and running!
