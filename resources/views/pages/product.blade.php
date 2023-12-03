@extends('layouts.app', ['search_bar' => true])


@section('content')
<section class="column justify-center gap-1">
    <div class="categories">
        <p>
            <a href="/">Home</a><span class="separator">/</span>
            @foreach ($categories as $category)

            <a href="#">{{$category->name}}</a>
            @if(!$loop->last)
            <span class="separator">/</span>
            @endif
            @endforeach
        </p>
    </div>
    <div class="column justify-center gap-3">
        <div class="layout-wrapper">
            <div class="product-image column">
                <div class="swiper gallery-main">
                    <div class="swiper-wrapper">
                        @foreach ($product->image_paths as $productPhoto)
                            <div class="swiper-slide" style='background-image:url("{{ $productPhoto }}")'></div>
                        @endforeach
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>
                </div>
                <div class="swiper gallery-thumbs">
                    <div class="swiper-wrapper">
                        @foreach ($product->image_paths as $previewPhoto)
                            <div class="swiper-slide" style='background-image:url("{{ $previewPhoto }}")'></div>
                        @endforeach
                    </div>
                </div>
                <!--TODO(luisd): maybe abstract this into a blade component? -->
                @if ($sold === false)
                @if ($isInWishlist)
                <a href="#" id="wishlist_button" data-inWishlist="true" data-productId="{{$product->id}}">
                    <ion-icon name="heart"></ion-icon>
                    @else
                    <a href="#" id="wishlist_button" data-inWishlist="false" data-productId="{{$product->id}}">
                        <ion-icon name="heart-outline"></ion-icon>
                        @endif
                    </a>
                    @endif
            </div>
            <div class="product-details">
                <div class="product-title">
                    <h1 class="title">{{$product->name}}</h1>
                </div>
                <div class="product-price-shipping">
                    <div class="product-price">
                        <h3> {{$product->price}}€</h3>
                    </div>
                    <div class="product-shipping">
                        <h3>Shipping: 2€</h3>
                    </div>
                </div>
                <div class="product-info">
                    <p>@foreach ($attributes as $attribute)
                        {{$attribute->key}} - {{$attribute->value}}
                        @if (!$loop->last)
                        <span class="separator">•</span>
                        @endif
                        @endforeach
                    </p>
                </div>
                <div class="product-description">
                    <p>{{$product->description}}</p>
                </div>
                @if ($sold === true)
                <h3 class="product-sold">This item already has been sold</h3>
                @else
                @if ($ownProduct === false)
                <div class="product-buttons">
                    <button class="buy-now">Buy now</button>
                    <button class="add-to-cart">Add to cart</button>
                </div>
                @else
                <div class="product-buttons">
                    <form method="POST" action="/products/{{$product->id}}/delete">
                        @csrf
                        <button class="delete-product" type="submit">Delete</button>
                    </form>
                    <a href="/products/{{$product->id}}/edit" class="edit-product"><button>Edit</button></a>
                </div>
                @endif

                @endif

            </div>
        </div>
        <div class="layout-wrapper">
            <div class="reviews w-full">
                <h3 class="title">Reviews</h3>
                <p>There are no reviews yet.</p>
                <!-- TODO -->
            </div>
            <div class="seller column gap-1">
                <div class="sold-by">
                    <h3 class="title">Sold by:</h3>
                </div>
                <div class="seller-wrapper">
                    <div class="profile-pic">
                        <img id="image" src="/storage/{{ $imagePath }}">
                    </div>
                    <div class="seller-info">
                        <div class="seller-name">
                            <div class="seller-display-name">
                                <h3>{{$user->display_name}}</h3>
                            </div>
                            <div class="seller-username">
                                <p>@ {{$user->username}}</p>
                            </div>
                        </div>
                        <div class="seller-rating">
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star-half-outline"></ion-icon>
                            <ion-icon name="star-outline"></ion-icon>
                        </div>
                        <div class="seller-buttons">
                            <button class="ask-question">Ask a question</button>
                            <button class="visit-shop"><a href="/profile/{{$user->id}}">Visit shop</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection