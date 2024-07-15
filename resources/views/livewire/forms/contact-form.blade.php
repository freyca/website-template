<div class="grid grid-cols-5">
    <form wire:submit="save" class="col-span-5 py-10">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="grid-first-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    {{ __('Name') }}
                </label>
                <input wire:model="name" type="text" id="grid-first-name"
                    class="appearance-none block w-full border border-gray-500 rounded py-3 px-4 mb-3 leading-tight">
                <div>
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    {{ __('Email') }}
                </label>
                <input wire:model="email" type="text"
                    class="appearance-none block w-full border border-gray-500 rounded py-3 px-4 mb-3 leading-tight"
                    id="grid-last-name">
                <div>
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="w-full md:w-1/2 px-3">
                <label for="grid-last-name"
                    class="block uppercase tracking-wide text-gray-700 border-gray text-xs font-bold mb-2">
                    {{ __('Message') }}
                </label>
                <textarea wire:model="message" type="textarea"
                    class="appearance-none block w-full border border-gray-500 rounded py-3 px-4 mb-3 leading-tight"
                    id="grid-last-name">
                </textarea>
                <div>
                    @error('message')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit"
            class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
            {{ __('Enviar') }}
        </button>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </form>
    <span></span>
</div>
