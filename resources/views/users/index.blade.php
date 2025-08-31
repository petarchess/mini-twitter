<!-- resources/views/users/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('users.index') }}" method="GET" class="mb-6">
                        <input type="text" name="q" placeholder="Search by name or email..." value="{{ request('q') }}" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <x-primary-button class="ml-2">Search</x-primary-button>
                    </form>

                    @if(request()->has('q'))
                        @forelse ($users as $user)
                            <div class="flex items-center justify-between p-4 my-2 bg-gray-50 rounded-lg shadow">
                                <div class="flex items-center">
                                    <img src="https://i.pravatar.cc/50?u={{ $user->email }}" alt="avatar" class="rounded-full">
                                    <div class="ml-4">
                                        <a href="{{ route('users.show', $user) }}" class="font-bold">{{ $user->name }}</a>
                                        <p class="text-gray-600">{{ $user->email }}</p>
                                    </div>
                                </div>
                                @if(auth()->user()->isNot($user))
                                    <form action="{{ route('users.follow', $user) }}" method="POST">
                                        @csrf
                                        <x-primary-button>
                                            {{ auth()->user()->follows($user) ? 'Unfollow' : 'Follow' }}
                                        </x-primary-button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <p>No users found for "{{ request('q') }}".</p>
                        @endforelse
                    @else
                        <p>Please enter a name or email to search for users.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
