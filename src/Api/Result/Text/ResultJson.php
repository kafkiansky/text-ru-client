<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

final class ResultJson extends AbstractText
{
    /**
     * @var string
     */
    protected $dateCheck;

    /**
     * @var string
     */
    protected $unique;

    /**
     * @var array
     */
    protected $urls;

    /**
     * @var string|null
     */
    protected $clearText;

    /**
     * @return string
     */
    public function dateCheck(): string
    {
        return $this->dateCheck;
    }

    /**
     * @return string
     */
    public function unique(): string
    {
        return $this->unique;
    }

    /**
     * @return array
     */
    public function urls(): array
    {
        return $this->urls;
    }

    /**
     * @return string|null
     */
    public function clearText(): ?string
    {
        return $this->clearText;
    }
}
