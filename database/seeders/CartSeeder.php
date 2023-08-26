<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user_id, $menu_id)
    {
        $cart_id = [Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString(), Str::uuid()->toString()];

        Cart::create([
            'id' => $cart_id[0],
            'user_id' => $user_id[0],
            'menu_id' => $menu_id[0],
            'quantity' => 1,
            'available_date' => '2023-06-15'
        ]);
        Cart::create([
            'id' => $cart_id[1],
            'user_id' => $user_id[1],
            'menu_id' => $menu_id[1],
            'quantity' => 7,
            'available_date' => '2023-06-14'
        ]);
        Cart::create([
            'id' => $cart_id[2],
            'user_id' => $user_id[0],
            'menu_id' => $menu_id[2],
            'quantity' => 3,
            'available_date' => '2023-06-17'
        ]);
        Cart::create([
            'id' => $cart_id[3],
            'user_id' => $user_id[1],
            'menu_id' => $menu_id[3],
            'quantity' => 2,
            'available_date' => '2023-06-15'
        ]);
        Cart::create([
            'id' => $cart_id[4],
            'user_id' => $user_id[0],
            'menu_id' => $menu_id[4],
            'quantity' => 11,
            'available_date' => '2023-06-13'
        ]);
        Cart::create([
            'id' => $cart_id[5],
            'user_id' => $user_id[1],
            'menu_id' => $menu_id[5],
            'quantity' => 2,
            'available_date' => '2023-06-14'
        ]);
    }
}
