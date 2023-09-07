<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    use HasFactory, HasRoles;

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

    public function grades(): HasManyThrough {
        return $this->hasManyThrough(Grade::class, User::class, 'id', 'student_id', 'user_id', 'id');
    }

    public function lessons(): HasOneOrMany {
        return $this->hasMany(Lesson::class, 'class_id', 'class_id');
    }

    public function assignments(): HasOneOrMany {
        return $this->hasMany(Assignment::class, 'class_id', 'class_id');
    }
}
