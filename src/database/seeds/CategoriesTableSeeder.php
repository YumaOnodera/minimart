<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルのクリア
        DB::table('categories')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $categories = [
            ['category_name' => '本',
            'category_description' => '本は教養の源泉。あなたの人生を変えた本を紹介してください。',
            'category_url' => 'http://localhost:8888/category/book'
            ],
            ['category_name' => '雑貨',
            'category_description' => '日々の生活に彩をもたらす雑貨。オススメの雑貨をみんなに共有しましょう！',
            'category_url' => 'http://localhost:8888/category/daily-necessaties'
            ],
            ['category_name' => '化粧品',
            'category_description' => 'あなたのお気に入りの化粧品を紹介してください！',
            'category_url' => 'http://localhost:8888/category/cosmetics'
            ],
            ['category_name' => 'その他',
            'category_description' => 'いずれのカテゴリーにも当てはまらない商品はこちら！',
            'category_url' => 'http://localhost:8888/category/other'
            ]
        ];
        
        // 登録
        foreach($categories as $category) {
            \App\Category::create($category);
        }
    }
}
