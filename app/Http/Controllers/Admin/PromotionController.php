<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('start_date', 'desc')->paginate(15);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.promotions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'title_en' => 'nullable|max:255',
            'slug' => 'required|unique:promotions,slug|max:255',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'show_on_slider' => 'boolean',
            'is_active' => 'boolean',
            'products' => 'array',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('promotions', $filename, 'public');
            $validated['image'] = $path;
        }

        $validated['show_on_slider'] = $request->has('show_on_slider');
        $validated['is_active'] = $request->has('is_active');
        $promotion = Promotion::create($validated);

        if (!empty($validated['products'])) {
            $promotion->products()->sync($validated['products']);
        }

        return redirect()->route('admin.promotions.index')->with('success', 'Акция создана');
    }

    public function edit(Promotion $promotion)
    {
        $products = Product::all();
        return view('admin.promotions.edit', compact('promotion', 'products'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'title_en' => 'nullable|max:255',
            'slug' => 'required|max:255|unique:promotions,slug,' . $promotion->promotion_id . ',promotion_id',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'show_on_slider' => 'boolean',
            'is_active' => 'boolean',
            'products' => 'array',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('promotions', $filename, 'public');
            $validated['image'] = $path;
        }

        $validated['show_on_slider'] = $request->has('show_on_slider');
        $validated['is_active'] = $request->has('is_active');
        $promotion->update($validated);

        if (!empty($validated['products'])) {
            $promotion->products()->sync($validated['products']);
        } else {
            $promotion->products()->detach();
        }

        return redirect()->route('admin.promotions.index')->with('success', 'Акция обновлена');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('admin.promotions.index')->with('success', 'Акция удалена');
    }
}