<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $categoryId = $request->input('category');
        
        $products = Product::when($searchQuery, function ($query, $searchQuery) {
            return $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'LIKE', "%{$searchQuery}%")
                ->orWhere('description', 'LIKE', "%{$searchQuery}%");
            });
        })
        ->when($categoryId, function ($query) use ($categoryId) {
            return $query->where('category', $categoryId);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(3); 

        return ProductResource::collection($products); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $requestValidated = $request->validated();
    
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path; 
            }
            $requestValidated['images'] = json_encode($imagePaths);
        }
    
        $createdAt = $request->input('date') . ' ' . $request->input('time');
        $requestValidated['created_at'] = $createdAt;
    
        $requestValidated['user_id'] = auth()->id();
    
        $product = Product::create($requestValidated);
    
        return response()->json([
            'data' => 'Created Successfully',
            'product' => $product,
            'redirect_url' => route('products.index') 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return new ProductResource($product);

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $requestValidated = $request->validated();

        if ($request->hasFile('images')) {
            $imagePaths = [];

            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }

            $requestValidated['images'] = json_encode($imagePaths); 
        }

        $product->update($requestValidated);

        return response()->json([
            'data' => 'Updated Successfully',
            'product' => $product
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'data' => "Deleted Successfully",
        ]);
    }
}
