<!-- Botón para abrir el sidebar izquierdo en móviles -->
<div class="aside-menu duration-500 ease-in-out sticky p-1 h-auto z-[90] right-10 bottom-0 xl:right-40 float-right m-2 ">
    <button id="open-filter-side-menu" class="bg-gray-700 text-white p-3 rounded-full" wire:click="toggleFilterBar"
        aria-label="Abrir filtros">
        @svg('heroicon-o-funnel', 'w-6 h-6')
    </button>
    
    <style>
        .aside-menu {
            position: fixed;
            padding: 1em;
            transition: transform 0.3s ease;
            height: auto;
            
            z-index: 1000;
        }
    
        @media (max-width: 768px) {
            .aside-menu {
                width: 100% !important;
            }
    
            .main-content.expanded-left {
                margin-left: 0px !important;
            }
        }
    
    </style>
</div>