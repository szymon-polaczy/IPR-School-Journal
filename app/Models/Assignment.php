<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assignment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, enum>
     */
    protected $fillable = [
        'name',
        'grade',
    ];

    public function teacher(): BelongsTo {
        return $this->belongsTo(Teacher::class, 'id', 'teacher_id');
    }

    public function subject(): BelongsTo {
        return $this->belongsTo(Subject::class, 'id', 'subject_id');
    }

    public function class(): BelongsTo {
        return $this->belongsTo(ClassModel::class, 'id', 'class_id');
    }
}
