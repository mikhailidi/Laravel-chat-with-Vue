<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Friend\Models\Friend;
use Modules\Friend\Models\FriendRequest;
use Modules\User\Models\User;

class Message extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message', 'user_id', 'conversation_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
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
     * @return Message
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * @return int
     */
    public function getConversationId()
    {
        return $this->conversation_id;
    }

    /**
     * @param int $conversationId
     * @return Message
     */
    public function setConversationId($conversationId)
    {
        $this->conversation_id = $conversationId;

        return $this;
    }

}
