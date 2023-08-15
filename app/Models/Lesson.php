<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $table = "lessons";

    protected $fillable = [
        'title',
        'teacher_id',
        'subject_id',
        'class_id',
        'room_id',
        'start',
        'end',
    ];

    public function teacher(): BelongsTo {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function subject(): BelongsTo {
        return $this->belongsTo(Subject::class, 'subject', 'id');
    }

    public function class(): BelongsTo {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function room(): BelongsTo {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
