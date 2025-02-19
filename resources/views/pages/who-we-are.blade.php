<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de quienes somos">
    <section class="bg-primary-50 dark:bg-primary-800">
        <div class="container mx-auto p-4">
            <h1 class="text-3xl font-bold mb-4">
                Quiénes Somos
            </h1>
            <div class="grid gap-4">
                <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
                    <h2 class="text-xl font-bold mb-2">
                        Nuestra Misión
                    </h2>
                    <p class="text-primary-700">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vel urna quis
                        urna fermentum bibendum.
                    </p>
                </div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
                    <h2 class="text-xl font-bold mb-2">
                        Nuestra Visión
                    </h2>
                    <p class="text-primary-700">
                        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <x-buttons.whats-app-button />
</x-layouts.app>
