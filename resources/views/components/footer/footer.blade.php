<footer class="bg-gray-800 mt-auto rounded-t-lg">
    <div class="w-full max-w-screen-xl mx-auto py-2 sm:py-4">
        <div class="mx-4 sm:mx-10 flex items-center justify-between">
            <a href="/" class="text-sm font-medium text-gray-300 mb-2 sm:mb-0 sm:flex items-center">
                <img src="{{ @asset('/images/logo.png') }}" class="h-8 mx-2" alt="Roteco" />
                <span class="self-center text-xl sm:text-2xl font-semibold text-gray-50 whitespace-nowrap">
                    Roteco
                </span>
            </a>

            <ul
                class="text-sm mx-4 my-1 font-medium text-gray-300 sm:mb-0 flex flex-col md:flex-row md:items-center justify-items-center">
                @foreach (config('custom.footer-sections') as $section => $url)
                    <li class="my-1 md:text-center md:mx-2">
                        <a href="{{ $url }}" class="hover:underline">
                            {{ ucfirst($section) }}</a>
                    </li>
                @endforeach
            </ul>

            <ul
                class="social-icon text-lg font-medium text-gray-300 sm:mb-0 flex flex-col justify-center sm:flex-row mt-2 sm:mt-0">
                <li class="social-icon__item m-1">
                    <a class="social-icon__link" href="https://facebook.com/">
                        @svg('fab-square-facebook', 'w-6 h-6 text-white')
                    </a>
                </li>

                <li class="social-icon__item m-1">
                    <a class="social-icon__link" href="https://x.com/">
                        @svg('fab-square-x-twitter', 'w-6 h-6 text-white')
                    </a>
                </li>

                <li class="social-icon__item m-1">
                    <a class="social-icon__link" href="https://instagram.com/">
                        @svg('fab-instagram', 'w-6 h-6 text-white')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
