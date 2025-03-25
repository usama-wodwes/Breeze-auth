<x-layout>
    <x-card class="p-10 rounded-lg shadow-lg">
        <header class="mb-6">
            <h1 class="text-3xl text-center font-bold uppercase text-gray-800">
                Create New User
            </h1>
        </header>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block font-semibold text-gray-700">Name:</label>
                <input type="text" name="name" required
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Email -->
            <div>
                <label class="block font-semibold text-gray-700">Email:</label>
                <input type="email" name="email" required
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Password -->
            <div>
                <label class="block font-semibold text-gray-700">Password:</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Role -->
            <div>
                <label class="block font-semibold text-gray-700">Role:</label>
                <select name="role"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.users.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>

                <button type="submit"
                    class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
                    <i class="fa-solid fa-user-plus"></i> Create User
                </button>
            </div>
        </form>
    </x-card>
</x-layout>
