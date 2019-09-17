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

        // 外部キー制約を一時的に外す
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // テーブルのクリア
        DB::table('users')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $users = [
            ['user_id' => 'laravel_taro',
            'user_name' => 'ララベル太郎',
            'introduction' => 'ララベル太郎です。本が好きです！',
            'user_img_src' => 'http://drive.google.com/uc?export=view&id=1r8xqTNns9hu8oZetRKjIm4QWOzPkt1lG',
            'email' => 'yuma.onodera0913@gmail.com',
            'password' => bcrypt('password')
            ],
            ['user_id' => 'laravel_hanako',
            'user_name' => 'ララベル花子',
            'introduction' => 'ララベル花子です。かわいいものが大好きです！',
            'user_img_src' => 'http://drive.google.com/uc?export=view&id=1VXSjz_1LfNmFjmAiXNWxNbXirxzS51GI',
            'email' => 'minimal.labo@gmail.com',
            'password' =>  bcrypt('password')
            ]
        ];

        // 登録
        foreach($users as $user) {
            \App\User::create($user);
        }

        // 外部キー制約を一時的に外す
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
