<div class="bg-gray-200 border border-gray-300 rounded-lg py-4 px-6">
    <h3 class="font-bold text-xl mb-4">Following</h3>
        <ul>
            @auth
                @forelse(auth()->user()->follows as $user)
                    <li class="{{ $loop->last ? '' : 'mb-4'}}">
                        <div class="flex items-center text-sm">
                            <a href="{{route('profiles.show', $user)}}">
                                <img src="{{ $user->avatar }}" 
                                alt=""
                                class="rounded-full mr-2"
                                width="40"
                                height="25"
                                >
                            </a>
                            <a href="{{route('profiles.show', $user)}}">
                                {{$user->name}}
                            </a>
                        </div>
                    </li>
                @empty
                    <li>No friends yet</li>
                @endforelse
            @else
                <a href="{{ route('login') }}" class="text-pink-500">Sign in</a> to see people you follow
            @endauth
        </ul>
</div>