<?php

namespace Database\Seeders;

use App\Models\Menu_week_header;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MenuWeekHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < (500) ; $i++) {
            $menuWeekId[] = Str::uuid()->toString();
        }

        // Menu_week_header::create([
        //     'id' => $menuWeekId[0],
        //     'start_date' => '2023-05-22',
        //     'end_date' => '2023-05-28'
        // ]);
        // Menu_week_header::create([
        //     'id' => $menuWeekId[1],
        //     'start_date' => '2023-05-29',
        //     'end_date' => '2023-06-04'
        // ]);
        // Menu_week_header::create([
        //     'id' => $menuWeekId[2],
        //     'start_date' => '2023-06-05',
        //     'end_date' => '2023-06-11'
        // ]);
        // Menu_week_header::create([
        //     'id' => $menuWeekId[3],
        //     'start_date' => '2023-06-12',
        //     'end_date' => '2023-06-18'
        // ]);
        // Menu_week_header::create([
        //     'id' => $menuWeekId[4],
        //     'start_date' => '2023-06-19',
        //     'end_date' => '2023-06-25'
        // ]);
        // Menu_week_header::create([
        //     'id' => $menuWeekId[5],
        //     'start_date' => '2023-06-26',
        //     'end_date' => '2023-07-02'
        // ]);
        // Menu_week_header::create([
        //     'id' => $menuWeekId[6],
        //     'start_date' => '2023-07-03',
        //     'end_date' => '2023-07-09'
        // ]);
        // Menu_week_header::create([
        //     'id' => $menuWeekId[7],
        //     'start_date' => '2023-07-10',
        //     'end_date' => '2023-07-16'
        // ]);
        // Menu_week_header::create([
        //     'id' => $menuWeekId[8],
        //     'start_date' => '2023-07-17',
        //     'end_date' => '2023-07-23'
        // ]);
        // Menu_week_header::create([
        //     'id' => $menuWeekId[9],
        //     'start_date' => '2023-07-24',
        //     'end_date' => '2023-07-30'
        // ]);

        $faker = Faker::create();

        $startDate = '2023-06-01';
        $endDate = '2023-06-07';
        $dateDuration = [
            [
                'start' => $startDate,
                'end' => $endDate
            ],
        ];

        for ($i = 0; $i < 500; $i++) {
            $randomStartDate = date('Y-m-d', strtotime('+1 days', strtotime($dateDuration[$i]['end'])));
            $randomEndDate = date('Y-m-d', strtotime('+7 days', strtotime($dateDuration[$i]['end'])));

            $dateDuration[] = [
                'start' => $randomStartDate,
                'end' => $randomEndDate
            ];
        }

        for ($i = 0; $i < 500; $i++) {
            Menu_week_header::create([
                'id' => $menuWeekId[$i],
                'start_date' => $dateDuration[$i]['start'],
                'end_date' => $dateDuration[$i]['end']
            ]);
        }

        return $menuWeekId;
    }
}
