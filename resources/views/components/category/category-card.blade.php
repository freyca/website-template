<div
    class="bg-white mx-5 shadow-md rounded-lg p-6 text-gray-800 hover:text-gray-900 hover:bg-gray-200 hover:scale-105 transition-transform duration-300">
    <a href="{{ $category->slug }}">
        <img class="h-48 object-contain rounded-t-md mx-auto" src="{{ @asset('/storage/' . $category->big_image) }}" />
    </a>
    <div class="mt-5">

        <h2 class="text-lg font-semibold text-center mb-2">
            <a href="{{ $category->slug }}">
                {{ $category->name }}
            </a>
        </h2>

    </div>
</div>