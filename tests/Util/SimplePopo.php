<?php

namespace Dontdrinkandroot\Common\Util;

class SimplePopo
{
    use SimpleTrait;

    public function __construct(
        public string $stringProperty,
        public int $intProperty,
        protected bool $protectedProperty = false,
        private bool $privateProperty = false
    ) {
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

    public function getProtectedProperty(): bool
    {
        return $this->protectedProperty;
    }

    public function getPrivateProperty(): bool
    {
        return $this->privateProperty;
    }
}
