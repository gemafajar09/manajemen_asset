<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\KategoriModel;

$factory->define(KategoriModel::class, function (Faker $faker) {
    return [
        'kategori_nama' => $faker->name,
    ];
});
