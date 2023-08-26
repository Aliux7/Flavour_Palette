<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($menuId)
    {
        Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[1],
            'rating' => 5.0,
            'review_message' => 'Bagus makanan enak dan roger suka'
        ]);
        Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[0],
            'rating' => 5.0,
            'review_message' => 'Banyak'
        ]);
        Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[1],
            'rating' => 4.0,
            'review_message' => 'Murah'
        ]);
        Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[2],
            'rating' => 1.0,
            'review_message' => 'Kureng'
        ]);
        Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[3],
            'rating' => 5.0,
            'review_message' => 'Murah'
        ]);
        Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[3],
            'rating' => 3.5,
            'review_message' => 'Kureng'
        ]);
        Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[4],
            'rating' => 5.0,
            'review_message' => 'Makanan ini luar biasa! Rasanya enak dan menggugah selera.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[4],
            'rating' => 5.0,
            'review_message' => 'Saya sangat terkesan dengan kualitas makanan yang disajikan di sini.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[5],
            'rating' => 5.0,
            'review_message' => 'Saya akan merekomendasikan menu ini kepada semua orang.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[5],
            'rating' => 5.0,
            'review_message' => 'Porsi makanan yang disajikan sangatlah besar dan puas.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[6],
            'rating' => 5.0,
            'review_message' => 'Rasa bumbu pada menu ini sangatlah nikmat.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[6],
            'rating' => 5.0,
            'review_message' => 'Harga makanan di sini sangat terjangkau, tetapi kualitasnya tetap tinggi.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[7],
            'rating' => 5.0,
            'review_message' => 'Makanan di sini sangatlah lezat. Setiap gigitan memberikan kepuasan yang luar biasa.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[7],
            'rating' => 4.0,
            'review_message' => 'Porsi makanan yang disajikan sangatlah melimpah. Tidak akan membuat Anda kelaparan.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[8],
            'rating' => 5.0,
            'review_message' => 'Saya sangat merekomendasikan untuk mencoba menu ini'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[8],
            'rating' => 5.0,
            'review_message' => 'Saya senang dengan pengemasan katering online ini. Makanannya tiba dengan aman dan tetap segar.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[9],
            'rating' => 5.0,
            'review_message' => 'Katering ini benar-benar memperhatikan detail. Kemasan makanannya rapi dan terlihat menarik.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[9],
            'rating' => 5.0,
            'review_message' => 'Pesanan saya tiba tepat waktu dan makanan masih dalam kondisi segar. Layanan pengantaran yang sangat baik!'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[10],
            'rating' => 5.0,
            'review_message' => 'Menu iniluar biasa! Rasanya enak banget, bikin nagih terus.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[10],
            'rating' => 5.0,
            'review_message' => 'menunya juara! Gak pernah kecewa dengan variasi hidangannya.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[11],
            'rating' => 5.0,
            'review_message' => 'Rasa hidangannya pas banget di lidah. Bumbunya nendang tapi gak bikin eneg.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[11],
            'rating' => 5.0,
            'review_message' => 'Rasanya konsisten banget, tiap kali pesan selalu enak dan memuaskan.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[12],
            'rating' => 5.0,
            'review_message' => 'Penyajian makanannya cantik banget, jadi pengen langsung makan. Bukan cuma tampilan doang, rasanya juga oke!'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[12],
            'rating' => 5.0,
            'review_message' => 'Saya suka kualitas bahan makanannya. Segar dan berkualitas tinggi, bikin makan jadi lebih nikmat.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[13],
            'rating' => 5.0,
            'review_message' => 'Menu ini ramah buat anak-anak. Anak saya suka banget sama makanannya.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[13],
            'rating' => 5.0,
            'review_message' => 'Menu ini sangat cocok untuk acara sarapan'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[14],
            'rating' => 3.0,
            'review_message' => 'Paketnya cukup komplet, tetapi rasanya tidak selalu memuaskan.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[14],
            'rating' => 4.0,
            'review_message' => 'Kualitas makanan dalam menu katering online ini biasa saja. Tidak ada yang membuat saya terkesan secara khusus.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[15],
            'rating' => 5.0,
            'review_message' => 'Menu katering onlinenya top markotop! Rasanya enak parah, gak bisa berenti makan.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[15],
            'rating' => 5.0,
            'review_message' => 'Makanannya bikin puas maksimal, porsinya juga gak pelit.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[16],
            'rating' => 5.0,
            'review_message' => 'Rasanya enak banget. Bumbunya dapet, gak terlalu berlebihan.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[16],
            'rating' => 5.0,
            'review_message' => 'Tampilan makanannya keren banget, bikin pengen langsung makan. Rasanya juga gak kalah enak!'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[17],
            'rating' => 3.0,
            'review_message' => 'Menu katering online ini so-so saja. Ada beberapa hidangan yang enak, tapi ada juga yang biasa saja.'
        ]);
Review::create([
            'id' => Str::uuid()->toString(),
            'menu_id' => $menuId[17],
            'rating' => 4.0,
            'review_message' => 'Rasanya makanan ini standar. Tidak ada yang istimewa atau menonjol.'
        ]);
    }
}
