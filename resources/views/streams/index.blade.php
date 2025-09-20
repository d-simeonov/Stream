@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-center mb-6">
                <!-- Create Button -->
                <a href="{{ route('streams.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow">
                    ➕ Create New Stream
                </a>

                <!-- Filter + Sort Form -->
                <form method="GET" action="{{ route('streams.index') }}" class="flex flex-wrap gap-3 items-center">
                    <!-- Filter by Type -->
                    <select name="type" class="w-40 border rounded px-3 py-2 text-sm">
                        <option value="">All Types</option>
                        <option value="1" {{ $type == 1 ? 'selected' : '' }}>Sports</option>
                        <option value="2" {{ $type == 2 ? 'selected' : '' }}>E-Book</option>
                        <option value="3" {{ $type == 3 ? 'selected' : '' }}>Podcast</option>
                        <option value="4" {{ $type == 4 ? 'selected' : '' }}>Arts</option>
                        <option value="5" {{ $type == 5 ? 'selected' : '' }}>Music</option>
                    </select>

                    <select name="sort" class="border rounded px-3 py-2 text-sm">
                        <option value="">Sort By</option>
                        <option value="title_asc" {{ $sort == 'title_asc' ? 'selected' : '' }}>Title A–Z</option>
                        <option value="title_desc" {{ $sort == 'title_desc' ? 'selected' : '' }}>Title Z–A</option>
                        <option value="expiration_asc" {{ $sort == 'expiration_asc' ? 'selected' : '' }}>Soonest Expiring</option>
                        <option value="expiration_desc" {{ $sort == 'expiration_desc' ? 'selected' : '' }}>Latest Expiring</option>
                    </select>


                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-semibold">
                        Apply
                    </button>
                </form>
            </div>



        @foreach ($streams as $stream)
                @php
                    $expiration = Carbon::parse($stream->date_expiration);
                    $expiresSoon = $expiration->isBetween(now(), now()->addDays(7));
                    $isExpired = $expiration->isPast();
                @endphp

                <div class="bg-white shadow-sm sm:rounded-lg mb-4 p-6">
                    <h3 class="text-lg font-bold">{{ $stream->title }}</h3>
                    <p>{{ $stream->description }}</p>
                    <p><strong>Type:</strong> {{ $stream->streamType->name ?? 'None' }}</p>

                    <p>
                        <strong>Expires:</strong> {{ $expiration->format('M d, Y H:i') }}

                        @if ($isExpired)
                            <span
                                class="ml-2 inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded">
                    ❌ Expired
                </span>
                        @elseif ($expiresSoon)
                            <span
                                class="ml-2 inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">
                    ⚠️ Expiring Soon
                </span>
                        @endif
                    </p>

                    <!-- Buttons -->
                    <div class="mt-4 flex flex-wrap gap-3">
                        @can('update', $stream)
                            <a href="{{ route('streams.edit', $stream) }}"
                               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-md shadow transition">
                                ✏️ Edit Stream
                            </a>
                        @endcan
                        @can('delete', $stream)
                            <form action="{{ route('streams.destroy', $stream) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this stream?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-md shadow transition">
                                    🗑️ Delete Stream
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach


            {{ $streams->links() }}
        </div>
    </div>
</x-app-layout>
