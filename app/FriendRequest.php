<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
