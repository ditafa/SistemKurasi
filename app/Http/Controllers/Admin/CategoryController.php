<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('admin.kategori.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.kategori.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_name' => 'nullable|string|max:255',
        ]);

        $parentCategory = $this->findOrCreateParent($validated['parent_name'] ?? null);

        Category::create([
            'name' => $validated['name'],
            'parent_id' => $parentCategory?->id,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Category $kategori)
    {
        $categories = Category::where('id', '!=', $kategori->id)->get();
        return view('admin.kategori.edit', compact('kategori', 'categories'));
    }

    public function update(Request $request, Category $kategori)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_name' => 'nullable|string|max:255',
        ]);

        $parentCategory = $this->findOrCreateParent($validated['parent_name'] ?? null);

        $kategori->update([
            'name' => $validated['name'],
            'parent_id' => $parentCategory?->id,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus');
    }

    /**
     * Temukan atau buat kategori induk berdasarkan nama.
     */
    private function findOrCreateParent(?string $name): ?Category
    {
        if (!$name) {
            return null;
        }

        return Category::firstOrCreate(
            ['name' => $name],
            ['parent_id' => null]
        );
    }
}
