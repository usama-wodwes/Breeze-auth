<x-app-layout>
    <x-slot name="header">
        <div class="lg:grid lg:grid-cols-1 gap-4 space-y-4 md:space-y-0 mx-4 ">
            @if (!empty($listings) && $listings->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Listing</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            @role('admin')
                                {{-- Only show Action column for Admin --}}
                                <th class="px-16 py-2 text-left">Action</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listings as $listing)
                            <tr>
                                <td class="px-4 py-2">{{ $listing->title }}</td>
                                <td class="px-4 py-2">
                                    @if ($listing->status == 'pending')
                                        <span class="text-yellow-500">Pending</span>
                                    @elseif ($listing->status == 'approved')
                                        <span class="text-green-500">Approved</span>
                                    @else
                                        <span class="text-red-500">Rejected</span>
                                    @endif
                                </td>
                                @role('admin')
                                    {{-- Only show action buttons for Admin --}}
                                    <td class="px-4 py-2">
                                        <form action="{{ route('admin.listings.approve', $listing) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.listings.reject', $listing) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                                        </form>
                                    </td>
                                @endrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Lists not found</p>
            @endif
        </div>
    </x-slot>
</x-app-layout>
