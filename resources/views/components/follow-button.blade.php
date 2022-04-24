@auth
    @unless(auth()->user()->is($user))
        <form method="POST" action="{{ route('follows.store', $user) }}">
            @csrf
            <button type="submit" class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
                {{ auth()->user()->isFollowing($user) ? 'Unfollow me' : 'Follow me' }}
            </button>
        </form>
    @endunless
@else
    <a href="{{ route('login') }}" class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2">
        Sign in to follow
    </a>
@endauth