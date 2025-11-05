<?php
declare(strict_types=1);

namespace App\Service;

/**
 * Petit client Open Library (search + détail)
 */
class OpenLibrary
{
    private const BASE = 'https://openlibrary.org';
    private const AGENT = 'Bibliotheque-MVC/1.0 (contact@monsite.fr)';

    public function search(string $q): array
    {
        $url = self::BASE . '/search.json?q=' . urlencode($q);
        return $this->get($url);
    }

    public function getByKey(string $key): ?array
    {
        $url = self::BASE . $key . '.json';
        return $this->get($url) ?: null;
    }

    public function coverUrl(string $coverId, string $size = 'M'): string
    {
        return "https://covers.openlibrary.org/b/id/{$coverId}-{$size}.jpg";
    }

    private function get(string $url): array
    {
        $ctx = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => 'User-Agent: ' . self::AGENT,
                'timeout' => 5,
            ],
        ]);
        $json = @file_get_contents($url, false, $ctx);
        return $json ? json_decode($json, true) : [];
    }
}