<!-- Botón para abrir el sidebar izquierdo en móviles -->
<div class="duration-500 ease-in-out fixed p-1 h-auto z-[90] right-10 bottom-20 xl:right-40 float-right">
    <button id="open-filter-side-menu" class="bg-gray-700 text-white p-3 rounded-full" aria-label="Abrir filtros"
        onclick="openSideFilterMenu()">
        @svg('heroicon-o-funnel', 'w-6 h-6')
    </button>
</div>


<script>
    function openSideFilterMenu() {
        document.getElementById('filter-side-menu').classList.toggle("open");
    }
</script>
