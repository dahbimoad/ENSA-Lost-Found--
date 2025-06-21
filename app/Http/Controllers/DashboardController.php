<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Get user's items with filtering
        $query = Item::where('user_id', $user->id)->with('category');
        
        // Filter by status
        if ($request->status && in_array($request->status, ['active', 'resolved'])) {
            $query->where('status', $request->status);
        }
        
        // Filter by type
        if ($request->type && in_array($request->type, ['lost', 'found'])) {
            $query->where('type', $request->type);
        }
        
        $myItems = $query->latest()->paginate(10);
        
        // Get statistics
        $stats = [
            'total_items' => Item::where('user_id', $user->id)->count(),
            'active_items' => Item::where('user_id', $user->id)->where('status', 'active')->count(),
            'resolved_items' => Item::where('user_id', $user->id)->where('status', 'resolved')->count(),
            'lost_items' => Item::where('user_id', $user->id)->where('type', 'lost')->count(),
            'found_items' => Item::where('user_id', $user->id)->where('type', 'found')->count(),
        ];
        
        // Get recent activity (items that were resolved in the last 30 days)
        $recentActivity = Item::where('user_id', $user->id)
            ->where('status', 'resolved')
            ->where('updated_at', '>=', Carbon::now()->subDays(30))
            ->with('category')
            ->latest('updated_at')
            ->limit(5)
            ->get();
        
        return view('dashboard', compact('myItems', 'stats', 'recentActivity'));
    }
}
