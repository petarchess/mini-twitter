<!-- resources/views/users/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <img src="https://i.pravatar.cc/150?u={{ $user->email }}" alt="avatar" class="rounded-full">
                        <div class="ml-4">
                            <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>

                            <div class="flex mt-2 text-gray-600 items-center">
                                <a href="{{ route('users.following', $user) }}" class="hover:underline">
                                    <strong>{{ $user->following->count() }}</strong> Following
                                </a>
                                <span class="mx-4">|</span> <!-- optional separator -->
                                <a href="{{ route('users.followers', $user) }}" class="hover:underline">
                                    <strong>{{ $user->followers->count() }}</strong> Followers
                                </a>
                            </div>


                            @if (auth()->user()->isNot($user))
                                <form action="{{ route('users.follow', $user) }}" method="POST" class="mt-2">
                                    @csrf
                                    <x-primary-button>
                                        {{ auth()->user()->follows($user) ? 'Unfollow' : 'Follow' }}
                                    </x-primary-button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-xl font-bold">Posts</h4>
                        @forelse ($user->posts as $post)
                            <div class="p-4 mb-4 bg-gray-50 dark:bg-gray-800 rounded-lg shadow">
                                <p>{{ $post->body }}</p>
                                <span class="text-gray-600 dark:text-gray-400 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p>This user has no posts yet.</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
