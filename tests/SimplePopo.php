<?php

namespace Dontdrinkandroot\Common;

class SimplePopo
{
    public function __construct(public string $stringProperty, public int $intProperty)
    {
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
