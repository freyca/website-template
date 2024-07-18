@php
    $id = md5($featureValue->name);
@endphp

<h2 id="accordion-collapse-heading-{{ $id }}">
    <button type="button"
        class="flex items-center justify-between w-full p-5 font-medium border border-gray-200 rounded hover:bg-gray-200 gap-3"
        data-accordion-target="#accordion-collapse-body-{{ $id }}" aria-expanded="true"
        aria-controls="accordion-collapse-body-{{ $id }}">
        <span class="text-gray-500">
            {{ __($feature->name) . ': ' . $featureValue->name }}
        </span>
        @svg('heroicon-o-chevron-down', 'w-6 h-6')
    </button>
</h2>

<div id="accordion-collapse-body-{{ $id }}" class="hidden"
    aria-labelledby="accordion-collapse-heading-{{ $id }}">
    <div class="p-5 border border-b-0 border-gray-200">
        <p class="mb-2 text-gray-500">
            {!! $featureValue->description !!}
        </p>
    </div>
</div>
