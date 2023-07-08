<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model {
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teacher';

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function default_room(): BelongsTo {
        return $this->belongsTo(Room::class, 'id', 'default_room_id');
    }
}
