<div class="basis-1/3 my-10">
    <a href="{{ $category->slug }}">
        <img class="mx-auto justify-center h-52" src="{{ @asset('/storage/' . $category->big_image) }}" />
        <h2 class="mx-auto mt-2 text-center text-2xl font-bold"> {{ $category->name }} </h2>
    </a>
    <p class="mx-auto mt-2 text-center">{{ $category->slogan }}</p>
</div>
