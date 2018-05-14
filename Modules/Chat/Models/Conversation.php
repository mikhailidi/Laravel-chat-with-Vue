<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id', 'type', 'user_from', 'user_to', 'participants', 'name', 'description'];
}
