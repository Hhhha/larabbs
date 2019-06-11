<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        // 头像假数据
        $avatars = [
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];

        $users = factory(\App\Models\User::class)->times(10)->make()->each(function ($user, $index) use ($faker, $avatars){
            //  随机头像
            $user->avatar = $faker->randomElement($avatars);
        });
        //  让隐藏字段可见
        $userArray = $users->makeVisible(['password', 'remember_token'])->toArray();

        //  批量插入数据库
        \App\Models\User::insert($userArray);

        $user = \App\Models\User::find(1);
        $user->name = 'Lee';
        $user->avatar = 'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        $user->email = '377737058@qq.com';
        $user->save();
    }
}
