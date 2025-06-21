<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_items' => Item::count(),
            'active_items' => Item::where('status', 'active')->count(),
            'resolved_items' => Item::where('status', 'resolved')->count(),
            'lost_items' => Item::where('type', 'lost')->count(),
            'found_items' => Item::where('type', 'found')->count(),
            'users_this_month' => User::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
            'items_this_month' => Item::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
        ];

        $recentUsers = User::latest()->limit(5)->get();
        $recentItems = Item::with(['user', 'category'])->latest()->limit(10)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentItems'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('student_id', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function items(Request $request)
    {
        $query = Item::with(['user', 'category']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $items = $query->latest()->paginate(20);

        return view('admin.items', compact('items'));
    }

    public function deleteItem(Item $item)
    {
        // Delete images if they exist
        if ($item->images) {
            foreach ($item->images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $item->delete();

        return back()->with('success', 'Item deleted successfully.');
    }

    public function toggleUserAdmin(User $user)
    {
        $user->update(['is_admin' => !$user->is_admin]);

        $status = $user->is_admin ? 'granted' : 'removed';
        return back()->with('success', "Admin privileges {$status} for {$user->name}.");
    }
}
