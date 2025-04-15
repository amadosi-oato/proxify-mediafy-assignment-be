<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductController extends Controller
{
    /**
     * Fetch products to display on frontend
     *
     * @return JsonResource
     */
    public function get(Request $request)
    {
        try {
            // fetch products
            $products = Product::where('status', 1)
                ->paginate($request->integer('page_size', 10));

            // return products
            return ProductResource::collection($products);
        } catch (\Exception $e) {
            $response = new JsonResource(
                [
                    'error' => __('There was an error processing the request. Please try again.' . $e->getMessage()),
                ]
            );
            $response::withoutWrapping();
            return $response;
        }
    }
}
