<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Entities\Pegawai::class, function (Faker $faker) {
    static $password;

    return [
        'nama' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
		'no_telepon' => $faker->ean8,
		'alamat' => $faker->address,
		'divisi' => ['', '', ''][rand(0, 1)],
    ];
});

$factory->define(App\Entities\Pelanggan::class, function (Faker $faker) {

    return [
        'nama_perusahaan' => $faker->company,
        'email' => $faker->unique()->safeEmail,
		'no_telepon' => $faker->ean8,
		'alamat' => $faker->address,
    ];
});

$factory->define(App\Entities\Supplier::class, function (Faker $faker) {

    return [
        'nama' => $faker->company,
        'email' => $faker->unique()->safeEmail,
        'no_telepon' => $faker->ean8,
        'alamat' => $faker->address,
    ];
});


$factory->define(App\Entities\Pesanan::class, function (Faker $faker) {

    $pelanggan = App\Entities\Pelanggan::inRandomOrder()->first();
    $pegawai = App\Entities\Pegawai::inRandomOrder()->first();

    return [
        'total_bayar' => 900000,
        'status' => ['lunas', 'belum lunas'][rand(0,1)],
        'pelanggan_id' => $pelanggan->id,
        'pegawai_id' => $pegawai->id,
        'tanggal' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];

});
