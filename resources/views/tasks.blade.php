<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-200">
<div
    class="">

    <div id="tasks" class="mx-auto p-6 lg:p-8 flex flex-col justify-center max-w-5xl">

        <div class="mt-8 bg-white p-12 flex flex-col rounded-xl">

            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-end items-center bg-white rounded-xl space-x-2">
                    <span class="text-gray-500">Search</span>
                    <input class="search px-2 py-1 border rounded-lg w-80" placeholder="" />
                </div>
                <div class="sm:flex sm:items-center mt-4">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Tasks</h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their
                            name, title, description and color.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <button type="button"
                                class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Upload Image
                        </button>
                    </div>
                </div>
                <div class="-mx-4 mt-8 flow-root sm:mx-0">
                    <table class="min-w-full">
                        <colgroup>
                            <col class="sm:w-1/6">
                            <col class="w-full sm:w-1/2">
                            <col class="sm:w-1/6">
                        </colgroup>
                        <thead class="border-b border-gray-300 text-gray-900">
                        <tr>
                            <th scope="col"
                                class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                                Task
                            </th>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Title
                            </th>
                            <th scope="col"
                                class="hidden px-3 py-3.5 text-right text-sm font-semibold text-gray-900 sm:table-cell">
                                Color
                            </th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($tasks as $task)
                            <tr class="border-b border-gray-200">
                                <td class="hidden px-3 py-5 text-sm text-gray-500 sm:table-cell task">{{ $task["task"] }}</td>
                                <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                                    <div class="font-medium text-gray-900 title">{{ $task["title"] }}</div>
                                    <div class="mt-1 text-gray-500 description">{{ $task["description"] }}</div>
                                </td>
                                <td class="hidden px-3 py-5 text-right text-sm sm:table-cell color"
                                    style="color: {{ $task["colorCode"] }}">{{ $task["colorCode"] }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
<script>
    var options = {
        valueNames: [ 'task', 'title', 'description', 'color' ]
    };

    var userList = new List('tasks', options);
</script>
</body>
</html>
