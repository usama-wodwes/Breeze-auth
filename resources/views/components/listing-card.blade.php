@props(['listing'])
<x-card class="p-6">
    <div class="flex">
        {{-- <img class="hidden w-48 mr-6 md:block" src="{{ asset('images/no-image.png') }}" alt="" /> --}}
        <img class="hidden w-48 mr-6 md:block"
            src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}"
            alt="logo" />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{ $listing->id }}">{{ $listing->title }}</a>
            </h3>
            {{-- <pre>{{ $listing }}</pre> --}}
            <div class="text-xl font-bold mb-4"> {{ $listing->company }} </div>
            {{-- <pre>{{ $listing->tags }}</pre> --}}
            <x-listing-tags :tagsCsv="$listing->tags" />
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
            </div>
        </div>
    </div>
</x-card>
