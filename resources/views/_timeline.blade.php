<div class="border border-gray-300 rounded-lg">
    @forelse ($tweets as $tweet)
        @include('_tweet')
    @empty
        <p class="p-4">Post a tweet or<a href="{{ route('explore.index') }}" class="text-pink-500"> follow people</a> to checkout their tweets</p>
    @endforelse
</div>