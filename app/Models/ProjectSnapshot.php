<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectSnapshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_import_id',
        'task_identifier',
        'task_name',
        'environment',
        'progress_percentage',
        'start_date',
        'estimated_end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'estimated_end_date' => 'date',
    ];

    /**
     * Get the data import for this snapshot
     */
    public function dataImport(): BelongsTo
    {
        return $this->belongsTo(DataImport::class);
    }

    /**
     * Get the project through the data import
     */
    public function project()
    {
        return $this->dataImport->project();
    }
}
