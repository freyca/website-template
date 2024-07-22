<a href="/{{ $urlPrefix }}/{{ $product->slug }}">
    <li class="flex my-2 mx-4 p-2 rounded hover:bg-gray-400 items-center">
        <img src="{{ @asset('/storage/' . $product->main_image) }}" style="height: 3rem; width: 3rem;"
            class="max-w-none object-cover object-center rounded-full ring-white mr-4">
        <span class="text-nowrap overflow-hidden text-ellipsis">{{ $product->name }}</span>
    </li>
</a>
