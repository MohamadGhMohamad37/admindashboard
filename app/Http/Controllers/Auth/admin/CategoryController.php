<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.category.show', compact('category'));
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
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
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
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Find the category to update
    $category = Category::findOrFail($id);

    // Update category fields
    $category->name_en = $request->name_en;
    $category->name_de = $request->name_de;
    $category->name_fr = $request->name_fr;
    $category->name_tr = $request->name_tr;
    $category->name_ar = $request->name_ar;
    $category->name_zh = $request->name_zh;
    $category->description_en = $request->description_en;
    $category->description_de = $request->description_de;
    $category->description_fr = $request->description_fr;
    $category->description_tr = $request->description_tr;
    $category->description_ar = $request->description_ar;
    $category->description_zh = $request->description_zh;

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($category->image) {
            Storage::delete($category->image);
        }
        $category->image = $request->file('image')->store('categories','public');
    }

    // Handle gallery images
    if ($request->hasFile('images')) {
        // Delete old gallery images if needed
        foreach ($category->images as $image) {
            Storage::delete($image);
        }
        $images = [];
        foreach ($request->file('images') as $file) {
            $images[] = $file->store('categories/gallery','public');
        }
        $category->images = $images; // Update the gallery
    }

    // Save the updated category
    $category->save();

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
        $pdf = Pdf::loadView('admin.category.pdf', compact('category'));
        return $pdf->download('category-' . $category->id . '.pdf');
    }
}
