<?php

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
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
        DB::table('goods')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $goods = [
            ['goods_name' => 'お気に入りの本',
            'goods_description' => '素晴らしい本で感動した。みんなにオススメです',
            'category' => '1',
            'introducer' => '1',
            'goods_url' => 'https://www.amazon.co.jp/%E5%AB%8C%E3%82%8F%E3%82%8C%E3%82%8B%E5%8B%87%E6%B0%97%E2%80%95%E2%80%95%E2%80%95%E8%87%AA%E5%B7%B1%E5%95%93%E7%99%BA%E3%81%AE%E6%BA%90%E6%B5%81%E3%80%8C%E3%82%A2%E3%83%89%E3%83%A9%E3%83%BC%E3%80%8D%E3%81%AE%E6%95%99%E3%81%88-%E5%B2%B8%E8%A6%8B-%E4%B8%80%E9%83%8E/dp/4478025819/ref=sr_1_1?__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&keywords=%E5%AB%8C%E3%82%8F%E3%82%8C%E3%82%8B%E5%8B%87%E6%B0%97&qid=1568186774&s=gateway&sr=8-1',
            'goods_img_src' => 'https://images-fe.ssl-images-amazon.com/images/I/51pfi-lM-HL.jpg'
            ],
            ['goods_name' => 'お気に入りの雑貨',
            'goods_description' => '素晴らしい雑貨で感動した。デザインもいい',
            'category' => '2',
            'introducer' => '1',
            'goods_url' => 'https://www.amazon.co.jp/%E5%A4%A9%E7%84%B6%E7%B4%A0%E6%9D%90-%E3%83%95%E3%82%BF-%E3%83%90%E3%82%B9%E3%82%B1%E3%83%83%E3%83%88-%E3%83%AC%E3%83%BC%E3%82%B9-L%E3%82%B5%E3%82%A4%E3%82%BA/dp/B006IO50O8/ref=sr_1_1?__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&keywords=%E7%84%A1%E5%8D%B0%E8%89%AF%E5%93%81+%E3%81%8B%E3%81%94&qid=1568187033&rnid=2321267051&s=kitchen&sr=1-1',
            'goods_img_src' => 'https://images-na.ssl-images-amazon.com/images/I/71rcppjua2L._SX679_.jpg'
            ],
            ['goods_name' => 'お気に入りの化粧品',
            'goods_description' => '素晴らしい化粧品で感動した。すごく肌になじむ',
            'category' => '3',
            'introducer' => '2',
            'goods_url' => 'https://www.amazon.co.jp/%E7%84%A1%E5%8D%B0%E8%89%AF%E5%93%81-%E3%83%9B%E3%83%9B%E3%83%90%E3%82%AA%E3%82%A4%E3%83%AB-JOJOBA-OIL-100ml/dp/B016QPX8CY/ref=sr_1_3?__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&crid=MAJ0MVIXD7H3&keywords=%E3%83%9B%E3%83%9B%E3%83%90%E3%82%AA%E3%82%A4%E3%83%AB+%E7%84%A1%E5%8D%B0%E8%89%AF%E5%93%81&qid=1568187100&s=gateway&sprefix=%E3%83%9B%E3%83%9B%E3%83%90%E3%82%AA%E3%82%A4%E3%83%AB%E3%80%80%E7%84%A1%E5%8D%B0%2Caps%2C296&sr=8-3',
            'goods_img_src' => 'https://images-na.ssl-images-amazon.com/images/I/51tY%2BVhyIyL._SX679_.jpg'
            ]
        ];
        
        // 登録
        foreach($goods as $item) {
            \App\Goods::create($item);
        }

        // 外部キー制約を一時的に外す
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
