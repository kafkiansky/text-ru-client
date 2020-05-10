<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

final class SeoCheck extends AbstractText
{
    /**
     * @var int
     */
    protected $countCharsWithSpace;

    /**
     * @var int
     */
    protected $countCharsWithoutSpace;

    /**
     * @var int
     */
    protected $countWords;

    /**
     * @var float
     */
    protected $waterPercent;

    /**
     * @var float
     */
    protected $spamPercent;

    /**
     * @var array
     */
    protected $mixedWords;

    /**
     * @var array
     */
    protected $listKeys;

    /**
     * @var array
     */
    protected $listKeysGroup;

    /**
     * @return int
     */
    public function countCharsWithSpace(): int
    {
        return $this->countCharsWithSpace;
    }

    /**
     * @return int
     */
    public function countCharsWithoutSpace(): int
    {
        return $this->countCharsWithoutSpace;
    }

    /**
     * @return int
     */
    public function countWords(): int
    {
        return $this->countWords;
    }

    /**
     * @return float
     */
    public function waterPercent(): float
    {
        return $this->waterPercent;
    }

    /**
     * @return float
     */
    public function spamPercent(): float
    {
        return $this->spamPercent;
    }

    /**
     * @return array
     */
    public function mixedWords(): array
    {
        return $this->mixedWords;
    }

    /**
     * @return array
     */
    public function listKeys(): array
    {
        return $this->listKeys;
    }

    /**
     * @return array
     */
    public function listKeysGroup(): array
    {
        return $this->listKeysGroup;
    }
}
