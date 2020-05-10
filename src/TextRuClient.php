<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Kafkiansky\TextRu\Api\Method;
use Kafkiansky\TextRu\Api\Result\Result;
use Kafkiansky\TextRu\Denormalizer\ChainDenormalizer;
use Kafkiansky\TextRu\Exception\TextRuApiErrorException;
use Kafkiansky\TextRu\Exception\TextRuErrorResponseException;
use function GuzzleHttp\json_decode;

final class TextRuClient
{
    private const TEXT_RU_ENDPOINT = 'http://api.text.ru/%s';

    /**
     * @var TextRuCredentials
     */
    private $credentials;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var ChainDenormalizer
     */
    private $denormalizer;

    public function __construct(TextRuCredentials $credentials, ClientInterface $client)
    {
        $this->credentials = $credentials;
        $this->client = $client ?: new HttpClient();
        $this->denormalizer = new ChainDenormalizer();
    }

    /**
     * @param Method $method
     *
     * @throws TextRuApiErrorException
     * @throws TextRuErrorResponseException
     *
     * @return Result|null
     */
    public function call(Method $method): ?Result
    {
        try {
            $response = $this->client->request('POST', $this->endpoint($method->method()), [
                'form_params' => \array_merge(['userkey' => $this->credentials->userKey()], $method->payload())
            ]);

            if (200 === $response->getStatusCode()) {
                return $this->mapResponse((string) $response->getBody(), $method->mappedClass());
            }

            throw new \RuntimeException(\sprintf('Server respond with bad response code: %s', $response->getStatusCode()));
        } catch (GuzzleException $e) {
            throw new TextRuApiErrorException($e->getMessage());
        }
    }

    /**
     * @param string $body
     * @param string $class
     *
     * @return Result|null
     *
     * @throws TextRuErrorResponseException
     */
    private function mapResponse(string $body, string $class): ?Result
    {
        if ('' === $body) {
            return null;
        }

        $payload = json_decode($body, true);

        if (isset($payload['error_code']) && isset($payload['error_desc'])) {
            throw TextRuErrorResponseException::forError($payload['error_code'], $payload['error_desc']);
        }

        return $this->denormalizer->denormalize($payload, $class);
    }

    /**
     * @param string $method
     *
     * @return string
     */
    private function endpoint(string $method): string
    {
        return \sprintf(self::TEXT_RU_ENDPOINT, $method);
    }
}
