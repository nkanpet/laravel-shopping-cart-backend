<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\CartEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartAddItemRequest;
use App\Http\Requests\CartUpdateItemRequest;
use App\Http\Resources\Cart as CartResource;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $user = Auth::user();
        $cart = $this->cartService->updateOrCreate(['user_id' => $user->id, 'status' => CartEnum::STATUS_CREATE], ['user_id' => $user->id]);

        return response()->json([
            'success' => true,
            'data' => new CartResource($cart),
            'message' => 'Add item success'
        ], 200);
    }

    public function addItem(CartAddItemRequest $request)
    {
        $user = Auth::user();
        $cart = $this->cartService->updateOrCreate(['user_id' => $user->id, 'status' => CartEnum::STATUS_CREATE], ['user_id' => $user->id]);

        $cart = $this->cartService->addItem($cart, $request->product_id, $request->quantity);

        if (isset($cart->error)) {
            return response()->json([
                'success' => false,
                'message' => $cart->error
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => new CartResource($cart),
            'message' => 'Add item success'
        ], 200);
    }

    public function updateItem(CartUpdateItemRequest $request, $cart_product_id)
    {
        $user = Auth::user();
        $cart = $this->cartService->updateOrCreate(['user_id' => $user->id, 'status' => CartEnum::STATUS_CREATE], ['user_id' => $user->id]);

        $cart = $this->cartService->updateItem($cart, $cart_product_id, $request->quantity);

        if (isset($cart->error)) {
            return response()->json([
                'success' => false,
                'message' => $cart->error
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => new CartResource($cart),
            'message' => 'Add item success'
        ], 200);
    }

    public function deleteItem($id)
    {
        $user = Auth::user();

        $cart = $this->cartService->getLatest(['user_id' => $user->id, 'status' => CartEnum::STATUS_CREATE]);
        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found'
            ], 404);
        }

        $this->cartService->deleteItem($cart, $id);

        return response()->json([
            'success' => true,
            'data' => new CartResource($cart),
            'message' => 'Delete success'
        ], 200);
    }
}
