<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('product_id', 'desc')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,category_id',
            'name' => 'required|max:255',
            'name_en' => 'nullable|max:255',
            'slug' => 'required|unique:products,slug|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products', $filename, 'public');
            $validated['main_image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Товар добавлен');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $images = $product->product_images()->orderBy('sort_order')->get();
        return view('admin.products.edit', compact('product', 'categories', 'images'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,category_id',
            'name' => 'required|max:255',
            'name_en' => 'nullable|max:255',
            'slug' => 'required|max:255|unique:products,slug,' . $product->product_id . ',product_id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products', $filename, 'public');
            $validated['main_image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Товар обновлён');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Товар удалён');
    }

    // Метод для добавления изображения в галерею
    public function storeImage(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('image');
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('product_images', $filename, 'public');

        $maxOrder = $product->product_images()->max('sort_order') ?? 0;

        ProductImage::create([
            'product_id' => $product->product_id,
            'image_path' => $path,
            'sort_order' => $maxOrder + 1,
        ]);

        return redirect()->back()->with('success', 'Изображение добавлено');
    }

    // Метод для обновления порядка изображений (AJAX)
    public function updateImageOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'required|integer|exists:product_images,img_id',
        ]);

        foreach ($request->order as $index => $imgId) {
            ProductImage::where('img_id', $imgId)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    // Метод для удаления изображения
    public function destroyImage(ProductImage $image)
    {
        // Удаляем файл из хранилища
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->back()->with('success', 'Изображение удалено');
    }
}