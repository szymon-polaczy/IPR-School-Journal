<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'teacher_id',
        'subject_id',
        'class_id',
    ];

    public function teacher(): BelongsTo {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function subject(): BelongsTo {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function class(): BelongsTo {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function grades(): HasMany {
        return $this->hasMany(Grade::class, 'assignment_id', 'id');
    }
}
