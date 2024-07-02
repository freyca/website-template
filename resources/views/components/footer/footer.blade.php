<footer class="bg-white rounded-lg shadow mt-12">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Roteco</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0">
                @foreach (config('custom.footer-sections') as $section => $url)
                <li>
                    <a href="{{ $url }}" class="hover:underline me-4 md:me-6"> {{ ucfirst($section) }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>