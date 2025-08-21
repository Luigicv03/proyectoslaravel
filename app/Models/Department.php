<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'manager_name',
        'manager_email',
        'manager_phone',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function activeTeamMembers()
    {
        return $this->hasMany(TeamMember::class)->where('is_active', true);
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' (' . $this->code . ')';
    }
}
