<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Item::with(['user', 'category'])->active();

        // Search functionality
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by type
        if ($request->type && in_array($request->type, ['lost', 'found'])) {
            $query->where('type', $request->type);
        }

        // Filter by category
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Sort
        $query->latest();

        $items = $query->paginate(12);
        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    public function show(Item $item)
    {
        $item->load(['user', 'category']);
        
        // Get similar items
        $similarItems = Item::where('category_id', $item->category_id)
            ->where('type', $item->type)
            ->where('id', '!=', $item->id)
            ->active()
            ->limit(4)
            ->get();

        return view('items.show', compact('item', 'similarItems'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:lost,found',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location' => 'nullable|string|max:255',
            'date_found' => 'nullable|date|before_or_equal:today',
            'reward' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expires_at' => 'nullable|date|after:today'
        ]);

        $data = [
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'date_found' => $request->date_found ? Carbon::parse($request->date_found) : null,
            'reward' => $request->reward,
            'status' => 'active',
            'expires_at' => $request->expires_at ? Carbon::parse($request->expires_at) : null
        ];

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('items', 'public');
            }
            $data['images'] = $imagePaths;
        }

        Item::create($data);

        return redirect()->route('items.index')->with('success', 'Item posted successfully!');
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'reward' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,resolved',
            'expires_at' => 'nullable|date|after:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        
        // Handle expires_at properly - convert to Carbon or set to null
        if ($request->expires_at) {
            $data['expires_at'] = Carbon::parse($request->expires_at);
        } else {
            $data['expires_at'] = null;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }
            
            $imagePath = $request->file('image')->store('items', 'public');
            $data['image_path'] = $imagePath;
        }

        $item->update($data);

        return redirect()->route('items.show', $item)->with('success', 'Item updated successfully!');
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);

        // Delete image if exists
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully!');
    }

    /**
     * Mark an item as resolved/returned
     */
    public function markAsResolved(Item $item)
    {
        $this->authorize('update', $item);
        
        $item->update(['status' => 'resolved']);
        
        return back()->with('success', 'Item marked as resolved!');
    }

    /**
     * Reactivate a resolved item
     */
    public function reactivate(Item $item)
    {
        $this->authorize('update', $item);
        
        $item->update(['status' => 'active']);
        
        return back()->with('success', 'Item reactivated!');
    }
}
