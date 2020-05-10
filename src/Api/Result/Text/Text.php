<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

use Kafkiansky\TextRu\Api\Result\Result;

final class Text extends AbstractText implements Result
{
    /**
     * @var float
     */
    protected $textUnique;

    /**
     * @var ResultJson
     */
    protected $resultJson;

    /**
     * @var SpellCheck
     */
    protected $spellCheck;

    /**
     * @var SeoCheck
     */
    protected $seoCheck;

    /**
     * @return float
     */
    public function textUnique(): float
    {
        return $this->textUnique;
    }

    /**
     * @return ResultJson
     */
    public function resultJson(): ResultJson
    {
        return $this->resultJson;
    }

    /**
     * @return SpellCheck
     */
    public function spellCheck(): SpellCheck
    {
        return $this->spellCheck;
    }

    /**
     * @return SeoCheck
     */
    public function seoCheck(): SeoCheck
    {
        return $this->seoCheck;
    }
}
