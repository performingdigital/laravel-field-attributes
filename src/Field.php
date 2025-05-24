<?php

declare(strict_types = 1);

namespace Performing\FieldAttributes;

use Attribute;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Field
{
    protected ReflectionProperty $property;

    public function __construct(
        protected string $label,
        protected string $description = '',
        protected ?string $type = null,
    ) {}

    public function withProperty(ReflectionProperty $property): self
    {
        $this->property = $property;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getType(): string
    {
        return $this->type ?? $this->guessType();
    }

    protected function guessType(): string
    {
        return match ($this->property->getType()->getName()) {
            'string' => 'text',
            'int' => 'number',
            'bool' => 'checkbox',
            default => 'text',
        };
    }
}
