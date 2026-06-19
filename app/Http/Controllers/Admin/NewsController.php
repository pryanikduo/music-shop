<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'title_en' => 'nullable|max:255',   // добавить
            'slug' => 'required|unique:news,slug|max:255',
            'content' => 'required',
            'content_en' => 'nullable|string',  // добавить
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'required|date',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('news', $filename, 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Новость добавлена');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'title_en' => 'nullable|max:255',
            'slug' => 'required|max:255|unique:news,slug,' . $news->news_id . ',news_id',
            'content' => 'required',
            'content_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'required|date',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('news', $filename, 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Новость обновлена');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Новость удалена');
    }
}