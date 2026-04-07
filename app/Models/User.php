<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_approved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function hasPermission($permission)
    {
        if (! $this->role) {
            return false;
        }

        return $this->role->hasPermission($permission);
    }

    public function isAdmin()
    {
        return $this->role && $this->role->name === 'Admin';
    }

    public function isHR()
    {
        return $this->role && $this->role->name === 'HR';
    }

    public function isEmployee()
    {
        return $this->role && $this->role->name === 'Employee';
    }

    public function isSuperAdmin()
    {
        return $this->role && $this->role->name === 'Superadmin';
    }

    public function isApproved()
    {
        // Employees are auto-approved, others need manual approval
        if ($this->isEmployee()) {
            return true;
        }
        return $this->is_approved;
    }

    public function needsApproval()
    {
        return !$this->isEmployee() && !$this->is_approved;
    }
}
