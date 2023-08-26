<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $userSeeder = new UserSeeder();
        $userId = $userSeeder->run();
        $cateringSeeder = new CateringSeeder();
        $cateringId = $cateringSeeder->run($userId);
        $menuSeeder = new MenuSeeder();
        $menuId = $menuSeeder->run($cateringId);
        $reviewSeeder = new ReviewSeeder();
        $reviewSeeder->run($menuId);
        $categorySeeder = new CategorySeeder();
        $categoryId = $categorySeeder->run();
        $menuCategorySeeder = new MenuCategorySeeder();
        $menuCategorySeeder->run($menuId, $categoryId);
        $menuWeekHeaderSeeder = new MenuWeekHeaderSeeder();
        $menuWeekHeaderId = $menuWeekHeaderSeeder->run();
        $menuWeekDetailSeeder = new MenuWeekDetailSeeder();
        $menuWeekDetailSeeder->run($menuWeekHeaderId, $menuId);
        // $cartSeeder = new CartSeeder();
        // $cartSeeder->run($userId, $menuId);
    }
}
