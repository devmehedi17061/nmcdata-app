<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'reason',
        'status',
        'approved_by',
        'approved_at',
        'remarks',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-warning',
            'approved' => 'bg-success',
            'rejected' => 'bg-danger',
        ];
        return $badges[$this->status] ?? 'bg-secondary';
    }

    public function getLeaveTypeNameAttribute()
    {
        $types = [
            'annual' => 'Annual Leave',
            'sick' => 'Sick Leave',
            'casual' => 'Casual Leave',
            'unpaid' => 'Unpaid Leave',
            'maternity' => 'Maternity Leave',
            'paternity' => 'Paternity Leave',
        ];
        return $types[$this->leave_type] ?? $this->leave_type;
    }

    public function getTotalDaysAttribute()
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }
}
