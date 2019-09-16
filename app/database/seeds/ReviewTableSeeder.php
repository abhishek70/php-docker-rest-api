<?php

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;
use Models\Review;

class ReviewTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 * @throws BindingResolutionException
	 */
    public function run()
    {
    	Review::truncate();

		factory(Review::class, 20)->create();
    }
}
