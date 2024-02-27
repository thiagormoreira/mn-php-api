<?php

use PHPUnit\Framework\TestCase;

class AddressControllerTest extends TestCase
{
    private $http;
    public function setUp(): void
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://localhost/']);
    }

    public function tearDown(): void
    {
        $this->http = null;
    }

    public function testIndex(): void
    {
        $response = $this->http->request('GET', '/address');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $body = $response->getBody();
    }

    public function testShow(): void
    {
        $response = $this->http->request('GET', '/address/show/1');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $body = $response->getBody();
    }
}