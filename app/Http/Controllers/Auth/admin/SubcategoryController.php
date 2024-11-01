<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\MOdels\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    // Show all subcategories
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    // Display the subcategory creation page
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create',compact('categories'));
    }

    //Storage subcategory
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_de' => 'required|string|max:255',
            'name_tr' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_fr' => 'required|string|max:255',
            'name_zh' => 'required|string|max:255',
            'description_en' => 'required|string|max:1000',
            'description_de' => 'required|string|max:1000',
            'description_tr' => 'required|string|max:1000',
            'description_ar' => 'required|string|max:1000',
            'description_fr' => 'required|string|max:1000',
            'description_zh' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:10240', 
            'category_id' => 'required|exists:categories,id'
        
        ]);

        // Save main image
        $imagePath = $request->file('image') ? $request->file('image')->store('subcategories','public') : null;
        $imagesPath = $request->file('images') ? json_encode(array_map(function ($image) {
            return $image->store('subcategories','public');
        }, $request->file('images'))) : null;
        $pdfPath = $request->file('pdf') ? $request->file('pdf')->store('subcategories','public') : null;

        Subcategory::create(array_merge($request->all(), [
            'image' => $imagePath,
            'images' => $imagesPath,
            'pdf_file' => $pdfPath,
        ]));

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    // Show subcategory
    public function show(Subcategory $subcategory)
    {
        return view('admin.subcategories.show', compact('subcategory'));
    }

   // Display subcategory edit page
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory','categories'));
    }

    // Update subcategory
    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_de' => 'required|string|max:255',
            'name_tr' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_fr' => 'required|string|max:255',
            'name_zh' => 'required|string|max:255',
            'description_en' => 'required|string|max:1000',
            'description_de' => 'required|string|max:1000',
            'description_tr' => 'required|string|max:1000',
            'description_ar' => 'required|string|max:1000',
            'description_fr' => 'required|string|max:1000',
            'description_zh' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:10240', 
            'category_id' => 'required|exists:categories,id'
        ]);

        // Save main image
        if ($request->file('image')) {
            // Delete old image if it exists
            if ($subcategory->image) {
                Storage::delete($subcategory->image);
            }
            $subcategory->image = $request->file('image')->store('subcategories','public');
        }

       // Save the image set
        if ($request->file('images')) {
            $imagesPath = json_decode($subcategory->images, true);
            if ($imagesPath) {
                foreach ($imagesPath as $imagePath) {
                    Storage::delete($imagePath);
                }
            }
            $subcategory->images = json_encode(array_map(function ($image) {
                return $image->store('subcategories','public');
            }, $request->file('images')));
        }

       // Save PDF file
        if ($request->file('pdf')) {
            if ($subcategory->pdf_file) {
                Storage::delete($subcategory->pdf_file);
            }
            $subcategory->pdf_file = $request->file('pdf')->store('subcategories','public');
        }

        $subcategory->fill($request->except('image', 'images', 'pdf'));
        $subcategory->save();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    // Delete subcategory
    public function destroy(Subcategory $subcategory)
    {
        // Delete images
        if ($subcategory->image) {
            Storage::delete($subcategory->image);
        }
        if ($subcategory->images) {
            $imagesPath = json_decode($subcategory->images, true);
            foreach ($imagesPath as $imagePath) {
                Storage::delete($imagePath);
            }
        }
        if ($subcategory->pdf_file) {
            Storage::delete($subcategory->pdf_file);
        }

        $subcategory->delete();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }

    // Downolad PDF
    public function downloadPdf(Subcategory $subcategory)
    {
        $pdf = PDF::loadView('admin.subcategories.pdf', compact('subcategory'));
        return $pdf->download('subcategory-' . $subcategory->id . '.pdf');
    }
}
