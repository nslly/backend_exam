<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke()
    {
        $categories = Product::select('category')->distinct()->pluck('category');
        return response()->json($categories);
    }
}
