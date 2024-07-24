
<div class="bg-gradient-to-b from-gray-800 to-gray-900 p-6 rounded-lg shadow-2xl hover:bg-gray-800 hover:scale-105 transition-transform duration-300">
    <a href="{{ $category->slug }}">
        <img class="h-48 object-contain rounded-t-md mx-auto" src="{{ @asset('/storage/' . $category->big_image) }}" />
    </a>
    <div class="mt-5">
        
    <h2 class="text-lg text-gray-100 font-semibold text-center mb-2">
        <a href="{{ $category->slug }}" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded hover:from-purple-600 hover:to-pink-600">{{ $category->name }}</a>
    </h2>
    
    </div>
</div>