<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\TextUid;

use Kafkiansky\TextRu\Api\Result\Result;

final class TextUid implements Result
{
    /**
     * @var string
     */
    private $textUid;

    public function __construct(string $textUid)
    {
        $this->textUid = $textUid;
    }

    /**
     * @return string
     */
    public function textUid(): string
    {
        return $this->textUid;
    }
}
