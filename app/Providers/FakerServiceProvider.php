<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(\Faker\Generator::class, function () {
            $faker = \Faker\Factory::create();
            $faker->addProvider(new \Bezhanov\Faker\Provider\Team($faker));
            return $faker;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
