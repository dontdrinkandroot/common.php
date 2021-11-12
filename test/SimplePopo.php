<?php

namespace Dontdrinkandroot\Common;

class SimplePopo
{
    public string $stringProperty;

    public int $intProperty;

    public function __construct(string $property1, int $property2)
    {
        $this->stringProperty = $property1;
        $this->intProperty = $property2;
    }

    public function getStringProperty(): string
    {
        return $this->stringProperty;
    }

    public function setStringProperty(string $stringProperty): void
    {
        $this->stringProperty = $stringProperty;
    }

    public function getIntProperty(): int
    {
        return $this->intProperty;
    }

    public function setIntProperty(int $intProperty): void
    {
        $this->intProperty = $intProperty;
    }
}
