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