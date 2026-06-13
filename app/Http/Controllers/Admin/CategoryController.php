<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('category')->orderBy('sort_order')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:categories,category_id',
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug|max:255',
            'type' => 'required|in:instruments,accessories',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        $validated['is_active'] = $request->has('is_active');
        Category::create($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Категория создана');
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')->where('category_id', '!=', $category->category_id)->get();
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:categories,category_id',
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:categories,slug,' . $category->category_id . ',category_id',
            'type' => 'required|in:instruments,accessories',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        $validated['is_active'] = $request->has('is_active');
        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Категория обновлена');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Категория удалена');
    }
}