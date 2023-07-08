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

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function class(): BelongsTo {
        return $this->belongsTo(ClassModel::class, 'id', 'class_id');
    }
}
