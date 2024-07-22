<footer class="bg-gray-800 mt-auto rounded-t-lg">
    <div class="w-full max-w-screen-xl mx-auto py-4">
        <div class="mx-4 sm:mx-10 flex items-center justify-between">
            <a href="/" class="text-sm font-medium text-gray-300 sm:mb-0 sm:flex">
                <img src="https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png" class="h-8 mx-2"
                    alt="Roteco" />
                <span class="self-center text-2xl font-semibold text-gray-50 whitespace-nowrap">Roteco</span>
            </a>

            <ul class="text-sm mx-4 my-1 font-medium text-gray-300 sm:mb-0 md:flex">
                @foreach (config('custom.footer-sections') as $section => $url)
                    <li class="my-1">
                        <a href="{{ $url }}" class="hover:underline me-4 md:me-6">
                            {{ ucfirst($section) }}</a>
                    </li>
                @endforeach
            </ul>

            <ul class="social-icon text-lg font-medium text-gray-300 sm:mb-0 sm:flex">
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
