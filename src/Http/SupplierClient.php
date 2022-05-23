<?php

declare(strict_types=1);

namespace App\Http;

use App\Config;
use GuzzleHttp\Client;

class SupplierClient
{
    public const GET_DOCTOR_LIST_ENDPOINT ='/api/doctors';

    private Client $httpClient;
    private Config $config;

    public function __construct(Client $httpClient, Config $config)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
    }

    public function getDoctorArray(): array
    {
        $response = $this->httpClient->get(
            $this->getDoctorListEndpoint(),
            $this->getAuthentification()
        );

        return json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);
    }

    private function getAuthentification(): array
    {
        return [
            'auth' => [
                $this->config->getHttpUsername(),
                $this->config->getHttpPassword(),
            ]];
    }

    private function getDoctorListEndpoint(): string
    {
        return sprintf('%s/%s', $this->config->getSupplierDomain(), self::GET_DOCTOR_LIST_ENDPOINT);
    }
}
