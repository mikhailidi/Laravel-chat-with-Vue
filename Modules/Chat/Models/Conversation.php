<?php

namespace Modules\Chat\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Conversation extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id', 'type', 'user_from', 'user_to', 'participants', 'name', 'description'];

    public function message()
    {
        $this->hasMany(Message::class, 'conversation_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'user_from');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function toUser()
    {
        return $this->hasOne(User::class, 'id', 'user_to');
    }

    /**
     * @return mixed
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * @return mixed
     */
    public function getToUser()
    {
        return $this->toUser;
    }

    public static function getUsersConversation($idUserFrom, $idUserTo)
    {
        return \DB::table('conversations')->where([
            ['user_from', $idUserFrom],
            ['user_to', $idUserTo]
        ])->orWhere([
            ['user_from', $idUserTo],
            ['user_to', $idUserFrom]
        ])->first();
    }
}
