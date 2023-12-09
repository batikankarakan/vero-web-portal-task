<?php

namespace Tests\Feature\tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class TasksTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_tasks_(): void
    {
        $this->withoutExceptionHandling();

        $oAuth = [
            "oauth" => [
                "access_token" => "test_access_token",
                "expires_in" => 1200
            ],
        ];


        $tasksArray = [
            [
                "task" => "test_task1",
                "title" => "test_title1",
                "description" => "test_description1",
                "colorCode" => "test_colorCode2",
            ],
            [
                "task" => "test_task2",
                "title" => "test_title2",
                "description" => "test_description2",
                "colorCode" => "test_colorCode2",
            ]
        ];

        $mock = new MockHandler([
            new Response(200, [], json_encode($oAuth)),
            new Response(200, [], json_encode($tasksArray)),
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['handler' => $handlerStack]);
        $this->app->instance(Client::class, $client);

        $response = $this->get('/tasks');
        $response->assertStatus(200)->assertJson($tasksArray);

    }
}
