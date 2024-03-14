<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorites;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function show() {
        $auth = auth()->user();
        $favorites = FavoriteResource::collection($auth->favorites);
        return $favorites;
    }

    public function create_or_delete($product) {
        $data = [
            'user_id' => auth()->id(),
            'product_id' => $product,
        ];
        $favorite = Favorites::where(['user_id' => auth()->id() ,'product_id' => $product])->first();
        if($favorite) {
            $favorite->delete();
            return response()->json([
                'message' => 'Delete favorite product successfully',
                'status_code' => 200,
            ]);
        } else {
            Favorites::create($data);
            return response()->json([
                'message' => 'Add favorite product successfully',
                'status_code' => 200,
            ]);
        }
    }
}