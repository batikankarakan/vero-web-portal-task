<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function auth()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.baubuddy.de/index.php/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
        "username":"365",
        "password":"1"
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic QVBJX0V4cGxvcmVyOjEyMzQ1NmlzQUxhbWVQYXNz',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $decoded = json_decode($response, TRUE);
        return $decoded["oauth"]["access_token"];
    }

    public function fetchTasks()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.baubuddy.de/dev/index.php/v1/tasks/select',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer d8ae6c7f9b146873f6aba2da63cba5dcc7a6f7ee',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $decoded = json_decode($response, TRUE);

        $tasks = [];
        foreach ($decoded as $task) {
            $tasks[] = [
                "task" => $task["task"],
                "title" => $task["title"],
                "description" => $task["description"],
                "colorCode" => $task["colorCode"],
            ];
        }

        return view('tasks', ['tasks' => $tasks]);
    }
}
