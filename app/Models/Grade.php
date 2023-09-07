<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Grade extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grade';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
        'student_id',
        'assignment_id',
    ];

    public function student(): HasOneThrough {
        return $this->hasOneThrough(Student::class, User::class, 'id', 'user_id', 'student_id', 'id');
    }

    public function assignment(): BelongsTo {
        return $this->belongsTo(Assignment::class, 'assignment_id', 'id');
    }
}
