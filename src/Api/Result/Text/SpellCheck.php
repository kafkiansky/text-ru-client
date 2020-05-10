<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

final class SpellCheck extends AbstractText
{
    /**
     * @var string
     */
    protected $errorType;

    /**
     * @var string
     */
    protected $reason;

    /**
     * @var string
     */
    protected $errorText;

    /**
     * @var array|null
     */
    protected $replacements;

    /**
     * @var int
     */
    protected $start;

    /**
     * @var int
     */
    protected $end;

    /**
     * @return string
     */
    public function errorType(): string
    {
        return $this->errorType;
    }

    /**
     * @return string
     */
    public function reason(): string
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public function errorText(): string
    {
        return $this->errorText;
    }

    /**
     * @return array|null
     */
    public function replacements(): ?array
    {
        return $this->replacements;
    }

    /**
     * @return int
     */
    public function start(): int
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function end(): int
    {
        return $this->end;
    }
}
