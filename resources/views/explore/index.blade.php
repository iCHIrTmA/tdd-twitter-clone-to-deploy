<x-app>
    @auth
        <h3 class="font-weight-bold mb-3">Hi {{ auth()->user()->username }}, explore their tweets!</h3>
    @else
        <h3 class="font-weight-bold mb-3">Hi! Please <a href="{{ route('login') }}" class="text-pink-500">sign in</a> to follow tweets from these awesome people</h3>
    @endauth
    <div>
        @foreach ($users as $user)
            <div class="flex justify-between items-center mb-6 lg:w-1/2">
                <a href="{{ route('profiles.show', $user) }}" class="flex items-center">
                    <img src="{{ $user->avatar }}"
                            alt="{{ $user->username }}'s avatar"
                            width="60"
                            class="mr-4 rounded-full"
                    >
                    <div>
                        <h4 class="font-bold">{{ '@' . $user->username }}</h4>
                    </div>
                </a>
                <x-follow-button :user="$user"></x-follow-button>
            </div>
        @endforeach
    </div>

        {{ $users->links() }}
</x-app>