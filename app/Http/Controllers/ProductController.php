<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function Pest\Laravel\json;

class ProductController extends Controller
{
    /**
     * Fetch products to display on frontend
     *
     * @return JsonResource
     */
    public function get(Request $request)
    {
        $request->validate([
            'status' => 'integer|max:1|min:0',
            'page_size' => 'nullable|integer',
            'visible' => 'nullable|boolean',
        ]);
        try {
            // fetch products
            $products = Product::where('status', $request->integer('status', 1))
                ->where('visibility', $request->boolean('visibility', true))
                ->paginate($request->integer('page_size', 10));

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
