<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

final class SpellCheck extends AbstractText
{
    /**
     * @var string|null
     */
    protected $errorType;

    /**
     * @var string|null
     */
    protected $reason;

    /**
     * @var string|null
     */
    protected $errorText;

    /**
     * @var array|null
     */
    protected $replacements;

    /**
     * @var int|null
     */
    protected $start;

    /**
     * @var int|null
     */
    protected $end;

    /**
     * @return string|null
     */
    public function errorType(): ?string
    {
        return $this->errorType;
    }

    /**
     * @return string|null
     */
    public function reason(): ?string
    {
        return $this->reason;
    }

    /**
     * @return string|null
     */
    public function errorText(): ?string
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
     * @return int|null
     */
    public function start(): ?int
    {
        return $this->start;
    }

    /**
     * @return int|null
     */
    public function end(): ?int
    {
        return $this->end;
    }
}
