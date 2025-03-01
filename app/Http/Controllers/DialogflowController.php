<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class DialogflowController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $parameters = $request->input('queryResult.parameters');
        $categoryName = $parameters['category'] ?? null;

        if (!$categoryName) {
            return response()->json([
                "fulfillmentText" => "I didn't understand the category. Can you repeat it?"
            ]);
        }

        $category = Category::where('name', $categoryName)->first();

        if (!$category) {
            return response()->json([
                "fulfillmentText" => "I couldn't find the category $categoryName in the database."
            ]);
        }

        $productCount = $category->products()->sum('quantity');

        return response()->json([
            "fulfillmentText" => "There are $productCount products in the $categoryName category."
        ]);
    }
}

