<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        //取所有的用户ID, 如: [1,2,3,4]
        $user_ids = \App\Models\User::all()->pluck('id')->toArray();

        //取所有帖子ID, 如: [1,2,3,4]
        $topic_ids = \App\Models\Topic::all()->pluck('id')->toArray();

        //获取 faker 实例
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function ($reply, $index) use ($user_ids, $topic_ids, $faker) {

                //从用户ID数组中随机取出一个并赋值
                $reply->user_id = $faker->randomElement($user_ids);

                //从帖子ID数组中随机取出一个并赋值
                $reply->topic_id = $faker->randomElement($topic_ids);
            });

        // 将数据集合转换为数组，并插入到数据库中
        Reply::insert($replys->toArray());
    }

}

