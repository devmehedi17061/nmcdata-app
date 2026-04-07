# System Configuration & Architecture

## System Architecture Overview

```
┌─────────────────────────────────────────────────────────────┐
│                    Browser / Client                         │
└────────────────────────┬────────────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────────┐
│                   Web Server (Apache/PHP)                   │
│                     Laravel 12 Framework                    │
└─────────────────────────────────────────────────────────────┘
                         │
        ┌────────────────┼────────────────┐
        ▼                ▼                ▼
┌──────────────┐  ┌──────────────┐  ┌──────────────┐
│   Auth       │  │  Controllers │  │  Middleware  │
│  System      │  │              │  │              │
└──────────────┘  └──────────────┘  └──────────────┘
        │                │                │
        └────────────────┼────────────────┘
                         │
                         ▼
            ┌────────────────────────┐
            │   Database Models      │
            │ (User, Role, Perm...)  │
            └────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────────┐
│          MySQL/MariaDB Database                            │
│  (roles, permissions, role_permission, employees, users)   │
└─────────────────────────────────────────────────────────────┘
```

## Database Relationships

### Users Table
```
users
├── id (PK)
├── name
├── email (UNIQUE)
├── password
├── role_id (FK → roles.id)
└── timestamps
```

### Roles Table
```
roles
├── id (PK)
├── name (UNIQUE)
├── description
└── timestamps

Many-to-Many with Permissions through role_permission
```

### Permissions Table
```
permissions
├── id (PK)
├── name (UNIQUE)
├── description
├── module (dashboard|employee|role|permission)
└── timestamps

Many-to-Many with Roles through role_permission
```

### Role_Permission Pivot Table
```
role_permission
├── id (PK)
├── role_id (FK → roles.id)
├── permission_id (FK → permissions.id)
└── timestamps
```

### Employees Table
```
employees
├── id (PK)
├── name
├── email (UNIQUE)
├── phone
├── position
├── department
├── hire_date
├── status (active|on_leave|inactive)
├── salary
├── address
├── city
├── country
├── user_id (FK → users.id, NULLABLE)
└── timestamps
```

## Class Relationships & Associations

### User Model
```php
User::class
  ├── role() → belongsTo(Role::class)
  ├── employee() → hasOne(Employee::class)
  ├── hasPermission() → method
  ├── isAdmin() → method
  ├── isHR() → method
  └── isEmployee() → method
```

### Role Model
```php
Role::class
  ├── permissions() → belongsToMany(Permission::class)
  ├── users() → hasMany(User::class)
  ├── hasPermission() → method
  ├── grantPermission() → method
  └── revokePermission() → method
```

### Permission Model
```php
Permission::class
  └── roles() → belongsToMany(Role::class)
```

### Employee Model
```php
Employee::class
  └── user() → belongsTo(User::class)
```

## Controller Structure

### AuthController
- `showLogin()` - Display login form
- `login()` - Handle login request
- `showRegister()` - Display registration form
- `register()` - Handle registration request
- `logout()` - Handle logout

### DashboardController
- `index()` - Display dashboard with statistics

### EmployeeController
- `index()` - List employees with pagination
- `create()` - Show create form
- `store()` - Save new employee
- `show()` - Display employee details
- `edit()` - Show edit form
- `update()` - Update employee
- `destroy()` - Delete employee
- `search()` - Search employees

### RoleController
- `index()` - List roles
- `create()` - Show create form
- `store()` - Save new role
- `edit()` - Show edit form
- `update()` - Update role and permissions
- `destroy()` - Delete role
- `assignPermissions()` - Show permission assignment page

### PermissionController
- `index()` - List permissions
- `create()` - Show create form
- `store()` - Save new permission
- `edit()` - Show edit form
- `update()` - Update permission
- `destroy()` - Delete permission

## Middleware Chain

### CheckRole Middleware
```
Purpose: Verify user has specified role
Location: app/Http/Middleware/CheckRole.php
Usage: Route::middleware(['role:Admin,HR'])
```

### CheckPermission Middleware
```
Purpose: Verify user has specific permission
Location: app/Http/Middleware/CheckPermission.php
Usage: Route::middleware(['permission:view_employees'])
```

## Route Organization

### Authentication Routes
```
POST /login          → AuthController@login
POST /register       → AuthController@register
POST /logout         → AuthController@logout
GET  /login          → AuthController@showLogin
GET  /register       → AuthController@showRegister
```

### Dashboard Routes
```
GET  /dashboard      → DashboardController@index (auth)
GET  /              → DashboardController@index (auth)
```

### Employee Routes (Protected by auth)
```
GET    /employees                → EmployeeController@index
GET    /employees/create         → EmployeeController@create
POST   /employees                → EmployeeController@store
GET    /employees/{id}           → EmployeeController@show
GET    /employees/{id}/edit      → EmployeeController@edit
PUT    /employees/{id}           → EmployeeController@update
DELETE /employees/{id}           → EmployeeController@destroy
GET    /employees/search         → EmployeeController@search
```

### Role Routes (Protected by auth + role:Admin,HR)
```
GET    /roles                                    → RoleController@index
GET    /roles/create                            → RoleController@create
POST   /roles                                   → RoleController@store
GET    /roles/{id}/edit                         → RoleController@edit
PUT    /roles/{id}                              → RoleController@update
DELETE /roles/{id}                              → RoleController@destroy
GET    /roles/{id}/assign-permissions           → RoleController@assignPermissions
```

### Permission Routes (Protected by auth + role:Admin)
```
GET    /permissions              → PermissionController@index
GET    /permissions/create       → PermissionController@create
POST   /permissions              → PermissionController@store
GET    /permissions/{id}/edit    → PermissionController@edit
PUT    /permissions/{id}         → PermissionController@update
DELETE /permissions/{id}         → PermissionController@destroy
```

## Default Permissions Structure

### Dashboard Module
- `view_dashboard` - View dashboard statistics

### Employee Module
- `view_employees` - View employee list
- `create_employee` - Create new employee
- `edit_employee` - Edit employee information
- `delete_employee` - Delete employee

### Role Module
- `view_roles` - View roles
- `create_role` - Create new role
- `edit_role` - Edit role
- `delete_role` - Delete role
- `assign_permissions` - Assign permissions to roles

### Permission Module
- `view_permissions` - View permissions
- `create_permission` - Create permission
- `edit_permission` - Edit permission
- `delete_permission` - Delete permission

## Security Implementation

### Authentication
1. Laravel's built-in authentication system
2. Bcrypt password hashing
3. Session-based user management
4. Login/register with validation

### Authorization
1. Role-based access control (RBAC)
2. Middleware-based route protection
3. Permission checking on routes
4. View-level authorization checks

### Input Validation
1. Server-side form validation
2. Request class validation rules
3. CSRF token protection
4. SQL injection prevention via ORM

## View Templates Structure

```
views/
├── auth/
│   ├── login.blade.php      - Login form
│   └── register.blade.php   - Registration form
├── layouts/
│   └── app.blade.php        - Main application layout
├── employee/
│   ├── index.blade.php      - Employee list
│   ├── create.blade.php     - Add employee form
│   ├── edit.blade.php       - Edit employee form
│   └── show.blade.php       - Employee details
├── role/
│   ├── index.blade.php      - Role list
│   ├── create.blade.php     - Create role form
│   └── edit.blade.php       - Edit role & permissions
├── permission/
│   ├── index.blade.php      - Permission list
│   ├── create.blade.php     - Create permission form
│   └── edit.blade.php       - Edit permission form
└── index.blade.php          - Dashboard
```

## Configuration Files

### .env File
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hr_management
DB_USERNAME=root
DB_PASSWORD=

APP_DEBUG=false
APP_URL=http://localhost:8000
```

### app/Http/Middleware Configuration
```php
// bootstrap/app.php
$middleware->alias([
    'role' => CheckRole::class,
    'permission' => CheckPermission::class,
]);
```

## Performance Optimization

### Eager Loading
- Models use relationships efficiently
- Pagination on list views
- Limited query results

### Caching
- Configuration caching recommended
- Session caching for performance

### Database Indexing
- Primary keys indexed
- Foreign keys indexed
- Unique constraints on emails

## Error Handling

### 404 Errors
- Non-existent resources redirect with error message

### 403 Errors
- Unauthorized access redirects to dashboard
- Permission denied shows error

### Validation Errors
- Form validation displays inline error messages
- Session flash messages for success/error

## Seeding Strategy

### Initial Seeding
```bash
php artisan db:seed
```

Populates:
1. 3 default roles (Admin, HR, Employee)
2. 14 default permissions
3. 2 test users (Admin, HR)
4. 5 factory-generated employees

### Custom Seeding
Create new seeders in `database/seeders/` and call from DatabaseSeeder

## Development Workflow

1. **Create Model** → Define migrations
2. **Create Migration** → Run with `php artisan migrate`
3. **Create Controller** → Add business logic
4. **Create Routes** → Add to `routes/web.php`
5. **Create Views** → Build UI
6. **Add Tests** → Validate functionality
7. **Deploy** → Push to production

## Testing Checklist

- [ ] Login with different roles
- [ ] Access role-protected pages
- [ ] Access permission-protected pages
- [ ] Employee CRUD operations
- [ ] Role creation and assignment
- [ ] Permission management
- [ ] Search functionality
- [ ] Form validation
- [ ] Error handling
- [ ] Session management

---

**Last Updated**: February 2026  
**Framework Version**: Laravel 12  
**Database**: MySQL 5.7+  
**PHP Version**: 8.2+
