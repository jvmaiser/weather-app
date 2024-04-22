<?php
namespace App\Services\API;

/**
 * Interface for API client implementations.
 * @package App\Services\API\APIClientInterface
 * @author Jaybee Satulan <jaybeesatulan@gmail.com>
 */
interface APIClientInterface
{
    /**
     * Perform a GET request to the specified URL with optional parameters.
     * @param string $url
     * @param array $params
     * @return mixed
     */
    public function get(string $url, array $params = []);
}
