<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Method;

use Kafkiansky\TextRu\Api\Method;
use Kafkiansky\TextRu\Api\Result\TextUid\TextUid;

final class Message implements Method
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var array|null
     */
    private $exceptDomain;

    /**
     * @var array|null
     */
    private $exceptUrl;

    /**
     * @var string|null
     */
    private $callback;

    /**
     * @var string|null
     */
    private $visible;

    /**
     * @var string|null
     */
    private $copying;

    /**
     * @param string $text
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $text)
    {
        if ('' === $text) {
            throw new \InvalidArgumentException('Message text cannot be empty');
        }

        if (100 > \mb_strlen($text) || 150000 < \mb_strlen($text)) {
            throw new \InvalidArgumentException(\sprintf(
                'Text length must be between 100 and 150000 chars, now is %d',
                \mb_strlen($text)
            ));
        }

        $this->text = $text;
    }

    /**
     * @param array $exceptDomains
     *
     * @return $this
     */
    public function withExceptDomain(array $exceptDomains): self
    {
        $this->exceptDomain = $exceptDomains;

        return $this;
    }

    /**
     * @param array $exceptUrl
     *
     * @return $this
     */
    public function withExceptUrl(array $exceptUrl): self
    {
        $this->exceptUrl = $exceptUrl;

        return $this;
    }

    /**
     * @param string $callback
     *
     * @return $this
     */
    public function withCallback(string $callback): self
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * @return $this
     */
    public function visible(): self
    {
        $this->visible = 'vis_on';

        return $this;
    }

    /**
     * @return $this
     */
    public function copying(): self
    {
        $this->copying = 'noadd';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function method(): string
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function mappedClass(): string
    {
        return TextUid::class;
    }

    /**
     * {@inheritdoc}
     */
    public function payload(): array
    {
        return \array_filter([
            'text'         => $this->text,
            'exceptdomain' => \implode(',', $this->exceptDomain ?? []),
            'excepturl'    => \implode(',', $this->exceptUrl ?? []),
            'visible'      => $this->visible,
            'copying'      => $this->copying,
            'callback'     => $this->callback,
        ]);
    }
}
