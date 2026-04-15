<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TicketTailorService
{
    public function getEvents()
    {
        $apiKey = config('services.ticket_tailor.api_key');
        $baseUrl = config('services.ticket_tailor.base_url');

        $response = Http::withBasicAuth($apiKey, '')
            ->get($baseUrl . '/v1/events');

        if ($response->failed()) {
            throw new \Exception('Error en API: ' . $response->body());
        }

        return $response->json();
    }
}