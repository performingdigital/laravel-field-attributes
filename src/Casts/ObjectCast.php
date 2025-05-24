<?php

declare(strict_types=1);

namespace Performing\FieldAttributes\Casts;

use Exception;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use ReflectionClass;

class ObjectCast implements Castable
{
    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes {
            public function get($model, string $key, $value, array $attributes)
            {
                $class = $model->type;
                $types = config('field-attributes.types');
                $class = array_key_exists($class, $types) ? $types[$class] : $class;

                if (class_exists($class) === false) {
                    throw new Exception(sprintf('Class %s does not exist.', $class));
                }

                $data = json_decode($value, true);

                $params = collect(new ReflectionClass($class)->getConstructor()->getParameters())
                    ->map
                    ->getName()
                    ->toArray();

                return new $class(...collect($data)->only($params)->toArray());
            }

            public function set($model, string $key, $value, array $attributes)
            {
                return collect($value)->toJson();
            }
        };
    }
}
