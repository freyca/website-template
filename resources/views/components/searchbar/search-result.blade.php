<div class="bg-gray-200 my-2 mx-4 rounded">
    <a href="/{{ $urlPrefix }}/{{ $product->slug }}">
        <li class="flex p-2 rounded hover:bg-gray-400 items-center">
            <img src="{{ @asset('/storage/' . $product->main_image) }}" style="height: 3rem; width: 3rem;"
                class="max-w-none object-cover object-center rounded-full ring-white mr-4">
            <span class="text-nowrap overflow-hidden text-ellipsis text-gray-800">
                {{ $product->name }}
            </span>
        </li>
    </a>
</div>