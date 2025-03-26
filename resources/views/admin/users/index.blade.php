@extends('layouts.app')

@section('content')
    <x-card class="p-10 rounded-lg shadow-lg">
        <header class="mb-6">
            <h1 class="text-3xl text-center font-bold uppercase text-gray-800">
                Manage Users
            </h1>
        </header>

        <!-- Create User Button -->
        <div class="mb-4 flex justify-end">
            <a href="{{ route('admin.users.create') }}"
                class="bg-laravel/90 hover:bg-laravel text-white font-bold py-2 px-4 rounded-xl shadow-md transition">
                <i class="fa-solid fa-user-plus"></i> Create User
            </a>

        </div>

        <!-- Users Table -->
        <table class="w-full border-collapse rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-700 uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b border-gray-300 bg-white hover:bg-gray-100 transition">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-600">
                            <span
                                class="px-2 py-1 rounded-lg {{ $user->role === 'admin' ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex justify-center space-x-4">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="text-blue-500 hover:text-blue-700 transition">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-600 py-4">No users found.</td>
                    </tr>
                @endforelse


            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </x-card>
@endsection
