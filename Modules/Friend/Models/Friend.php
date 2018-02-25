<?php

namespace Modules\Friend\Models;

use Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'user_id', 'friend_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'friend_id');
    }

    public function getUser()
    {
        return $this->user;
    }
    

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $userId
     * @return Friend
     */
    public function setUserId($userId)
    {
        $this->user_id = (int)$userId;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getFriendId()
    {
        return $this->friend_id;
    }

    /**
     * @param int $friendId
     * @return Friend
     */
    public function setFriendId($friendId)
    {
        $this->friend_id = (int)$friendId;
        
        return $this;
    }
    
}
