<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        // Basic Information
        'employee_id',
        'name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'blood_group',
        'photo',
        'emergency_contact_name',
        'emergency_contact_phone',
        
        // Job Information
        'position',
        'department',
        'employment_type',
        'work_shift',
        'hire_date',
        'confirmation_date',
        'status',
        'salary',
        'salary_type',
        'reporting_manager_id',
        'work_location',
        
        // Present Address
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        
        // Permanent Address
        'permanent_address',
        'permanent_city',
        'permanent_state',
        'permanent_zip_code',
        'permanent_country',
        
        // Documents
        'cv_file',
        'nid_file',
        'appointment_letter_file',
        'offer_letter_file',
        'academic_certificate_file',
        
        // System
        'user_id',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'confirmation_date' => 'date',
        'date_of_birth' => 'date',
        'salary' => 'decimal:2',
    ];

    /**
     * Boot method to auto-generate employee_id
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            if (empty($employee->employee_id)) {
                $employee->employee_id = self::generateEmployeeId();
            }
        });
    }

    /**
     * Generate unique employee ID
     */
    public static function generateEmployeeId()
    {
        $prefix = 'EMP';
        $year = date('Y');
        
        // Get the last employee ID for this year
        $lastEmployee = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastEmployee && preg_match('/EMP' . $year . '(\d+)/', $lastEmployee->employee_id, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }
        
        return $prefix . $year . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reporting manager
     */
    public function reportingManager()
    {
        return $this->belongsTo(Employee::class, 'reporting_manager_id');
    }

    /**
     * Get employees reporting to this employee
     */
    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'reporting_manager_id');
    }

    /**
     * Get age from date of birth
     */
    public function getAgeAttribute()
    {
        if ($this->date_of_birth) {
            return $this->date_of_birth->age;
        }
        return null;
    }
}
