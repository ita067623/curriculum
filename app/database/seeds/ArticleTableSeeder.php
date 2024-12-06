<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleTableSeeder extends Seeder
{
    public function run()
    {
        // ファクトリを使用して10件のデータを挿入
        Article::factory()->count(10)->create();
    }
}
