<x-app> 
    <h3 class="font-weight-bold mb-3">Hi {{ auth()->user()->username }}, Explore the Tweety World!</h3>
    <div>
        @foreach ($users as $user)
            <a href="{{ route('profiles.show', $user) }}" class="flex items-center mb-5">
                <img src="{{ $user->avatar }}"
                      alt="{{ $user->username }}'s avatar"
                      width="60"
                      class="mr-4 rounded-full"
                >

                <div>
                    <h4 class="font-bold">{{ '@' . $user->username }}</h4>
                </div>
            </a>
        @endforeach

        {{ $users->links() }}
    </div>
</x-app>