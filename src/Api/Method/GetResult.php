<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Method;

use Kafkiansky\TextRu\Api\Method;
use Kafkiansky\TextRu\Api\Result\Text\Text;

final class GetResult implements Method
{
    /**
     * @var string
     */
    private $uid;

    /**
     * @var string|null
     */
    private $detail;

    /**
     * @param string $uid
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $uid)
    {
        if ('' === $uid) {
            throw new \InvalidArgumentException('Text uid cannot be empty');
        }

        $this->uid = $uid;
    }

    /**
     * @return GetResult
     */
    public function detail(): self
    {
        $this->detail = 'detail';

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function method(): string
    {
        return 'post';
    }

    /**
     * {@inheritDoc}
     */
    public function mappedClass(): string
    {
        return Text::class;
    }

    /**
     * {@inheritDoc}
     */
    public function payload(): array
    {
        return \array_filter([
            'uid'         => $this->uid,
            'jsonvisible' => $this->detail,
        ]);
    }
}
