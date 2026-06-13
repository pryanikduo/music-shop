<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:pages,slug|max:100',
            'title' => 'required|max:255',
            'content' => 'required',
            'meta_description' => 'nullable|max:255',
            'is_active' => 'boolean',
        ]);
        Page::create($validated);
        return redirect()->route('admin.pages.index')->with('success', 'Страница создана');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'slug' => 'required|max:100|unique:pages,slug,' . $page->page_id . ',page_id',
            'title' => 'required|max:255',
            'content' => 'required',
            'meta_description' => 'nullable|max:255',
            'is_active' => 'boolean',
        ]);
        $page->update($validated);
        return redirect()->route('admin.pages.index')->with('success', 'Страница обновлена');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Страница удалена');
    }
}