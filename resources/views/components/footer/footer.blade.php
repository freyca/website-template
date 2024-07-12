<footer class="bg-gray-800 mt-auto rounded-t-lg">
    <div class="w-full max-w-screen-xl mx-auto py-4">
        <div class="mx-10 sm:flex sm:items-center sm:justify-between">
            <a href="/" class="flex items-center mb-2 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png" class="h-8"
                    alt="Roteco" />
                <span class="self-center text-2xl font-semibold text-gray-50 whitespace-nowrap">Roteco</span>
            </a>
            <ul class="text-sm mt-4 font-medium text-gray-300 sm:mb-0 sm:flex">
                @foreach (config('custom.footer-sections') as $section => $url)
                    <li class="my-1">
                        <a href="{{ $url }}" class="hover:underline me-4 md:me-6">
                            {{ ucfirst($section) }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>
