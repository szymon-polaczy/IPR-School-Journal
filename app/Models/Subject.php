<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subject';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'teacher_id',
        'class_id',
    ];

    public function teacher(): BelongsTo {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function class(): BelongsTo {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}
