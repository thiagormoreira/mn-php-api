<?php

use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
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
        $response = $this->http->request('GET', '/user');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $body = $response->getBody();
    }

    public function testShow(): void
    {
        $response = $this->http->request('GET', '/user/show/1');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $body = $response->getBody();
    }

    public function testStore(): void
    {
        $newuser = [
            "fullname" => "User",
            "address" => [
                "address" => "Rua Nova",
                "number" => "1",
                "zip_code" => "28909-170",
                "city" => [
                    "name" => "Sao Paulo",
                    "state" => [
                        "id" => 1,
                        "name" => "Sao Paulo"
                    ]
                ]
            ]
        ];

        $response = $this->http->request('POST', '/user/create', [
            'json' => $newuser
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $body = $response->getBody();

        $this->assertJson($body);
    }

    public function testUpdate(): void
    {
        $newuser = [
            "fullname" => "User",
            "address" => [
                "address" => "Rua Nova",
                "number" => "1",
                "zip_code" => "28909-170",
                "city" => [
                    "name" => "Sao Paulo",
                    "state" => [
                        "id" => 1,
                        "name" => "Sao Paulo"
                    ]
                ]
            ]
        ];

        $response = $this->http->request('POST', '/user/create', [
            'json' => $newuser
        ]);

        $this->assertEquals(201, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $body = $response->getBody();
    }

    public function testDelete(): void
    {
        $newuser = [
            "fullname" => "User",
            "address" => [
                "address" => "Rua Nova",
                "number" => "1",
                "zip_code" => "28909-170",
                "city" => [
                    "name" => "Sao Paulo",
                    "state" => [
                        "id" => 1,
                        "name" => "Sao Paulo"
                    ]
                ]
            ]
        ];

        $create = $this->http->request('POST', '/user/create', [
            'json' => $newuser
        ]);

        $id = json_decode($create->getBody()->getContents())->id;

        $response = $this->http->request('DELETE', "/user/delete/${id}",);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $body = $response->getBody();
    }

}