<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = new Item([
            'title'=> 'test',
            'content'=> 'test'
        ]);
        $item->save();

        $item = new Item([
            'title'=> 'test1',
            'content'=> 'test1'
        ]);
        $item->save();

        $item = new Item([
            'title'=> 'test2',
            'content'=> 'test2'
        ]);
        $item->save();


    }
}
