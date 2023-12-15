<div class="product-message-thread" data-product-id="{{$product->id}}">
    <img class="profile-image" src="{{$soldBy->profile_image_path !== null ? '/storage/'.$soldBy->profile_image_path :  '/defaultProfileImage.png'}}">
    <div class="product-message-thread-details">
        <a href="/profile/{{$soldBy->id}}" class="username">{{$soldBy->username}}</a>
        <p class="content">{{$latestMessage->sent_date->diffForHumans(null,true)}} <span>&#183;</span> {{$latestMessage->text_content}}</p>
    </div>
    <img class="product-image" src="{{$product->image_paths[0]}}">
</div>