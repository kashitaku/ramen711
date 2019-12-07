<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
	$tags = ['しょう油', '塩', 'とんこつ', '味噌', 'つけ麺', 'その他'];
	foreach ($tags as $tag) app\Tag::create(['name' => $tag]);
    }
}
