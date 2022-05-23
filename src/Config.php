<?php

declare(strict_types=1);

namespace App;

final class Config
{
    public function getSupplierDomain(): string
    {
        return $this->getFromEnvironment('SUPPLIER_DOMAIN');
    }

    public function getHttpUsername(): string
    {
        return $this->getFromEnvironment('HTTP_USERNAME');
    }

    public function getHttpPassword(): string
    {
        return $this->getFromEnvironment('HTTP_PASSWORD');
    }

    private function getFromEnvironment(string $name): string
    {
        $value = $_ENV[$name];
        if ($value === false) {
            $message = sprintf('Unable to read "%s" from Environment', $name);
            throw new RuntimeException($message);
        }

        return $value;
    }
}
