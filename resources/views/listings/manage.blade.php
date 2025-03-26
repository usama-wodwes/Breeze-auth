@extends('layouts.app')

@section('content')
    @php
        $isAdmin = $isAdmin ?? false; // Ensure $isAdmin is always defined
    @endphp
    <x-card class="p-10 rounded">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Gigs
            </h1>
            <div class="w-full py-4">
                <a href="/listings/create" class="absolute top-1/3 right-10 bg-laravel text-white py-2 px-5">Post Job</a>

            </div>
        </header>
        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless ($listings->isEmpty())
                    @foreach ($listings as $listing)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/listings/{{ $listing->id }}">
                                    {{ $listing->title }}
                                </a>
                            </td>

                            {{-- Only show edit & delete buttons if the user is NOT an admin --}}
                            @if (!$isAdmin)
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <a href="/listings/{{ $listing->id }}/edit" class="text-blue-400 px-6 py-2 rounded-xl">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <form method="POST" action="/listings/{{ $listing->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No Listings found</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
@endsection
