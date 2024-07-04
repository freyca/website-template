<div class="bg-white mx-5 shadow-md rounded-lg p-6  hover:scale-105 transition-transform duration-300">
    <a href="{{ $category->slug }}">
        <img class="w-full h-32 sm:h-48 object-cover" src="{{ @asset('/storage/' . $category->big_image) }}" />
    </a>

    <div class="mt-4">
        <h2 class="text-lg font-semibold">
            <a href="{{ $category->slug }}">
                {{ $category->name }}
            </a>
        </h2>
        <p class="mt-2 text-gray-600">
            {{ $category->slogan }}
        </p>
    </div>
</div>
