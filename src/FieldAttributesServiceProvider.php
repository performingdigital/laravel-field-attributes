<?php

namespace Performing\FieldAttributes;

use Illuminate\Support\ServiceProvider;

class FieldAttributesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/field-attributes.php' => config_path('field-attributes.php'),
        ], 'config');
    }
}
