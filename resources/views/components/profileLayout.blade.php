<div class="profile-layout">
    <div class="profile-picture-container">
        <img src="{{ $profilePicture }}" alt="profile picture">
    </div>
    <div class="profile-description">
        <div class="profile-descriptiom-top">
            <div class="profile-name">
                <h1>{{ $name }}</h1>
            </div>
            <div class="profile-username">
                <h2> {{'@' . $username }}</h2>
            </div>
            <div class="rating">
                <ion-icon name="star-outline"></ion-icon>
                <ion-icon name="star-outline"></ion-icon>
                <ion-icon name="star-outline"></ion-icon>
                <ion-icon name="star-outline"></ion-icon>
                <ion-icon name="star-outline"></ion-icon>
                <a href></a>
            </div>
        </div>
        <div class="profile-description-bottom">
            <div class="profile-bio">
                <p>{{ $bio }}</p> 
            </div>
        </div>
    </div>
</div>