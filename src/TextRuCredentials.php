<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu;

final class TextRuCredentials
{
    /**
     * @var string
     */
    private $userKey;

    /**
     * @param string $userKey
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $userKey)
    {
        if ('' === $userKey) {
            throw new \InvalidArgumentException('UserKey cannot be empty');
        }

        if (false === (bool) \preg_match($pattern = '/[A-Za-z0-9]+/', $userKey)) {
            throw new \InvalidArgumentException(\sprintf('UserKey must match regex: %s', $pattern));
        }

        $this->userKey = $userKey;
    }

    /**
     * @return string
     */
    public function userKey(): string
    {
        return $this->userKey;
    }
}
