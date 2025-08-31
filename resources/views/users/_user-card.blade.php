<!-- resources/views/users/_user-card.blade.php -->
<div class="flex items-center justify-between p-4 my-2 bg-gray-50 dark:bg-gray-700 rounded-lg shadow">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/50?u={{ $user->email }}" alt="avatar" class="rounded-full h-12 w-12 object-cover">
        </div>
        <div class="ml-4">
            <a href="{{ route('users.show', $user) }}" class="font-bold text-gray-900 dark:text-gray-100 hover:underline">{{ $user->name }}</a>
            <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
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