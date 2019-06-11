<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        $usersId = \App\Models\User::all()->pluck('id')->toArray();
        $categoriesId = \App\Models\Category::all()->pluck('id')->toArray();
        $faker = app(\Faker\Generator::class);
        $topics = factory(Topic::class)->times(50)->make()->each(function ($topic, $index) use ($usersId, $categoriesId, $faker) {
            $topic->user_id = $faker->randomElement($usersId);
            $topic->category_id = $faker->randomElement($categoriesId);
        });

        Topic::insert($topics->toArray());
    }

}

