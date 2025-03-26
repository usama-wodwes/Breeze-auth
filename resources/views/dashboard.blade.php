{{-- <x-app-layout>
    <x-slot name="header">

    </x-slot>
</x-app-layout> --}}
@extends('layouts.app')

@section('content')
    <x-card class="p-10 rounded-lg shadow-lg">
        <header class="mb-6">
            <h1 class="text-3xl text-center font-bold uppercase text-gray-800">
                Manage Listings
            </h1>
        </header>

        <table class="w-full border-collapse rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-700 uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">Listing</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    @role('admin')
                        <th class="px-6 py-3 text-center">Actions</th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @forelse ($listings as $listing)
                    <tr class="border-b border-gray-300 bg-white hover:bg-gray-100 transition">
                        <td class="px-6 py-4">{{ $listing->title }}</td>
                        <td class="px-6 py-4 font-semibold">
                            <span
                                class="px-2 py-1 rounded-lg
                                {{ $listing->status === 'pending' ? 'bg-yellow-500 text-white' : '' }}
                                {{ $listing->status === 'approved' ? 'bg-green-500 text-white' : '' }}
                                {{ $listing->status === 'rejected' ? 'bg-red-500 text-white' : '' }}">
                                {{ ucfirst($listing->status) }}
                            </span>
                        </td>
                        @role('admin')
                            <td class="px-6 py-4 flex justify-center space-x-4">
                                <form action="{{ route('admin.listings.approve', $listing) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:text-green-700 transition">
                                        <i class="fa-solid fa-check"></i> Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.listings.reject', $listing) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                        <i class="fa-solid fa-times"></i> Reject
                                    </button>
                                </form>
                            </td>
                        @endrole
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-600 py-4">No listings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        {{-- <div class="mt-6">
            {{ $listings->links() }}
        </div> --}}
    </x-card>
@endsection
