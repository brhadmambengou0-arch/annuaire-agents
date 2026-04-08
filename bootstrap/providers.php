<?php

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;

return [
    AppServiceProvider::class,
    Fruitcake\LaravelDebugbar\ServiceProvider::class,
    //FortifyServiceProvider::class,
];
