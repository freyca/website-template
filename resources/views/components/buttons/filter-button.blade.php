
<!-- Botón para abrir el sidebar izquierdo en móviles -->
<div class="aside-menu w-full z-50 duration-500 ease-in-out bottom-10">
    <button id="open-filter-side-menu" class="bg-gray-700 text-white p-3 rounded-full m-2 sticky right-0 float-right" aria-label="Abrir menú" onclick="openSideFilterMenu()">
        @svg('heroicon-o-funnel', 'w-6 h-6')
    </button>
</div>

<!-- Estilos -->
<style>
    .aside-menu {
        position: fixed;
        padding: 1em;
        transition: transform 0.3s ease;
        height: auto;
        width: 85%;
        z-index: 1000;
    }

    @media (max-width: 768px) {
        #filter-side-menu {
            width: 100% !important;
        }

        .main-content.expanded-left {
            margin-left: 0px !important;
        }
    }

    #filter-side-menu {
        position: fixed;
        bottom: 60px;
        width: 44%;
        left: 0;
        transform: translateX(-100%);
        height: 91%;
        top: 120px;
        background-color: #f4f4f4;
        overflow-y: auto;
        transition: transform 0.3s ease;
        z-index: 20;
    }

    #filter-side-menu.open {
        transform: translateX(0);
    }

    .remove-filter {
        cursor: pointer;
        color: red;
        margin-left: 10px;
    }
</style>

<!-- JavaScript -->
<!-- JavaScript -->
<script>
    function openSideFilterMenu() {
        document.getElementById('filter-side-menu').classList.toggle("open");
    }

    document.addEventListener('DOMContentLoaded', function() {
        const filterItems = document.querySelectorAll('.filter-item');
        const selectedFiltersList = document.getElementById('applied-filters-list');
        const clearFiltersButton = document.getElementById('clear-filters-button');

        let filterIdCounter = 0;

        function updateSelectedFilters(item) {
            if (item.type === 'checkbox' && item.checked) {
                addFilter(item.parentNode.textContent.trim(), item);
            } else if (item.tagName === 'SELECT' && item.value !== '0') {
                const selectedOption = item.options[item.selectedIndex];
                addFilter(selectedOption.textContent, item);
            } else if (item.type === 'range' && item.value !== '5000' && item.value !== item.min && item.value !== item.max) {
                addFilter(`${item.parentNode.parentNode.textContent.trim().split(":")[0]}: ${item.value} €`, item);
            }
        }

        function addFilter(text, item) {
            const div = document.createElement('div');
            div.classList.add('flex', 'items-center', 'bg-gray-200', 'text-gray-700', 'py-1', 'px-3', 'rounded-lg', 'filter-tag');
            div.textContent = text;
            div.id = `filter-${filterIdCounter++}`;

            const removeBtn = document.createElement('span');
            removeBtn.textContent = ' ✖';
            removeBtn.classList.add('remove-filter', 'ml-2', 'text-red-500', 'hover:text-red-700', 'cursor-pointer');
            removeBtn.addEventListener('click', function() {
                item.checked = false;
                item.innerHTML = '';
                if (item.tagName === 'SELECT') {
                    item.value = '0';
                } else if (item.type === 'range') {
                    item.value = item.min;
                } else {
                    item.value = '';
                }
                div.remove();
            });

            div.appendChild(removeBtn);
            selectedFiltersList.appendChild(div);
        }

        clearFiltersButton.addEventListener('click', function() {
            selectedFiltersList.innerHTML = '';
            filterItems.forEach(item => {
                item.checked = false;
                if (item.tagName === 'SELECT') {
                    item.value = '0';
                } else if (item.type === 'range') {
                    item.value = item.min;
                } else {
                    item.value = '';
                }
            });
        });

        filterItems.forEach(item => {
            item.addEventListener('change', () => updateSelectedFilters(item));
        });

        // Inicializar la lista de filtros seleccionados al cargar la página
        // filterItems.forEach(item => {
        //     if (item.checked || (item.tagName === 'SELECT' && item.value !== '0') || (item.type === 'range' && item.value !== item.min && item.value !== item.max)) {
        //         updateSelectedFilters(item);
        //     }
        // });
    });
</script>
