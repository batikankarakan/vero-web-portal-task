<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-200">
<div>

    <div id="tasks" class="mx-auto p-6 lg:p-8 flex flex-col justify-center max-w-5xl">

        <div class="mt-8 bg-white p-12 flex flex-col rounded-xl">

            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-end items-center bg-white rounded-xl space-x-2">
                    <span class="text-gray-500">Search</span>
                    <input v-model="search" class="search px-2 py-1 border rounded-lg w-80" placeholder=""/>
                </div>
                <div class="sm:flex sm:items-center mt-4">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Tasks</h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their
                            name, title, description and color.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none" id="upload">
                        <button type="button" @click="showModal = !showModal"
                                class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Upload Image
                        </button>
                        <div v-if="showModal" class="relative z-10" aria-labelledby="modal-title" role="dialog"
                             aria-modal="true">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                <div
                                    class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <div
                                        class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                        <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                                            <button @click="showModal = !showModal" type="button"
                                                    class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                <span class="sr-only">Close</span>
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                     stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="sm:flex sm:items-start">
                                            <div class="mt-4 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                <h3 class="text-base font-semibold text-gray-900 text-2xl"
                                                    id="modal-title">Upload Image</h3>
                                                <form class="mt-4">
                                                    <input type="file" accept="image/*" onchange="loadFile(event)">
                                                    <div class="mt-4">
                                                        <img class="rounded-xl" id="output"/>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <tr v-if="tasks.length > 0" v-for="task in filteredTasks" :key="task.task"
                            class="border-b border-gray-200">
                            <td class="hidden px-3 py-5 text-sm text-gray-500 sm:table-cell task">@{{ task.task }}
                            </td>
                            <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                                <div class="font-medium text-gray-900 title">@{{ task.title }}</div>
                                <div class="mt-1 text-gray-500 whitespace-pre-line max-h-24 overflow-y-auto">@{{ task.description }}</div>
                            </td>
                            <td class="hidden px-3 py-5 text-right text-sm sm:table-cell color"
                                :style="{color: task.colorCode}">@{{ task.colorCode }}
                            </td>
                        </tr>
                        <tr v-else class="border-b border-gray-200 animate-pulse">
                            <td class="hidden px-3 py-5 text-sm text-gray-500 sm:table-cell">
                                <div class="bg-gray-300 p-1 rounded-xl"></div>
                            </td>
                            <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                                <div class="font-medium text-gray-900">
                                    <div class="bg-gray-300 p-1 rounded-xl w-52"></div>
                                </div>
                                <div class="mt-1 text-gray-500">
                                    <div class="bg-gray-300 p-1 rounded-xl"></div>
                                </div>
                            </td>
                            <td class="hidden px-3 py-5 text-right text-sm sm:table-cell ">
                                <div class="bg-gray-300 p-1 rounded-xl"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    Vue.createApp({
        data() {
            return {
                showModal: false,
                tasks: [],
                search: "",
            }
        },
        mounted() {
            this.fetchTasks()
            setInterval(() => {
                this.fetchTasks()
            }, 3600000)
        },
        created() {

        },
        methods: {
            async fetchTasks() {
                const res = await fetch("{{ route('fetch') }}")
                this.tasks = await res.json();
            }
        },
        computed: {
            filteredTasks() {
                const searchLowerCase = this.search.toLowerCase()
                return this.tasks.filter(task => {
                    return task.task.toLowerCase().indexOf(searchLowerCase) > -1
                        || task.description.toLowerCase().indexOf(searchLowerCase) > -1
                        || task.title.toLowerCase().indexOf(searchLowerCase) > -1
                        || task.colorCode.toLowerCase().indexOf(searchLowerCase) > -1
                })
            }
        },
    }).mount("#tasks");

</script>
</body>
</html>
