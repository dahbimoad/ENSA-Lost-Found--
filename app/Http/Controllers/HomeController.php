<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $recentLostItems = Item::with(['user', 'category'])
            ->active()
            ->lost()
            ->latest()
            ->limit(6)
            ->get();

        $recentFoundItems = Item::with(['user', 'category'])
            ->active()
            ->found()
            ->latest()
            ->limit(6)
            ->get();

        $categories = Category::withCount('items')->get();

        $stats = [
            'total_items' => Item::active()->count(),
            'lost_items' => Item::active()->lost()->count(),
            'found_items' => Item::active()->found()->count(),
        ];

        return view('home', compact('recentLostItems', 'recentFoundItems', 'categories', 'stats'));
    }
}
