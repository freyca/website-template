<div class="bg-gray-200 mx-5 shadow-md rounded-lg p-6 hover:scale-105 transition-transform duration-300">
    <a href="{{ $category->slug }}">
        <img class="h-32 sm:h-48 object-contain rounded-md mx-auto"
            src="{{ @asset('/storage/' . $category->big_image) }}" />
    </a>

    <div class="mt-5">
        <h2 class="text-lg font-semibold text-center">
            <a href="{{ $category->slug }}">
                {{ $category->name }}
            </a>
        </h2>
    </div>
</div>
