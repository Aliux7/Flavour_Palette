<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public $categoryId;
     public $categoryId1;
     public $categoryId2;

    public function run()
    {
        //
        $categoryId = [Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString()];

        category::create([
            'id' => $categoryId[0],
            'name' => 'Protein'
        ]);
        category::create([
            'id' => $categoryId[1],
            'name' => 'Fat'
        ]);
        category::create([
            'id' => $categoryId[2],
            'name' => 'Dairy'
        ]);
        category::create([
            'id' => $categoryId[3],
            'name' => 'Vegan'
        ]);
        category::create([
            'id' => $categoryId[4],
            'name' => 'Spicy'
        ]);
        category::create([
            'id' => $categoryId[5],
            'name' => 'Nut Free'
        ]);
        category::create([
            'id' => $categoryId[6],
            'name' => 'Seafood Free'
        ]);
        category::create([
            'id' => $categoryId[7],
            'name' => 'Halal'
        ]);
        category::create([
            'id' => $categoryId[8],
            'name' => 'Fruit'
        ]);
        category::create([
            'id' => $categoryId[9],
            'name' => 'Oils & Solid Fats'
        ]);
        return $categoryId;
    }
}
