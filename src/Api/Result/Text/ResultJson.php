<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

final class ResultJson extends AbstractText
{
    /**
     * @var string|null
     */
    protected $dateCheck;

    /**
     * @var float|null
     */
    protected $unique;

    /**
     * @var array|null
     */
    protected $urls;

    /**
     * @var string|null
     */
    protected $clearText;

    /**
     * @return string|null
     */
    public function dateCheck(): ?string
    {
        return $this->dateCheck;
    }

    /**
     * @return float|null
     */
    public function unique(): ?float
    {
        return (float) $this->unique;
    }

    /**
     * @return array|null
     */
    public function urls(): ?array
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
