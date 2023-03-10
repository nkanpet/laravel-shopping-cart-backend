<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Cart.
 *
 * @package namespace App\Models;
 */
class Cart extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id'];
    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function cart_products()
    {
        return $this->hasMany(CartProduct::class);
    }
}
