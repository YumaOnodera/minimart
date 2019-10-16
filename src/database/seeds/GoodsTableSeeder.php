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
            ['goods_name' => '速習 Laravel 6 速習シリーズ',
            'goods_description' => '本書は、PHPフレームワークであるLaravelについて短時間で概要を掴みたい方のための書籍です。9個のPartに分けて、Laravelの基本からテンプレート開発、データベース連携、リクエスト／レスポンス処理、ルーティング設定までを、サンプルコードと共に詳しく解説しています。',
            'category' => '1',
            'introducer' => '1',
            'goods_url' => 'https://www.amazon.co.jp/%E9%80%9F%E7%BF%92-Laravel-6-%E9%80%9F%E7%BF%92%E3%82%B7%E3%83%AA%E3%83%BC%E3%82%BA-%E5%B1%B1%E7%94%B0%E7%A5%A5%E5%AF%9B-ebook/dp/B07XC2QL4M/ref=sr_1_1?__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&keywords=%E3%83%A9%E3%83%A9%E3%83%99%E3%83%AB6&qid=1568791072&sr=8-1',
            'goods_img_src' => 'https://images-fe.ssl-images-amazon.com/images/I/51aBM9yf2LL.jpg'
            ],
            ['goods_name' => '天然素材 フタ 付き かご 収納 バスケット レース Lサイズ',
            'goods_description' => 'タオルなど中の物がカゴに引っかかったり、傷ついたりせず収納できます。内布はバスケットから取り外してお洗濯できるのでいつも清潔に使えます。',
            'category' => '2',
            'introducer' => '1',
            'goods_url' => 'https://www.amazon.co.jp/%E5%A4%A9%E7%84%B6%E7%B4%A0%E6%9D%90-%E3%83%95%E3%82%BF-%E3%83%90%E3%82%B9%E3%82%B1%E3%83%83%E3%83%88-%E3%83%AC%E3%83%BC%E3%82%B9-L%E3%82%B5%E3%82%A4%E3%82%BA/dp/B006IO50O8/ref=sr_1_1?__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&keywords=%E7%84%A1%E5%8D%B0%E8%89%AF%E5%93%81+%E3%81%8B%E3%81%94&qid=1568187033&rnid=2321267051&s=kitchen&sr=1-1',
            'goods_img_src' => 'https://images-na.ssl-images-amazon.com/images/I/71rcppjua2L._SX679_.jpg'
            ],
            ['goods_name' => '無印良品 ホホバオイル JOJOBA OIL 100ml',
            'goods_description' => 'ホホバ種子から搾ったオイルを化粧用に精製。 さらっとした使用感で、保湿、マッサージ、頭皮のお手入れに適しています。',
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

        // 外部キー制約を元に戻す
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
