<div class="bg-white mx-5 shadow-md rounded-lg p-6  hover:scale-105 transition-transform duration-300">
    <img class="w-full h-32 sm:h-48 object-cover" src="{{ @asset('/storage/' . $category->big_image) }}" />
    <div class="mt-4">
        <h2 class="text-lg font-semibold">
            {{ $category->name }}
        </h2>
        <p class="mt-2 text-gray-600">
            {{ $category->slogan }}
        </p>
    </div>
</div>
