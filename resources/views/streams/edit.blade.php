@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Stream') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ route('streams.update', $stream) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ old('title', $stream->title) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $stream->description) }}</textarea>
                    </div>

                    <!-- Tokens Price -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tokens Price</label>
                        <input type="number" name="tokens_price"
                               value="{{ old('tokens_price', $stream->tokens_price) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('tokens_price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Stream Type -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Select Type --</option>
                            @foreach ($types as $type)
                                <option
                                    value="{{ $type->id }}" {{ old('type', $stream->type) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Expiration -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Expiration Date</label>
                        <input type="datetime-local" name="date_expiration"
                               value="{{ old('date_expiration', Carbon::parse($stream->date_expiration)->format('Y-m-d\TH:i')) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('date_expiration') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Submit -->
                    <div class="mt-6">
                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow transition">
                            💾 Update Stream
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
