<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-10 px-4">

        <div class="max-w-3xl mx-auto">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Bookmarks</h1>
                    <p class="text-gray-500 text-sm">Manage your saved links</p>
                </div>

                <a href="{{ route('bookmarks.create') }}"
                   class="bg-black text-white px-5 py-2.5 rounded-lg shadow hover:bg-gray-800 transition">
                    + Add Bookmark
                </a>
            </div>

            <!-- List -->
            <div class="space-y-4">
                @forelse($bookmarks as $bookmark)

                    <div class="bg-white p-5 rounded-xl shadow-sm hover:shadow-md transition">

                        <div class="flex justify-between items-start">

                            <!-- Info -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ $bookmark->title }}
                                </h3>

                                <a href="{{ $bookmark->url }}" target="_blank"
                                   class="text-sm text-blue-500 hover:underline break-all">
                                    {{ $bookmark->url }}
                                </a>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-4">

                                <!-- EDIT -->
                                <button
                                    @click="
                                        editOpen = true;
                                        id = {{ $bookmark->id }};
                                        title = '{{ addslashes($bookmark->title) }}';
                                        url = '{{ addslashes($bookmark->url) }}';
                                    "
                                    class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                    Edit
                                </button>

                                <!-- DELETE -->
                                <form action="{{ route('bookmarks.destroy', $bookmark->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-500 hover:text-red-700 font-medium text-sm">
                                        Delete
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <!-- Empty State -->
                    <div class="bg-white p-10 rounded-xl shadow text-center">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">
                            No bookmarks yet
                        </h2>
                        <p class="text-gray-500 mb-4">
                            Start saving your favorite links.
                        </p>

                        <a href="{{ route('bookmarks.create') }}"
                           class="inline-block bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">
                            + Add Your First Bookmark
                        </a>
                    </div>

                @endforelse
            </div>

        </div>

    </div>
</x-app-layout>