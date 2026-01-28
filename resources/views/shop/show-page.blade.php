@extends('layouts.app')

@section('title', $product->name ?? 'Awesome Shop')

@section('content')

    @if($product)

        <div class="max-w-7xl mx-auto px-6 py-16">


            <section class="product-wrapper mt-32">

                <div class="product-image">
                    <img src="{{ $product->image && file_exists(storage_path('app/products/' . $product->image))
                ? asset('storage/' . $product->image)
                : 'https://picsum.photos/600?random=' . rand(1,1000) }}"
                         alt="{{ $product->name }}">
                </div>

                <div class="product-details">
                    <h1 class="product-title">{{ $product->name }}</h1>

                    <p class="product-category">
                        Category • <strong>{{ $product->category->name }}</strong>
                    </p>

                    <p class="product-description">
                        {{ $product->description ?? 'No description available.' }}
                    </p>

                    <div class="price-section">
                        <span class="price-label">Price</span>
                        <span class="price-amount">₹ {{ number_format($product->price, 2) }}</span>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('cart.add', $product->uuid) }}" class="btn-primary">
                            🛒 Add to Cart
                        </a>
                    </div>
                </div>

            </section>



            {{-- =============================
                PRODUCTS GROUPED BY CATEGORY
            ============================= --}}
            @foreach($productsByCategory as $categoryName => $products)
                <section class="category-section mt-16">

                    <h2 class="related-title mb-8 text-2xl font-bold">
                        {{ $categoryName }}
                    </h2>

                    <div class="related-grid">
                        @foreach($products as $item)
                            <div class="related-card">

                                <div class="related-image">
                                    <img src="{{ $item->image && file_exists(storage_path('app/products/' . $item->image))
                                ? asset('storage/' . $item->image)
                                : 'https://picsum.photos/300?random=' . rand(1,1000) }}"
                                         alt="{{ $item->name }}">
                                </div>

                                <div class="related-content">
                                    <h3 class="related-name">{{ $item->name }}</h3>
                                    <p class="related-price">₹ {{ number_format($item->price) }}</p>

                                    <div class="related-actions">
                                        <a href="{{ route('cart.add', $item->uuid) }}"
                                           class="make-payment-btn">
                                            <i class="fas fa-shopping-bag buy-icon"></i> Buy →
                                        </a>

                                        <a href="{{ route('shop.show', $item->uuid) }}"
                                           class="show-product-details">
                                            <i class="fas fa-eye show-icon"></i> Show →
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach

            {{-- =============================
                RELATED PRODUCTS
            ============================= --}}
            @if($relatedProducts->count())
                <section class="related-wrapper mt-24">

                    <h2 class="related-title mb-8 text-2xl font-bold">
                        Related Products
                    </h2>

                    <div class="related-grid">
                        @foreach($relatedProducts as $related)
                            <div class="related-card">

                                <div class="related-image">
                                    <img src="{{ $related->image && file_exists(storage_path('app/products/' . $related->image))
                                ? asset('storage/' . $related->image)
                                : 'https://picsum.photos/300?random=' . rand(1,1000) }}"
                                         alt="{{ $related->name }}">
                                </div>

                                <div class="related-content">
                                    <h3 class="related-name">{{ $related->name }}</h3>
                                    <p class="related-price">₹ {{ number_format($related->price) }}</p>

                                    <div class="related-actions">
                                        <a href="{{ route('cart.add', $related->uuid) }}"
                                           class="make-payment-btn">
                                            <i class="fas fa-shopping-bag buy-icon"></i> Buy
                                        </a>

                                        <a href="{{ route('shop.show', $related->uuid) }}"
                                           class="show-product-details">
                                            <i class="fas fa-eye show-icon"></i> Show
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                </section>
            @endif

            {{-- =============================
                MAIN PRODUCT HERO
            ============================= --}}

        </div>

    @else
        {{-- ❌ NO PRODUCT --}}
        <div class="text-center py-32">
            <h2 class="text-2xl font-bold text-gray-600">
                Product not found 😕
            </h2>
        </div>
    @endif

@endsection


<script src="{{ asset('js/folder-slider.js') }}"></script>



