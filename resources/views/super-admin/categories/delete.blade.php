@extends('layouts.app')

@section('title')
    Delete Categories
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">

        <h2 class="text-4xl font-extrabold mb-10 text-gray-800 text-center">
            🗑 Delete Categories
        </h2>

        @if(session('success'))
            <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl shadow-lg text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($categories as $category)
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden group">

                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/'.$category->photo) }}"
                             class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/30"></div>
                    </div>

                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            {{ $category->name }}
                        </h3>

                        @if(auth()->user()->role === 'super_admin')
                            <button
                                class="delete-btn"
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->name }}">
                                🗑 Delete Category
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

        <!-- 🔥 DELETE CONFIRMATION MODAL -->
        <div id="deleteModal" class="delete-modal hidden">
            <div class="modal-card">

                <div class="warning-icon">⚠️</div>

                <h3 class="modal-title">Are you really sure?</h3>

                <p class="modal-text">
                    This will permanently delete
                    <span id="deleteItemName"></span>
                    and its image.
                </p>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-actions">
                        <button type="button" id="cancelDelete" class="btn-cancel">
                            ❌ Cancel
                        </button>

                        <button type="submit" class="btn-confirm">
                            ✅ Yes, Delete
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endsection

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/delete-modal.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/delete-modal.js') }}"></script>
    @endpush
