<a href="/products/{{$id}}">
    <div class="product-card">
        <div class="product-image-card">
            <!--TODO (luisd): do the random hash if only on debug mode -->
            <img src="{{ $image }}?hash={{fake()->lexify('???????????????')}}" loading="lazy" decoding="async" alt="product image">
        </div>
        <div class="product-description-card">
            <div class="product-size">
                <p>{{ $size }}</p>
            </div>
            <div class="product-price">
                <p>{{ $price }}</p>
            </div>
        </div>
    </div>
</a>