<?php

namespace BotConversa;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;

class ApiClient
{
    protected Client $client;
    protected string $apiKey;
    protected string $baseUrl = 'https://backend.botconversa.com.br/api/v1/webhook/';
    protected ?LoggerInterface $logger;

    public function __construct(string $apiKey, ?LoggerInterface $logger = null)
    {
        $this->apiKey = $apiKey;
        $this->logger = $logger;
        
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout'  => 10.0,
        ]);
    }

    protected function request(string $method, string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->request($method, $endpoint, [
                'headers' => [
                    'API-KEY' => $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($this->logger) {
                $this->logger->error('API Request Error: ' . $e->getMessage());
            }
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}