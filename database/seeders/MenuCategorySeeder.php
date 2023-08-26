<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\menu_category;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($menuId,$categoryId)
    {
        // menu_category::create([
        //     'menu_id' => $menuId[0],
        //     'category_id' => $categoryId[0]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[0],
        //     'category_id' => $categoryId[1]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[0],
        //     'category_id' => $categoryId[2]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[1],
        //     'category_id' => $categoryId[1]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[1],
        //     'category_id' => $categoryId[0]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[1],
        //     'category_id' => $categoryId[2]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[2],
        //     'category_id' => $categoryId[3]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[2],
        //     'category_id' => $categoryId[4]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[3],
        //     'category_id' => $categoryId[5]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[4],
        //     'category_id' => $categoryId[6]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[5],
        //     'category_id' => $categoryId[7]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[6],
        //     'category_id' => $categoryId[0]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[7],
        //     'category_id' => $categoryId[1]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[8],
        //     'category_id' => $categoryId[1]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[9],
        //     'category_id' => $categoryId[2]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[10],
        //     'category_id' => $categoryId[3]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[10],
        //     'category_id' => $categoryId[2]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[10],
        //     'category_id' => $categoryId[1]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[11],
        //     'category_id' => $categoryId[3]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[12],
        //     'category_id' => $categoryId[3]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[13],
        //     'category_id' => $categoryId[3]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[14],
        //     'category_id' => $categoryId[3]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[15],
        //     'category_id' => $categoryId[3]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[16],
        //     'category_id' => $categoryId[3]
        // ]);
        // menu_category::create([
        //     'menu_id' => $menuId[17],
        //     'category_id' => $categoryId[3]
        // ]);

        $usedCombinations = [];

        for ($i = 0; $i < 50; $i++) {
            do {
                $menuIdIndex = mt_rand(0, 50); // Generate a random index for menu_id
                $categoryIdIndex = mt_rand(0, 9); // Generate a random category_id

                $combination = $menuId[$menuIdIndex] . '-' . $categoryId[$categoryIdIndex];
            } while (in_array($combination, $usedCombinations));

            $usedCombinations[] = $combination;

            menu_category::create([
                'menu_id' => $menuId[$menuIdIndex],
                'category_id' => $categoryId[$categoryIdIndex]
            ]);
        }

    }
}
