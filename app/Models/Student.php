<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, int>
     */
    protected $fillable = [
        'user_id',
        'class_id',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function class(): BelongsTo {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}
