<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

final class SeoCheck extends AbstractText
{
    /**
     * @var int|null
     */
    protected $countCharsWithSpace;

    /**
     * @var int|null
     */
    protected $countCharsWithoutSpace;

    /**
     * @var int|null
     */
    protected $countWords;

    /**
     * @var float|null
     */
    protected $waterPercent;

    /**
     * @var float|null
     */
    protected $spamPercent;

    /**
     * @var array|null
     */
    protected $mixedWords;

    /**
     * @var array|null
     */
    protected $listKeys;

    /**
     * @var array|null
     */
    protected $listKeysGroup;

    /**
     * @return int
     */
    public function countCharsWithSpace(): ?int
    {
        return $this->countCharsWithSpace;
    }

    /**
     * @return int|null
     */
    public function countCharsWithoutSpace(): ?int
    {
        return $this->countCharsWithoutSpace;
    }

    /**
     * @return int|null
     */
    public function countWords(): ?int
    {
        return $this->countWords;
    }

    /**
     * @return float|null
     */
    public function waterPercent(): ?float
    {
        return (float) $this->waterPercent;
    }

    /**
     * @return float|null
     */
    public function spamPercent(): ?float
    {
        return (float) $this->spamPercent;
    }

    /**
     * @return array|null
     */
    public function mixedWords(): ?array
    {
        return $this->mixedWords;
    }

    /**
     * @return array|null
     */
    public function listKeys(): ?array
    {
        return $this->listKeys;
    }

    /**
     * @return array|null
     */
    public function listKeysGroup(): ?array
    {
        return $this->listKeysGroup;
    }
}
