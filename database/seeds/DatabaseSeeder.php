<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        $user = new \App\User();
        $user->name = $faker->name;
        $user->email = $faker->unique()->safeEmail;
        $user->password = bcrypt('password');
        $user->remember_token = str_random(10);
        $user->save();

        $item = new \App\Item();
        $item->user_id = $user->id;
        $item->content = 'ブログ記事を書く';
        $item->save();

//        for ($i = 0; $i < 5; $i++) {
//            $item = new \App\Item();
//            $item->user_id = $user->id;
//            $item->content = $faker->text(100);
//            $item->save();
//        }
    }
}
