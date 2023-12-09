<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TasksController extends Controller
{
    public function auth(Client $client)
    {
        $headers = [
            "Authorization" => "Basic ". config('services.baubuddy.key'),
            "Content-type" => "application/json"
        ];

        $response = $client->request('POST', 'login', ['headers' => $headers, 'body' => '{"username":"365","password":"1"}']);
        $content = $response->getBody()->getContents();
        $decoded = json_decode($content, TRUE);

        return $decoded["oauth"];
    }

    public function fetchTasks(Client $client)
    {
        $accessToken = Cache::get('accessToken');
        if (!$accessToken) {
            $oAuth = $this->auth($client);
            $accessToken = $oAuth["access_token"];
            Cache::put('accessToken', $oAuth["access_token"], $oAuth["expires_in"]);
        }

        $headers = [
            "Authorization" => "Bearer $accessToken",
            "Content-type" => "application/json"
        ];

        $response = $client->request('GET', 'v1/tasks/select', ['headers' => $headers]);
        $content = $response->getBody()->getContents();

        $decoded = json_decode($content, TRUE);

        $tasks = [];
        foreach ($decoded as $task) {
            $tasks[] = [
                "task" => $task["task"],
                "title" => $task["title"],
                "description" => $task["description"],
                "colorCode" => $task["colorCode"],
            ];
        }
        return $tasks;
    }

    public function tasks()
    {
        return view('tasks');
    }
}
