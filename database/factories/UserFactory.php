<?php

use App\Category;
use App\Product;
use App\Seller;
use App\Transaction;
use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        // 'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'password' => $faker->password ?: $faker->password = bcrypt('secret'),
        'verificated' => $verificated = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
        'verification_token' => $verificated == User::VERIFIED_USER ? null : User::generateVerificationToken(),
        'admin' => $admin = $faker->randomElements([User::ADMIN_USER, User::REGULAR_USER]),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement([Product::PRODUCT_AVAILABLE, Product::PRODUCT_UNAVAILABLE]),
        'image' => $faker->randomElement(['watch.jpg', 'smartphone.jpg', 'laptop.jpg']),
        'seller_id' => User::all()->first()->id(),
    ];
});

$factory->define(Transaction::class, function (Faker $faker) {

    $seller = Seller::has('products')->get()->random();
    $buyer = User::all()->except($seller->id)->random();
    return [
        'name' => $faker->word,
        'quantity' => $faker->numberBetween(1, $seller->quantity),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id,
    ];
});
