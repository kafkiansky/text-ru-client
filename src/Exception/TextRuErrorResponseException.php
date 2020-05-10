<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Exception;

use Throwable;

final class TextRuErrorResponseException extends \Exception
{
    /**
     * @var int
     */
    private $errorCode;

    /**
     * @var string
     */
    private $errorText;

    private function __construct(int $errorCode, string $errorText, $message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($errorText, $errorCode, $previous);
        $this->errorCode = $errorCode;
        $this->errorText = $errorText;
    }

    /**
     * @param int    $errorCode
     * @param string $errorText
     *
     * @return TextRuErrorResponseException
     */
    public static function forError(int $errorCode, string $errorText): self
    {
        return new self($errorCode, $errorText);
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorText(): string
    {
        return $this->errorText;
    }
}
