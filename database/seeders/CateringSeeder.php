<?php

namespace Database\Seeders;

use App\Models\Catering;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CateringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run($sellerId)
    {
        $cateringId = Str::uuid()->toString();
        Catering::create([
            'id' => $cateringId,
            'user_id' => $sellerId[2],
            'name' => 'vijeckCatering',
            'description' => 'vijeckkkyyy',
            'store_rating' => 5,
            'halal_certification' => '1684813200.pdf',
            'business_permit' => '1684813200.pdf',
            'address' => 'Selokan Sudirman',
            'opening_hour' => '00:00:00',
            'closing_hour' => '00:00:00'
        ]);

        return $cateringId;
    }
}
