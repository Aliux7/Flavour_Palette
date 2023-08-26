<?php

namespace Database\Seeders;

use App\Models\menu_week_detail;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
class MenuWeekDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($menuWeekHeaderId, $menuId)
    {
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[0],
        //     'menu_id' => $menuId[0],
        //     'available_date' => '2023-05-26'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[0],
        //     'menu_id' => $menuId[1],
        //     'available_date' => '2023-05-26'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[0],
        //     'menu_id' => $menuId[2],
        //     'available_date' => '2023-05-27'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[0],
        //     'menu_id' => $menuId[3],
        //     'available_date' => '2023-05-27'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[0],
        //     'menu_id' => $menuId[4],
        //     'available_date' => '2023-05-28'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[1],
        //     'menu_id' => $menuId[5],
        //     'available_date' => '2023-05-29'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[1],
        //     'menu_id' => $menuId[6],
        //     'available_date' => '2023-05-29'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[1],
        //     'menu_id' => $menuId[7],
        //     'available_date' => '2023-05-30'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[1],
        //     'menu_id' => $menuId[8],
        //     'available_date' => '2023-05-30'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[1],
        //     'menu_id' => $menuId[9],
        //     'available_date' => '2023-05-31'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[1],
        //     'menu_id' => $menuId[10],
        //     'available_date' => '2023-06-01'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[1],
        //     'menu_id' => $menuId[11],
        //     'available_date' => '2023-06-02'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[1],
        //     'menu_id' => $menuId[12],
        //     'available_date' => '2023-06-02'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[1],
        //     'menu_id' => $menuId[13],
        //     'available_date' => '2023-06-04'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[2],
        //     'menu_id' => $menuId[14],
        //     'available_date' => '2023-06-05'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[2],
        //     'menu_id' => $menuId[15],
        //     'available_date' => '2023-06-06'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[2],
        //     'menu_id' => $menuId[16],
        //     'available_date' => '2023-06-07'
        // ]);
        // menu_week_detail::create([
        //     'week_id' => $menuWeekHeaderId[2],
        //     'menu_id' => $menuId[17],
        //     'available_date' => '2023-06-08'
        // ]);

        $faker = Faker::create();

        $startDate = strtotime('2023-06-01');
        $dateStarts = [];

        for ($i = 0; $i < 3600; $i++) {
            $date = date('Y-m-d', strtotime('+' . $i . ' days', $startDate));
            $dateStarts[] = $date;
        }

        $j=0;
        $counter=0;
        for ($i = 0; $i < 500; $i++) {
            for ($j = 0; $j < 7; $j++){
                $randomNumbers = [];
                for ($k = 0; $k < 20; $k++) {
                    $randomNumber = rand(0, 50);
                    while (in_array($randomNumber, $randomNumbers)) {
                        $randomNumber = rand(1, 50);
                    }

                    $randomNumbers[$k] = $randomNumber;
                }
                for($l = 0; $l < $faker->numberBetween(3, 15); $l++){
                    menu_week_detail::create([
                        'week_id' => $menuWeekHeaderId[$i],
                        'menu_id' => $menuId[$randomNumbers[$l]],
                        'available_date' => $dateStarts[$counter]
                    ]);
                }
                $counter++;
            }
        }
    }
}
