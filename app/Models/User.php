<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Added to define Eloquent relationships.
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const CREATED_AT = 'creation_date';

    const UPDATED_AT = null;

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'display_name',
        'email',
        'password',
        'settings',
        'profile_image_path',
        'bio',
        'account_status',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'settings',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'creation_date' => 'datetime',
        'password' => 'hashed',
        'settings' => 'array',
    ];

    public function messagesFrom(): HasMany
    {
        return $this->hasMany(Message::class, 'from_user');
    }

    public function messagesTo(): HasMany
    {
        return $this->hasMany(Message::class, 'to_user');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'sold_by');
    }

    public function voucher(): HasOne
    {

        return $this->hasOne(Voucher::class, 'belongs_to');
    }

    public function reviewing(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewer');
    }

    public function reviewed(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewed');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'belongs_to');
    }

    public function reporter(): HasMany
    {
        return $this->hasMany(Report::class, 'reporter');
    }

    public function reported(): HasMany
    {
        return $this->hasMany(Report::class, 'reported');
    }

    public function cart(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cartproduct', 'belongs_to', 'product')->using(CartProduct::class);
    }

    public function wishlist(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'productwishlist', 'belongs_to', 'product');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
}
