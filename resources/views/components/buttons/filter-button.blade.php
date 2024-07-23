<button type="button" class="bg-gray-700 text-white p-3 rounded-full m-2 sticky right-0 xl:hidden"
    onclick="openSideFilterMenu()">
    @svg('heroicon-o-funnel', 'w-6 h-6')
</button>

<script>
    function openSideFilterMenu() {
        let menu = document.getElementById('filter-side-menu');


        if ((window.getComputedStyle(menu).display === "none")) {
            menu.style.display = "block";
        } else {
            menu.style.display = "none";
        }

        console.log(menu);
    }
</script>
