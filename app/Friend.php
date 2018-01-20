<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'user_id', 'friend_id'
    ];
    

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
