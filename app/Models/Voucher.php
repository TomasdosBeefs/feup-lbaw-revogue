<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Voucher extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'belongs_to',
        'product',
        'bargain',
        'applied_voucher',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $hidden = [
        'code',
    ];

    public function voucherBelongsTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'belongs_to');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product');
    }

    public function bargainMessage(): BelongsTo
    {
        return $this->belongsTo(Bargain::class, 'bargain');
    }

    public function appliedVoucher(): HasOne
    {
        return $this->hasOne(CartProduct::class, 'applied_voucher');
    }

    protected $table = 'vouchers';
}
