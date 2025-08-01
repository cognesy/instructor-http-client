<?php declare(strict_types=1);

namespace Cognesy\Http\Data;

/**
 * Class HttpRequest
 *
 * Represents an HTTP request
 */
class HttpRequest
{
    private HttpRequestBody $body;

    /**
     * HttpRequest constructor.
     *
     * @param string $url
     * @param string $method
     * @param array $headers
     * @param array $body
     * @param array $options
     */
    public function __construct(
        public string $url,
        public string $method,
        public array $headers,
        string|array $body,
        public array $options,
    ) {
        $this->body = new HttpRequestBody($body);
    }

    /**
     * Get the request URL
     *
     * @return string
     */
    public function url() : string {
        return $this->url;
    }

    /**
     * Get the request method
     *
     * @return string
     */
    public function method() : string {
        return $this->method;
    }

    /**
     * Get the request headers
     *
     * @return array
     */
    public function headers() : array {
        return $this->headers;
    }

    /**
     * Get the request body
     *
     * @return HttpRequestBody
     */
    public function body() : HttpRequestBody {
        return $this->body;
    }

    public function options() : array {
        return $this->options;
    }

    /**
     * Check if the request is streamed
     *
     * @return bool
     */
    public function isStreamed() : bool {
        return $this->options['stream'] ?? false;
    }

    /**
     * Set the request URL
     *
     * @param string $url
     * @return $this
     */
    public function withStreaming(bool $streaming) : self {
        $this->options['stream'] = $streaming;
        return $this;
    }

    public function toArray() : array {
        return [
            'url' => $this->url,
            'method' => $this->method,
            'headers' => $this->headers,
            'body' => $this->body->toArray(),
            'options' => $this->options,
        ];
    }
}
