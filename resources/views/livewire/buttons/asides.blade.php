<!-- Contenido -->
<aside id="side-but" class="aside-menu  w-full z-50 duration-500 ease-in-out bottom-10">
    <div class="">
        <!-- Botón de "Volver al Inicio" -->
        <a id="back-to-top-btn" href="#" class="hidden fixed bg-red-500 text-white shadow-lg hover:bg-red-600 transition duration-100 right-0 p-3 rounded-full h-14 m-2 bottom-10" aria-label="Back to top">
            @svg('heroicon-s-arrow-up-circle')
        </a>
        <!-- Botón para abrir el sidebar izquierdo en móviles -->
        {{-- <button id="open-aside-left" class="bg-blue-500 text-white p-3 rounded-full h-14  m-2 transition-transform duration-100 ease-in-out hover:bg-blue-600 " aria-label="Abrir menú"> --}}
            <button id="open-aside-left" class="bg-gray-700 text-white p-3 rounded-full m-2 sticky right-0  float-right" aria-label="Abrir menú">
            
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
    .aside-menu {
    position: fixed;
    background: transparent;
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
        width: 250px;
        background-color: #f4f4f4;
        overflow-y: auto;
        transition: transform 0.3s ease;
        z-index: 20;
    }

    #aside-left {
        left: 0;
        transform: translateX(-100%);
        top: 110px;

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
</style>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const openAsideLeft = document.getElementById('open-aside-left');
    // const closeAsideLeft = document.getElementById('closeAsideLeft');
    const asideLeft = document.getElementById('aside-left');
    const openAsideRight = document.getElementById('open-aside-right');
    // const closeAsideRight = document.getElementById('closeAsideRight');
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

    // closeAsideLeft?.addEventListener('click', () => {
    //     asideLeft.classList.remove('open');
    //     mainContent.classList.remove('expanded-left');
    // });

    // closeAsideRight?.addEventListener('click', () => {
    //     asideRight.classList.remove('open');
    //     mainContent.classList.remove('expanded-right');
    // });
});
</script>
