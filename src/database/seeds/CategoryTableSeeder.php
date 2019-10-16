<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルのクリア
        DB::table('category')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $categorys = [
            ['category_name' => '本',
            'category_description' => '本は教養の源泉。あなたの人生を変えた本を紹介してください。',
            'category_url' => 'http://localhost:8888/category/book'
            ],
            ['category_name' => '雑貨',
            'category_description' => '日々の生活に彩をもたらす雑貨。オススメの雑貨をみんなに共有しましょう！',
            'category_url' => 'http://localhost:8888/category/daily-necessaties'
            ],
            ['category_name' => '化粧品',
            'category_description' => '美しさの定義は時代とともに変わってきた。しかし変わらないこともある。美しい人は古今東西に限らず「モテる」ということだ。',
            'category_url' => 'http://localhost:8888/category/cosmetics'
            ],
            ['category_name' => 'その他',
            'category_description' => 'いずれのカテゴリーにも当てはまらない斬新かつ画期的な商品はこのカテゴリーに分類されるのだ。',
            'category_url' => 'http://localhost:8888/category/other'
            ]
        ];
        
        // 登録
        foreach($categorys as $category) {
            \App\Category::create($category);
        }
    }
}
