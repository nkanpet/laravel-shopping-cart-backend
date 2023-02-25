<?php

namespace App\Services;

use App\Models\Cart;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;

class CartService
{
    protected $cartRepository;
    protected $productRepository;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function getLatest($where = [])
    {
        return $this->cartRepository->findLatest($where);
    }

    public function getById($id)
    {
        return $this->cartRepository->findByField('id', $id);
    }

    public function create($data = [])
    {
        return $this->cartRepository->create($data);
    }

    public function updateOrCreate($attributes = [], $values = [])
    {
        return $this->cartRepository->updateOrCreate($attributes, $values);
    }

    public function addItem(Cart $cart, $product_id, $quantity)
    {
        $product = $this->productRepository->find($product_id);

        // return if product not found
        if (!$product) {
            return (object) [
                'error' => 'Product not found'
            ];
        }

        $cart_product = $cart->cart_products()->where('product_id', $product_id)->first();
        if ($cart_product) {
            $cart_product->quantity += $quantity;
            $cart_product->save();
        } else {
            $cart_product = $cart->cart_products()->create([
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);
        }

        return $cart;
    }

    public function updateItem(Cart $cart, $cart_product_id, $quantity)
    {
        $cart_product = $cart->cart_products()->where('id', $cart_product_id)->first();

        if ($cart_product) {
            $cart_product->quantity = $quantity;
            $cart_product->save();
        }

        return $cart;
    }

    public function deleteItem(Cart $cart, $cart_product_id)
    {
        return $cart->cart_products()->where('id', $cart_product_id)->delete();
    }
}
