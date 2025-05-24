<?php

declare(strict_types = 1);

namespace Performing\FieldAttributes;

use ReflectionClass;

trait HasFieldAttributes
{
    public function getFieldValues(): array
    {
        $reflection = new ReflectionClass($this);
        $variables = [];

        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(Field::class);
            if (count($attributes) > 0) {
                $variables[$property->getName()] = $property->getValue($this);
            }
        }

        return $variables;
    }

    public function getFieldDefinitions(): array
    {
        $reflection = new ReflectionClass($this);
        $variables = [];

        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(Field::class);
            $label = null;
            $description = null;
            $type = null;

            foreach ($attributes as $attribute) {
                $attribute = $attribute->newInstance()->withProperty($property);
                $label = __($attribute->getLabel());
                $description = __($attribute->getDescription());
                $type = $attribute->getType();
            }

            if (count($attributes) > 0) {
                $variables[] = [
                    'label' => $label,
                    'type' => $type,
                    'handle' => $property->getName(),
                    'description' => $description,
                    'value' => $property->getValue($this),
                ];
            }
        }

        return $variables;
    }
}
