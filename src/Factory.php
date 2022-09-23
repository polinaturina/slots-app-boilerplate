<?php

declare(strict_types=1);

namespace App;

use App\Http\SupplierClient;
use GuzzleHttp\Client;

class Factory
{
    public function createSupplierClient(): SupplierClient
    {
        return new SupplierClient($this->createGuzzleClient(), $this->createConfig());
    }

    private function createGuzzleClient(): Client
    {
        return new Client();
    }

    private function createConfig(): Config
    {
        return new Config();
    }
}
