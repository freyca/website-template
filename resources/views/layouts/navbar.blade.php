<nav class="container-fluid">
    <div class="mx-auto py-4 text-lg bg-stone-800">
        <nav class="container navbar mx-auto">
            <a class="mx-auto p-2" href="/"><span><img class="inline" src="https://placehold.co/100x30" height="30px" width="100px"></span></a>

            @foreach ( config('custom.nav-sections') as $section => $url )
                <a class="mx-auto p-6" href="{{$url}}"><span class="text-red-50">{{ ucfirst($section) }}</span></a>
            @endforeach

            <a class="mx-auto p-2" href="/mi-perfil" style="justify-content: flex-end;"><span class="text-red-50">Mi perfil</span></a>
        </nav>
    </div>
</nav>