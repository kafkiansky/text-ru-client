<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

use Kafkiansky\TextRu\Api\Result\Result;

final class Text extends AbstractText implements Result
{
    /**
     * @var float|null
     */
    protected $textUnique;

    /**
     * @var ResultJson|null
     */
    protected $resultJson;

    /**
     * @var SpellCheckCollection|null
     */
    protected $spellCheck;

    /**
     * @var SeoCheck|null
     */
    protected $seoCheck;

    /**
     * @return float|null
     */
    public function textUnique(): ?float
    {
        return (float) $this->textUnique;
    }

    /**
     * @return ResultJson|null
     */
    public function resultJson(): ?ResultJson
    {
        return $this->resultJson;
    }

    /**
     * @return SpellCheckCollection|null
     */
    public function spellCheck(): ?SpellCheckCollection
    {
        return $this->spellCheck;
    }

    /**
     * @return SeoCheck|null
     */
    public function seoCheck(): ?SeoCheck
    {
        return $this->seoCheck;
    }
}
