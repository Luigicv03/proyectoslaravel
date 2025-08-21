<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'role',
        'seniority',
        'skills',
        'bio',
        'is_active',
        'hire_date'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'hire_date' => 'date'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getRoleDisplayAttribute()
    {
        $roles = [
            'developer' => 'Desarrollador',
            'analyst' => 'Analista',
            'manager' => 'Gerente',
            'tester' => 'Tester',
            'designer' => 'Diseñador',
            'architect' => 'Arquitecto',
            'devops' => 'DevOps',
            'other' => 'Otro'
        ];

        return $roles[$this->role] ?? $this->role;
    }

    public function getSeniorityDisplayAttribute()
    {
        $seniorities = [
            'junior' => 'Junior',
            'mid' => 'Mid-Level',
            'senior' => 'Senior',
            'lead' => 'Lead'
        ];

        return $seniorities[$this->seniority] ?? $this->seniority;
    }

    public function getSkillsArrayAttribute()
    {
        return $this->skills ? explode(',', $this->skills) : [];
    }
}
