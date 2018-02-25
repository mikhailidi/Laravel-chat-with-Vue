<?php

namespace Modules\Friend\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class FriendRequest extends Model
{
    protected $fillable = [
        'from_user', 'to_user'
    ];

    public function toUser()
    {
        return $this->hasOne(User::class, 'id', 'to_user');
    }

    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'from_user');
    }

    public function getFromUser()
    {
        return $this->fromUser;
    }

    public function getToUser()
    {
        return $this->toUser;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;

        return $this;
    }

}
