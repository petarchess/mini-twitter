<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-center">
            {{ __('Timeline') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">

                <!-- Center Column (span of 8, centered) -->
                <div class="col-span-12 lg:col-span-8 lg:col-start-3 space-y-6">

                    <!-- Create Post -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                            Create a New Post
                        </h3>
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf
                            <textarea name="body"
                                class="w-full bg-gray-100 dark:bg-gray-900 border-gray-300 dark:border-gray-700 
                                       focus:border-indigo-500 dark:focus:border-indigo-600 
                                       focus:ring-indigo-500 dark:focus:ring-indigo-600 
                                       rounded-md shadow-sm text-gray-800 dark:text-gray-300"
                                placeholder="What's on your mind?"></textarea>
                            <x-primary-button class="mt-4 w-full justify-center">
                                Post
                            </x-primary-button>
                        </form>
                    </div>

                    <!-- Posts Feed -->
                    <div class="space-y-6">
                        @forelse ($posts as $post)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    
                                    <!-- Post Header -->
                                    <div class="flex items-center mb-4">
                                        <div class="flex-shrink-0">
                                            <img src="https://i.pravatar.cc/50?u={{ $post->user->email }}"
                                                 alt="avatar"
                                                 class="rounded-full h-10 w-10 object-cover">
                                        </div>
                                        <div class="ml-3">
                                            <a href="{{ route('users.show', $post->user) }}"
                                               class="font-bold text-base hover:underline">
                                               {{ $post->user->name }}
                                            </a>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $post->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Post Body -->
                                    <p class="mb-4 text-gray-800 dark:text-gray-300 break-words">
                                        {{ $post->body }}
                                    </p>

                                    <!-- Comments Section -->
                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                        @foreach ($post->comments as $comment)
                                            <div class="flex items-start mt-3">
                                                <div class="flex-shrink-0">
                                                    <img src="https://i.pravatar.cc/50?u={{ $comment->user->email }}"
                                                         alt="avatar"
                                                         class="rounded-full h-8 w-8 object-cover">
                                                </div>
                                                <div class="ml-2 bg-gray-100 dark:bg-gray-700 p-3 rounded-lg w-full">
                                                    <a href="{{ route('users.show', $comment->user) }}"
                                                       class="font-bold text-sm hover:underline">
                                                       {{ $comment->user->name }}
                                                    </a>
                                                    <p class="text-sm text-gray-700 dark:text-gray-300 break-words">
                                                        {{ $comment->body }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- New Comment Form -->
                                        <form action="{{ route('comments.store', $post) }}" 
                                              method="POST" 
                                              class="mt-4 flex items-center">
                                            @csrf
                                            <div class="flex-shrink-0">
                                                <img src="https://i.pravatar.cc/50?u={{ auth()->user()->email }}"
                                                     alt="avatar"
                                                     class="rounded-full h-8 w-8 object-cover">
                                            </div>
                                            <input type="text" name="body"
                                                   class="w-full ml-2 bg-gray-100 dark:bg-gray-900 
                                                          border-gray-300 dark:border-gray-700 
                                                          focus:border-indigo-500 dark:focus:border-indigo-600 
                                                          focus:ring-indigo-500 dark:focus:ring-indigo-600 
                                                          rounded-full shadow-sm text-sm 
                                                          text-gray-800 dark:text-gray-300"
                                                   placeholder="Write a comment...">
                                            <x-primary-button class="ml-2 p-2 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" 
                                                     viewBox="0 0 20 20" 
                                                     fill="currentColor" 
                                                     class="w-4 h-4">
                                                    <path d="M3.105 2.289a.75.75 0 00-.826.95l1.414 4.949a.75.75 0 00.95.826L11.25 9.25v1.5l-7.457 1.243a.75.75 0 00-.95.826l1.414 4.949a.75.75 0 00.95.826l14.25-2.375a.75.75 0 000-1.408L3.105 2.289z" />
                                                </svg>
                                            </x-primary-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <p>Your timeline is empty. Find users to follow!</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
