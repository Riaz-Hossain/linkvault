<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Dashboard
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage and organize your saved bookmarks
                </p>
            </div>

            <!-- CREATE BUTTON -->
            <a
                href="/bookmarks/create"
                class="inline-flex items-center px-4 py-2 bg-black text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition">
                + Add Bookmark
            </a>
        </div>
    </x-slot>

    <!-- ALPINE WRAPPER -->
    <div x-data="{
        createOpen: false,
        editOpen: false,
        id: null,
        title: '',
        url: ''
    }">

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Stats (UNCHANGED DESIGN) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-sm text-gray-500">Total Bookmarks</p>
                                <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                    {{ $bookmarks->count() }}
                                </h3>
                            </div>

                            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-2xl">
                                🔖
                            </div>

                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-sm text-gray-500">Categories</p>
                                <h3 class="text-3xl font-bold text-gray-900 mt-2">
                                    {{ $bookmarks->unique('category')->count() }}
                                </h3>
                            </div>

                            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-2xl">
                                📂
                            </div>

                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-sm text-gray-500">Latest Bookmark</p>
                                <h3 class="text-lg font-semibold text-gray-900 mt-2 truncate">
                                    {{ $bookmarks->first()->title ?? 'No bookmarks yet' }}
                                </h3>
                            </div>

                            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-2xl">
                                ⚡
                            </div>

                        </div>
                    </div>

                </div>

                <!-- BOOKMARK LIST (UNCHANGED DESIGN) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Recent Bookmarks
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Your latest saved links
                            </p>
                        </div>

                        <a href="#" class="text-sm font-medium text-black hover:underline">
                            View All
                        </a>

                    </div>

                    @forelse($bookmarks as $bookmark)

                        <div class="flex items-center justify-between p-4 border-b">

                            <div>
                                <h3 class="font-semibold">{{ $bookmark->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $bookmark->url }}</p>
                            </div>

                            <div class="flex gap-3">

                                <!-- EDIT -->
                                <button
                                    @click="
                                        editOpen = true;
                                        id = {{ $bookmark->id }};
                                        title = '{{ addslashes($bookmark->title) }}';
                                        url = '{{ addslashes($bookmark->url) }}';
                                    "
                                    class="text-blue-600">
                                    Quick Edit
                                </button>

                                <!-- DELETE -->
                                <form action="{{ route('bookmarks.destroy', $bookmark->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-500">
                                        Delete
                                    </button>
                                </form>

                            </div>

                        </div>

                    @empty

                        <div class="p-6 text-center text-gray-500">
                            No bookmarks yet
                        </div>

                    @endforelse

                </div>

            </div>
        </div>

        <!-- ================= CREATE MODAL ================= -->
        <div
            x-show="createOpen"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
            style="display: none;"
        >

            <div class="bg-white w-96 p-6 rounded-lg">

                <h2 class="text-lg font-bold mb-4">Create Bookmark</h2>

                <form action="{{ route('bookmarks.store') }}" method="POST">
                    @csrf

                    <input type="text"
                           name="title"
                           placeholder="Title"
                           class="w-full border p-2 mb-3">

                    <input type="text"
                           name="url"
                           placeholder="URL"
                           class="w-full border p-2 mb-3">

                    <div class="flex justify-end gap-2">

                        <button type="button"
                                @click="createOpen = false"
                                class="px-3 py-1 bg-gray-200">
                            Cancel
                        </button>

                        <button type="submit"
                                class="px-3 py-1 bg-black text-white">
                            Save
                        </button>

                    </div>

                </form>

            </div>

        </div>

        <!-- ================= EDIT MODAL ================= -->
        <div
            x-show="editOpen"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
            style="display: none;"
        >

            <div class="bg-white w-96 p-6 rounded-lg">

                <h2 class="text-lg font-bold mb-4">Edit Bookmark</h2>

                <form :action="'/bookmarks/' + id" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text"
                           name="title"
                           x-model="title"
                           class="w-full border p-2 mb-3">

                    <input type="text"
                           name="url"
                           x-model="url"
                           class="w-full border p-2 mb-3">

                    <div class="flex justify-end gap-2">

                        <button type="button"
                                @click="editOpen = false"
                                class="px-3 py-1 bg-gray-200">
                            Cancel
                        </button>

                        <button type="submit"
                                class="px-3 py-1 bg-black text-white">
                            Update
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>