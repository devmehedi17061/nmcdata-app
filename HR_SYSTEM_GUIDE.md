# HR Management System - Complete Guide

## System Overview

A fully functional HR Management System with role-based access control (RBAC), complete employee management, and permission handling. Built with Laravel 12, Bootstrap 5, and modern web technologies.

## Key Features

### 1. **Authentication System**
- Secure login and registration system
- Password hashing and security
- Session management
- Automatic redirect to dashboard after login
- Logout functionality

### 2. **Dashboard Module**
- Key HR statistics (total employees, active, on leave, inactive)
- Recent employees list with quick view
- User role and account information
- Quick action buttons based on user role
- Responsive and intuitive interface

### 3. **Employee Management Module**
- **Create**: Add new employees with complete details
- **Read**: View all employees with pagination and search
- **Update**: Edit employee information and status
- **Delete**: Remove employees from the system
- Search functionality by name, email, or position
- Employee profile view with detailed information
- Status tracking (active, on_leave, inactive)

### 4. **Role & Permission Management**
- **Pre-configured Roles**:
  - Admin: Full system access
  - HR: Employee and role management access
  - Employee: Dashboard view only

- **Role Management**:
  - Create new roles dynamically
  - Edit role descriptions
  - Assign/revoke permissions to roles
  - Delete roles (when no users assigned)

- **Permission Management**:
  - 14 pre-configured permissions covering all modules
  - Create custom permissions
  - Edit and delete permissions
  - Organize permissions by module (dashboard, employee, role, permission)

### 5. **Role-Based Access Control (RBAC)**
- Middleware-based permission checking
- Route protection based on roles
- Dynamic permission assignment
- View-level authorization checks
- Menu visibility based on user role

### 6. **Default Permissions Structure**

#### Dashboard Module
- `view_dashboard` - View the main dashboard

#### Employee Module
- `view_employees` - View employee list
- `create_employee` - Create new employees
- `edit_employee` - Edit employee details
- `delete_employee` - Delete employees

#### Role Module
- `view_roles` - View all roles
- `create_role` - Create new roles
- `edit_role` - Edit role information
- `delete_role` - Delete roles
- `assign_permissions` - Assign permissions to roles

#### Permission Module
- `view_permissions` - View all permissions
- `create_permission` - Create new permissions
- `edit_permission` - Edit permissions
- `delete_permission` - Delete permissions

## Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL/MariaDB
- Laravel 12

### Step 1: Install Laravel Dependencies
```bash
composer install
```

### Step 2: Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hr_management
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Run Migrations
```bash
php artisan migrate
```

### Step 4: Run Seeders (Database Seeding)
```bash
php artisan db:seed
```

This will:
- Create 3 default roles (Admin, HR, Employee)
- Create 14 default permissions
- Assign permissions to roles
- Create test users:
  - Admin User: `admin@example.com` / `password`
  - HR Manager: `hr@example.com` / `password`
  - 5 Employee test users with email pattern: `test_{number}@example.com`

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php          # Login/Register handling
│   │   ├── DashboardController.php     # Dashboard logic
│   │   ├── EmployeeController.php      # CRUD for employees
│   │   ├── RoleController.php          # Role management
│   │   └── PermissionController.php    # Permission management
│   └── Middleware/
│       ├── CheckRole.php               # Role-based access control
│       └── CheckPermission.php         # Permission-based access
├── Models/
│   ├── User.php                        # User model with roles
│   ├── Employee.php                    # Employee data model
│   ├── Role.php                        # Role model
│   └── Permission.php                  # Permission model

database/
├── migrations/
│   ├── create_roles_table
│   ├── create_permissions_table
│   ├── create_role_permission_table
│   ├── create_employees_table
│   └── add_role_id_to_users_table
└── seeders/
    ├── RoleAndPermissionSeeder.php
    └── DatabaseSeeder.php

resources/views/
├── auth/
│   ├── login.blade.php                 # Login page
│   └── register.blade.php              # Registration page
├── layouts/
│   └── app.blade.php                   # Main layout with sidebar
├── employee/
│   ├── index.blade.php                 # Employee list
│   ├── create.blade.php                # Add employee form
│   ├── edit.blade.php                  # Edit employee form
│   └── show.blade.php                  # Employee details
├── role/
│   ├── index.blade.php                 # Role list
│   ├── create.blade.php                # Create role form
│   └── edit.blade.php                  # Edit role and permissions
├── permission/
│   ├── index.blade.php                 # Permission list
│   ├── create.blade.php                # Create permission form
│   └── edit.blade.php                  # Edit permission form
└── index.blade.php                     # Dashboard

routes/
└── web.php                             # All application routes
```

## Database Schema

### Users Table
- id, name, email, password, role_id, timestamps

### Roles Table
- id, name, description, timestamps

### Permissions Table
- id, name, description, module, timestamps

### Role_Permission Table (Pivot)
- id, role_id, permission_id, timestamps

### Employees Table
- id, name, email, phone, position, department, hire_date, status, salary, address, city, country, user_id, timestamps

## Usage Guide

### Login
1. Navigate to `/login`
2. Use credentials:
   - Admin: `admin@example.com` / `password`
   - HR: `hr@example.com` / `password`
   - Employee: `test_1@example.com` / `password`

### Managing Employees
**Admin/HR Only**
1. Go to "Employees" menu
2. Click "Add Employee" button
3. Fill in employee details
4. Click "Save"
5. View, edit, or delete employees from the list

### Managing Roles
**Admin/HR Only**
1. Go to "Roles" menu
2. View existing roles
3. Click "Edit" to modify role details
4. Click "Permissions" to assign/revoke permissions
5. Create new roles with custom descriptions

### Managing Permissions
**Admin Only**
1. Go to "Permissions" menu
2. View all available permissions
3. Create custom permissions
4. Edit or delete permissions as needed

## API Endpoints (Routes)

### Authentication
- `POST /login` - User login
- `POST /register` - User registration
- `POST /logout` - User logout

### Dashboard
- `GET /dashboard` - View dashboard (authenticated)

### Employees (Requires 'view_employees' permission)
- `GET /employees` - List all employees
- `GET /employees/{id}` - View employee details
- `GET /employees/create` - Create form
- `POST /employees` - Store new employee
- `GET /employees/{id}/edit` - Edit form
- `PUT /employees/{id}` - Update employee
- `DELETE /employees/{id}` - Delete employee
- `GET /employees/search?q=query` - Search employees

### Roles (Requires 'view_roles' permission)
- `GET /roles` - List all roles
- `GET /roles/create` - Create form
- `POST /roles` - Store new role
- `GET /roles/{id}/edit` - Edit form
- `PUT /roles/{id}` - Update role
- `DELETE /roles/{id}` - Delete role
- `GET /roles/{id}/assign-permissions` - Assign permissions

### Permissions (Requires 'view_permissions' permission - Admin only)
- `GET /permissions` - List all permissions
- `GET /permissions/create` - Create form
- `POST /permissions` - Store new permission
- `GET /permissions/{id}/edit` - Edit form
- `PUT /permissions/{id}` - Update permission
- `DELETE /permissions/{id}` - Delete permission

## User Roles & Permissions Breakdown

### Admin Role
- **Access**: Full system access
- **Permissions**: All 14 permissions
- **Modules**: Dashboard, Employees, Roles, Permissions

### HR Role
- **Access**: Employee and role management
- **Permissions**: 7 permissions (Dashboard, Employees (CRUD), Roles (view/view permissions))
- **Modules**: Dashboard, Employees, Roles

### Employee Role
- **Access**: Dashboard only
- **Permissions**: 1 permission (view_dashboard)
- **Modules**: Dashboard

## Security Features

1. **Password Hashing**: All passwords are bcrypt hashed
2. **CSRF Protection**: Built-in Laravel CSRF tokens
3. **Role-Based Access Control**: Middleware-based route protection
4. **Permission Checking**: Dynamic permission verification
5. **Input Validation**: Server-side validation on all forms
6. **Session Management**: Secure session handling

## Customization

### Add New Modules
1. Create migration files
2. Create models in `app/Models/`
3. Create controllers in `app/Http/Controllers/`
4. Create views in `resources/views/`
5. Define permissions in seeder
6. Add routes in `routes/web.php`

### Add New Roles
Run seeder or create through UI. Automatically assign permissions.

### Custom Permissions
1. Create permission through UI
2. Assign to roles through role edit page
3. Check permission in views using `Auth::user()->hasPermission()`

## Testing Credentials

| Role     | Email               | Password |
|----------|-------------------|----------|
| Admin    | admin@example.com | password |
| HR       | hr@example.com    | password |
| Employee | test_1@example.com| password |

## Features Summary

✅ Authentication System  
✅ Dashboard with Statistics  
✅ Employee Management (CRUD)  
✅ Role Management  
✅ Permission Management  
✅ Role-Based Access Control  
✅ Search and Filter Functionality  
✅ Responsive UI  
✅ Bootstrap 5 Design  
✅ Form Validation  
✅ Error Handling  

## Troubleshooting

### Migrations fail
- Ensure database exists and credentials are correct
- Run `php artisan migrate:fresh` to rollback and retry

### Login issues
- Clear Laravel cache: `php artisan cache:clear`
- Clear session: `php artisan session:flush`

### Permission denied errors
- Check user role assignment
- Verify role has proper permissions
- Clear middleware cache

## Future Enhancements

- Attendance tracking
- Leave management
- Payroll system
- Performance reviews
- Projects and tasks
- Email notifications
- Export to Excel/PDF
- Advanced reporting

## Support & Maintenance

For issues or improvements, refer to Laravel documentation:
- Laravel Framework: https://laravel.com/docs
- Bootstrap 5: https://getbootstrap.com/docs/5.0/

---

**Version**: 1.0.0  
**Last Updated**: February 2026  
**Developer**: HR System Team
