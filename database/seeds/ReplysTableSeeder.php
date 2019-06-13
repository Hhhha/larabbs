<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        $usersIds = \App\Models\User::all()->pluck('id')->toArray();
        $topicsIds = \App\Models\Topic::all()->pluck('id')->toArray();
        $faker = app(\Faker\Generator::class);
        $replys = factory(Reply::class)->times(500)->make()->each(function ($reply, $index) use ($faker, $usersIds, $topicsIds) {
            $reply->user_id = $faker->randomElement($usersIds);
            $reply->topic_id = $faker->randomElement($topicsIds);
        });

        Reply::insert($replys->toArray());
    }

}

