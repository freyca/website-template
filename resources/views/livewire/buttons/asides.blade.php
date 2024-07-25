
<!-- Contenido -->
<aside id="side-but" class="aside-menu w-full z-50 duration-500 ease-in-out bottom-10">
    <div class="">
        <!-- Botón de "Volver al Inicio" -->
        <a id="back-to-top-btn" href="#" class="hidden fixed bg-red-500 text-white shadow-lg hover:bg-red-600 transition duration-100 right-0 p-3 rounded-full h-14 m-2 bottom-10" aria-label="Back to top">
            @svg('heroicon-s-arrow-up-circle')
        </a>
        <!-- Botón para abrir el sidebar izquierdo en móviles -->
        <button id="open-aside-left" class="bg-gray-700 text-white p-3 rounded-full m-2 sticky right-0 float-right" aria-label="Abrir menú">
            @svg('heroicon-o-funnel', 'w-6 h-6')
        </button>
        <!-- Botón para abrir el sidebar derecho en móviles -->
        <button id="open-aside-right" class="hidden bg-gray-800 text-white p-3 rounded-full h-14 m-2 transition-transform duration-500 ease-in-out hover:bg-gray-900" aria-label="Abrir menú">
            @svg('heroicon-c-bars-3-center-left')
        </button>
    </div>
</aside>

<!-- Estilos -->
<style>
    .filter-features details {
        position: relative;
    }

    .filter-features summary {
        cursor: pointer;
    }

    .filter-features details[open] > div {
        display: block;
    }

    .filter-features .close-popup-button {
        cursor: pointer;
    }

    .aside-menu {
        position: fixed;
       
        padding: 1em;
        transition: transform 0.3s ease;
        height: auto;
        width: 100%;
        z-index: 1000;
    }

    @media (max-width: 768px) {
        .aside-menu {
            
        }

        #aside-left, #aside-right {
            width: 100%!important;
        }
        .aside-menu.open {
            transform: translateX(0);
        }
        
        .main-content.expanded-left {
            margin-left: 0px!important;
        }

        .main-content.expanded-right {
            margin-right: 0px!important;
        }
    }

    #aside-left, #aside-right {
        position: fixed;
        bottom: 60px;
        width: 44%;
        
        background-color: #f4f4f4;
        overflow-y: auto;
        transition: transform 0.3s ease;
        z-index: 20;
    }

    #aside-left {
        left: 0;
        transform: translateX(-100%);
        
        height: 91%;
        top: 120px;
    }

    #aside-right {
        right: 0;
        transform: translateX(100%);
    }

    #aside-left.open {
        transform: translateX(0);
    }

    #aside-right.open {
        transform: translateX(0);
    }

    .main-content {
        transition: margin-left 0.3s, margin-right 0.3s;
    }

    .main-content.expanded-left {
        margin-left: 150px;
    }

    .main-content.expanded-right {
        margin-right: 150px;
    }

    /* Scrollbar styles */
    .scrollbar-thin {
        scrollbar-width: thin;
    }

    .scrollbar-thumb-blue-500 {
        scrollbar-color: #4299e1 #edf2f7;
    }

    .scrollbar-track-gray-100 {
        scrollbar-color: #edf2f7 #edf2f7;
    }

    .scrollbar-thumb-blue-500::-webkit-scrollbar {
        width: 8px;
    }

    .scrollbar-thumb-blue-500::-webkit-scrollbar-thumb {
        background-color: #4299e1;
        border-radius: 10px;
    }

    .scrollbar-track-gray-100::-webkit-scrollbar-track {
        background-color: #edf2f7;
    }

    #applied-filters-list {
    list-style: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
}

#applied-filters-list li {
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 20px;
    padding: 5px 10px;
    margin: 5px;
    display: flex;
    align-items: center;
}

#applied-filters-list li .remove-filter {
    margin-left: 10px;
    cursor: pointer;
    color: red;
}

#clear-filters-button {
    background-color: #ff4444;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s;
}

#clear-filters-button:hover {
    background-color: #cc0000;
}


</style>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const openAsideLeft = document.getElementById('open-aside-left');
    const asideLeft = document.getElementById('aside-left');
    const openAsideRight = document.getElementById('open-aside-right');
    const asideRight = document.getElementById('aside-right');
    const mainContent = document.querySelector('.main-content');

    openAsideLeft?.addEventListener('click', () => {
        const isOpen = asideLeft.classList.toggle('open');
        if (isOpen) {
            mainContent.classList.add('expanded-left');
        } else {
            mainContent.classList.remove('expanded-left');
        }
    });

    openAsideRight?.addEventListener('click', () => {
        const isOpen = asideRight.classList.toggle('open');
        if (isOpen) {
            mainContent.classList.add('expanded-right');
        } else {
            mainContent.classList.remove('expanded-right');
        }
    });

    
    
    const filterItems = document.querySelectorAll('.filter-item input, .feature-checkbox, #category-filter, #type-filter, #power-filter, #minPrice, #maxPrice');
    const selectedFiltersList = document.getElementById('applied-filters-list');
    const clearFiltersButton = document.getElementById('clear-filters-button');

    filterItems.forEach(item => {
        item.addEventListener('change', function() {
            updateSelectedFilters();
        });
    });

    clearFiltersButton.addEventListener('click', function() {
        filterItems.forEach(item => {
            if (item.type === 'checkbox' || item.tagName === 'SELECT') {
                item.checked = false;
                item.value = '0';
            } else if (item.type === 'range') {
                item.value = item.min;
            }
        });
        updateSelectedFilters();
    });

    function updateSelectedFilters() {
        selectedFiltersList.innerHTML = '';
        filterItems.forEach(item => {
            if (item.type === 'checkbox' && item.checked) {
                addFilter(item.nextElementSibling.textContent, item);
            } else if (item.tagName === 'SELECT' && item.value !== '0') {
                const selectedOption = item.options[item.selectedIndex];
                addFilter(selectedOption.textContent, item);
            } else if (item.type === 'range') {
                addFilter(`${item.previousElementSibling.textContent}: ${item.value}`, item);
            }
        });
    }

    function addFilter(text, item) {
        const li = document.createElement('li');
        li.textContent = text;
        const removeBtn = document.createElement('span');
        removeBtn.textContent = '✖';
        removeBtn.classList.add('remove-filter');
        removeBtn.addEventListener('click', function() {
            item.checked = false;
            if (item.tagName === 'SELECT') item.value = '0';
            updateSelectedFilters();
        });
        li.appendChild(removeBtn);
        selectedFiltersList.appendChild(li);
    }
});



</script>