<?php

namespace App\Providers;

use App\Contracts\ClubUserRepositoryContract;
use App\Contracts\UserRepositoryContract;
use App\Repositories\ClubUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $bindings = [
        ClubUserRepositoryContract::class => ClubUserRepository::class,
        UserRepositoryContract::class => UserRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        //Model::unguard();

        // Об'єднання масивів
        // (перенесено з Yii2)
        \Arr::macro('merge', static function(){
            $args = func_get_args();
            $res = array_shift($args);
            while (!empty($args)) {
                foreach (array_shift($args) as $k => $v) {
                    if (is_int($k)) {
                        if (array_key_exists($k, $res)) {
                            $res[] = $v;
                        } else {
                            $res[$k] = $v;
                        }
                    } elseif (is_array($v) && isset($res[$k]) && is_array($res[$k])) {
                        $res[$k] = \Arr::merge($res[$k], $v);
                    } else {
                        $res[$k] = $v;
                    }
                }
            }

            return $res;
        });
    }
}
