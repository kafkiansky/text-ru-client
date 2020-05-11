<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

use function GuzzleHttp\json_decode;

final class SpellCheckCollection
{
    /**
     * @var array<SpellCheck>|null
     */
    private $spells = [];

    public function __construct($payload)
    {
        if (!empty($payload)) {
            $this->populate($payload);
        }
    }

    /**
     * @param $payload
     */
    private function populate($payload): void
    {
        if (\is_string($payload)) {
            $payload = json_decode($payload, true);
        }

        foreach ($payload as $spellBody) {
            $this->spells[] = new SpellCheck($spellBody);
        }
    }

    /**
     * @return array<SpellCheck>|null
     */
    public function getSpells(): ?array
    {
        return $this->spells;
    }

    /**
     * @return SpellCheck|null
     */
    public function first(): ?SpellCheck
    {
        if (!empty($this->spells)) {
            return \reset($this->spells);
        }

        return null;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return \count($this->spells);
    }
}
