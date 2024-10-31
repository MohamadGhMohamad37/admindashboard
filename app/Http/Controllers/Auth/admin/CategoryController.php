<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required|string',
            'name_de' => 'nullable|string',
            'name_fr' => 'nullable|string',
            'name_ar' => 'nullable|string',
            'name_zh' => 'nullable|string',
            'name_tr' => 'nullable|string',
            'description_en' => 'required|string',
            'description_de' => 'required|string',
            'description_fr' => 'required|string',
            'description_ar' => 'required|string',
            'description_zh' => 'required|string',
            'description_tr' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['image'] = $request->file('image')->store('categories','public');
        if ($request->hasFile('images')) {
            $data['images'] = [];
            foreach ($request->file('images') as $image) {
                // Store each additional image
                $data['images'][] = $image->store('categories','public');
            }
        } else {
            $data['images'] = []; // No additional images
        }
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name_en' => 'required|string',
            'name_de' => 'nullable|string',
            'name_fr' => 'nullable|string',
            'name_ar' => 'nullable|string',
            'name_zh' => 'nullable|string',
            'name_tr' => 'nullable|string',
            'description_en' => 'required|string',
            'description_de' => 'nullable|string',
            'description_fr' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_zh' => 'nullable|string',
            'description_tr' => 'nullable|string',
            'image' => 'sometimes|image',
            'images.*' => 'image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories');
        }

        if ($request->hasFile('images')) {
            $data['images'] = array_map(fn($image) => $image->store('categories'), $request->file('images'));
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
    public function downloadPdf(Category $category)
    {
        $pdf = Pdf::loadView('admin.categories.pdf', compact('category'));
        return $pdf->download('category-' . $category->id . '.pdf');
    }
}
