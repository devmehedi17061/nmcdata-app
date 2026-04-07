# HR Management System - Quick Start Guide

## Setup Instructions

### 1. Initial Setup
```bash
# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env file
DB_DATABASE=hr_management
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Database Setup
```bash
# Create database (manually or via phpMyAdmin)
CREATE DATABASE hr_management;

# Run migrations
php artisan migrate:fresh

# Seed database with roles, permissions, and test users
php artisan db:seed
```

### 3. Start Development Server
```bash
# Option 1: Using PHP built-in server
php artisan serve

# Option 2: Using Laravel Sail (if configured)
./vendor/bin/sail up

# Access the application
http://localhost:8000
```

## First Login

### Default Test Accounts

| Role  | Email | Password | Access |
|-------|-------|----------|--------|
| Admin | admin@example.com | password | Full System Access |
| HR | hr@example.com | password | Employees & Roles |
| Employee | test_1@example.com | password | Dashboard Only |

### Admin Account Features
- Create, edit, delete employees
- Create, edit, delete roles
- Create, edit, delete permissions
- Assign permissions to roles
- Full dashboard access

### HR Account Features
- View and manage employees
- View roles
- Assign permissions to roles
- Full dashboard access
- Cannot delete roles

### Employee Account Features
- View own dashboard
- View own profile
- Dashboard-only access

## Core Functionalities

### Dashboard
- Statistics overview (total, active, on leave, inactive employees)
- Recent employees list
- Quick action buttons
- User role information

### Employee Management
1. **List Employees**: `/employees`
   - View all employees with pagination
   - Search by name, email, or position
   - Filter by status

2. **Add Employee**: `/employees/create`
   - Full name, email, phone
   - Position and department
   - Hire date and salary
   - Address, city, country
   - Status (active, on leave, inactive)

3. **Edit Employee**: `/employees/{id}/edit`
   - Update all employee information
   - Change status
   - Modify salary and position

4. **View Details**: `/employees/{id}`
   - Complete employee profile
   - Experience calculation
   - Account information

### Role Management
1. **View Roles**: `/roles`
   - See all roles and their descriptions
   - View permission count
   - View assigned users count

2. **Create New Role**: `/roles/create`
   - Define role name and description
   - Assign permissions during edit

3. **Edit Role**: `/roles/{id}/edit`
   - Update role details
   - Assign/revoke permissions
   - Preview current permissions

4. **Assign Permissions**: `/roles/{id}/assign-permissions`
   - Select permissions by module
   - Change role access level

### Permission Management (Admin Only)
1. **View Permissions**: `/permissions`
   - See all system permissions
   - View which roles use them
   - Filter by module

2. **Create Permission**: `/permissions/create`
   - Define permission name
   - Add description
   - Assign to module

3. **Edit Permission**: `/permissions/{id}/edit`
   - Update permission details
   - Change module assignment

## Important Routes

### Public Routes
- `GET /` → Redirects to dashboard (if authenticated)
- `GET /login` → Login page
- `GET /register` → Registration page
- `POST /login` → Handle login
- `POST /register` → Handle registration

### Protected Routes (Require Authentication)
- `GET /dashboard` → Main dashboard
- `GET /employees` → List employees
- `GET /roles` → List roles
- `GET /permissions` → List permissions (Admin only)
- `POST /logout` → Logout

## Troubleshooting

### Issue: Migrations failed
**Solution:**
```bash
# Drop all tables and re-migrate
php artisan migrate:fresh

# Or reset specific table
php artisan migrate:refresh --step=1
```

### Issue: Cannot login
**Solution:**
1. Clear application cache: `php artisan cache:clear`
2. Clear configuration: `php artisan config:clear`
3. Verify database connection
4. Check database has seeded data: `php artisan tinker`

### Issue: Permission denied
**Solution:**
1. Verify user has correct role
2. Check role has required permissions
3. Clear middleware cache
4. Check route middleware configuration

### Issue: Database connection error
**Solution:**
1. Verify `.env` database credentials
2. Ensure database exists
3. Check MySQL service is running
4. Run `php artisan config:clear`

## File Structure Explanation

```
app/
  Models/          → Database models with relationships
  Http/
    Controllers/   → Business logic for each module
    Middleware/    → Role and permission checking

database/
  migrations/      → Database schema definitions
  seeders/         → Initial data population

resources/
  views/
    auth/         → Login/Register templates
    employee/     → Employee module views
    role/         → Role management views
    permission/   → Permission management views
    layouts/      → Main application layout

routes/
  web.php         → All route definitions
```

## Customization Tips

### Add New Menu Item
Edit `resources/views/layouts/app.blade.php`:
```blade
<li class="nav-item">
    <a class="nav-link" href="/menu-path">
        <i class="fas fa-icon"></i> Menu Label
    </a>
</li>
```

### Create New Role
1. Go to Roles > Create New Role
2. Fill role name and description
3. Edit role to assign permissions

### Create New Permission
1. Go to Permissions > Add Permission (Admin only)
2. Fill permission name, description, and module
3. Assign to roles through Role edit page

### Protect a Route
In `routes/web.php`:
```php
Route::middleware(['auth', 'role:Admin,HR'])->group(function () {
    // Routes here
});
```

## Before Going Live

- [ ] Change all test user passwords
- [ ] Update `.env` with production database
- [ ] Set `APP_DEBUG=false`
- [ ] Generate new `APP_KEY`
- [ ] Configure email settings
- [ ] Set up backup strategy
- [ ] Create admin account
- [ ] Remove/secure seeders
- [ ] Configure file storage

## Tips & Best Practices

1. **Always backup database** before running migrations
2. **Use transactions** for critical operations
3. **Log user actions** for audit trails
4. **Validate all inputs** on server side
5. **Use environment variables** for sensitive data
6. **Regular backups** of employee data
7. **Monitor system logs** for errors
8. **Update dependencies** regularly

## Additional Resources

- Laravel Documentation: https://laravel.com/docs
- Bootstrap 5: https://getbootstrap.com
- MySQL: https://dev.mysql.com
- Authentication: https://laravel.com/docs/authentication
- Authorization: https://laravel.com/docs/authorization

---

**Need Help?** Check the main guide: `HR_SYSTEM_GUIDE.md`
