<div class="my-4">
    <label class="inline-flex items-center cursor-pointer">
        <input type="checkbox"
            value=""
            class="sr-only peer"
            checked
            @if ($mandatory_assembly)
                disabled
            @endif
            wire:click="toggleAssemble"
        >
        <div class="relative w-11 h-6 bg-gray-400 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all @if($mandatory_assembly) {{'peer-checked:bg-gray-300'}} @else {{'peer-checked:bg-gray-800'}} @endif"></div>
        <span class="ms-3 font-semibold text-gray-800">
            {{__('Assembly') . ':'}}
                @if ($mandatory_assembly)
                    {{'(' . __('mandatory') . ')'}}
                @endif
            {{$assembly_price}}
        </span>
    </label>
</div>
