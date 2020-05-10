<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

final class SpellCheck
{
    use Parameterizable;

    /**
     * @var string|null
     */
    private $errorType;

    /**
     * @var string|null
     */
    private $reason;

    /**
     * @var string|null
     */
    private $errorText;

    /**
     * @var array|null
     */
    private $replacements;

    /**
     * @var int|null
     */
    private $start;

    /**
     * @var int|null
     */
    private $end;

    public function __construct(array $payload)
    {
        $this->fillFromParameters($payload);
    }

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
