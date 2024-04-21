<?php
namespace App\Services\API;

interface APIClientInterface
{
    public function get(string $url, array $params = []);
}
