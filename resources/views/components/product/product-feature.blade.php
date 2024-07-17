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
        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5 5 1 1 5" />
        </svg>
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
