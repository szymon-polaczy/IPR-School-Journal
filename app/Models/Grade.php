<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    public function student(): BelongsTo {
        return $this->belongsTo(Student::class, 'id', 'student_id');
    }

    public function assignment(): BelongsTo {
        return $this->belongsTo(Assignment::class, 'id', 'assignment_id');
    }
}