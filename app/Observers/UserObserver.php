<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function saving(User $user)
    {
        // 这样写扩展性更高，只有空的时候才指定默认头像
        if (empty($user->avatar)) {
            $user->avatar = 'https://iocaffcdn.phphub.org/uploads/images/201710/30/1/TrJS40Ey5k.png';
        }
    }

    public function updating(User $user)
    {
        //
    }

    public function deleted(User $user)
    {
        $topicsIds = $user->topics->pluck('id')->toArray();
        //  删除用户的话题
        \DB::table('topics')->whereIn('id', $topicsIds)->delete();
        //  删除用户发布话题下面的回复
        \DB::table('replies')->whereIn('topic_id', $topicsIds)->delete();
        //  删除用户的回复
        \DB::table('replies')->where('user_id', $user->id)->delete();
    }
}