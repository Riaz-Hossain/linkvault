<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-10 px-4">

        <div class="max-w-xl mx-auto">

            <!-- Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Add Bookmark</h1>
                    <p class="text-gray-500 text-sm">Save a new link to your collection</p>
                </div>

                <a href="{{ route('bookmarks.index') }}"
                   class="text-sm text-gray-600 hover:text-black">
                    ← Back
                </a>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-xl shadow p-6">

                <!-- Errors -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 p-4 mb-6 rounded-lg">
                        <ul class="list-disc pl-5 space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('bookmarks.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Title
                        </label>
                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="e.g. Laravel Docs"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-black focus:outline-none transition">
                    </div>

                    <!-- URL -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            URL
                        </label>
                        <input type="text"
                               name="url"
                               value="{{ old('url') }}"
                               placeholder="https://example.com"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-black focus:outline-none transition">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Description <span class="text-gray-400">(optional)</span>
                        </label>
                        <textarea name="description"
                                  rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-black focus:outline-none transition"
                                  placeholder="Short note about this link...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4">

                        <a href="{{ route('bookmarks.index') }}"
                           class="text-gray-500 hover:text-black text-sm">
                            Cancel
                        </a>

                        <button type="submit"
                                class="bg-black text-white px-6 py-2.5 rounded-lg hover:bg-gray-800 transition shadow">
                            Save Bookmark
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</x-app-layout>