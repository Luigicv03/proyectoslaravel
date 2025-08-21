<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataImport extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'file_name',
        'import_date',
    ];

    protected $casts = [
        'import_date' => 'date',
    ];

    /**
     * Get the project for this import
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the snapshots for this import
     */
    public function snapshots(): HasMany
    {
        return $this->hasMany(ProjectSnapshot::class);
    }
}
