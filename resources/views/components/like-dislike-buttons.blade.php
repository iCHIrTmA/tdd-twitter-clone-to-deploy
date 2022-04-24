<div class="flex">
    @if(auth()->check() && $tweet->isLiked())
        <form method="POST"
            action="{{ route('likes.destroy', $tweet) }}"
        >
        @method('DELETE')        
    @else
        <form method="POST"
            action="{{ route('likes.store', $tweet) }}"
        >
    @endif
    @csrf

    @auth
        <div class="flex items-center mr-4 {{ $tweet->isLiked() ? 'text-blue-500' : 'text-gray-500' }}"> 
    @else
        <div class="flex items-center mr-4 text-gray-500">
    @endauth

        <button type="submit"
                class="text-xs"
        >
            <svg viewBox="0 0 20 20"
                    class="mr-1 w-3"
                    style="transform: scale(-1,1)"
            >
                <g id="Page-1"
                    stroke="none"
                    stroke-width="1"
                    fill="none"
                    fill-rule="evenodd"
                >
                    <g class="fill-current">
                        <path d="M11.0010436,0 C9.89589787,0 9.00000024,0.886706352 9.0000002,1.99810135 L9,8 L1.9973917,8 C0.894262725,8 0,8.88772964 0,10 L0,12 L2.29663334,18.1243554 C2.68509206,19.1602453 3.90195042,20 5.00853025,20 L12.9914698,20 C14.1007504,20 15,19.1125667 15,18.000385 L15,10 L12,3 L12,0 L11.0010436,0 L11.0010436,0 Z M17,10 L20,10 L20,20 L17,20 L17,10 L17,10 Z"
                                id="Fill-97"
                        ></path>
                    </g>
                </g>
            </svg>
        </button>

            {{ $tweet->likes()->count() ?: 0 }}
            
        </div>
    </form> 
</div>