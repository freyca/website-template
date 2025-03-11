<div class="bg-primary-800 rounded-md relative flex m-2">
    <a href="{{ $category->slug }}" class="h-full mx-auto">
        <figure class="p-6 pb-10">
            <picture>
                <img class="h-20 md:h-40" src="{{ @asset('/storage/' . $category->big_image) }}" alt="{{ $category->name }}">
            </picture>

            <figcaption class="absolute bottom-0 right-0 max-w-64 text-right">
                <h3 class="text-lg font-semibold text-primary-800 rounded-tl-md truncate">
                    <span class="bg-white py-2 px-2">
                        {{ $category->name }}
                    </span>
                </h3>
            </figcaption>
        </figure>
    </a>
</div>