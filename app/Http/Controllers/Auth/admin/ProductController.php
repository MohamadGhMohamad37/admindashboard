<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\MOdels\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('subCategory')->get();
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $subCategories = SubCategory::all();
        return view('admin.products.create', compact('subCategories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_de' => 'required|string|max:255',
            'name_tr' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_fr' => 'required|string|max:255',
            'name_zh' => 'required|string|max:255',
            'price' => [
                'required',
                'numeric',
                'min:0',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'description_en' => 'required|string|max:1000',
            'description_de' => 'required|string|max:1000',
            'description_tr' => 'required|string|max:1000',
            'description_ar' => 'required|string|max:1000',
            'description_fr' => 'required|string|max:1000',
            'description_zh' => 'required|string|max:1000',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'mimes:mp4,avi,mov|max:10240',
            'pdf_file' => 'mimes:pdf|max:5120',
            'subcategories' => 'required|exists:subcategories,id',
        ]);

        $data = $request->all();
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('products', 'public');
            }
            $data['gallery_images'] = json_encode($galleryImages);
        }

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('videos', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    public function edit(Product $product)
    {
        $subCategories = SubCategory::all();
        return view('admin.products.edit', compact('product', 'subCategories'));
    }

    public function update(Request $request, Product $product)
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
            'price' => [
                'required',
                'numeric',
                'min:0',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'mimes:mp4,avi,mov|max:10240',
            'pdf_file' => 'mimes:pdf|max:5120',
            'subcategories' => 'required|exists:subcategories,id',
        ]);

        $data = $request->all();
    if ($request->hasFile('main_image')) {
        if ($product->main_image) {
            Storage::delete($product->main_image);
        }
        $data['main_image'] = $request->file('main_image')->store('products', 'public');
    }

    if ($request->hasFile('gallery_images')) {
        if ($product->gallery_images) {
            $oldGalleryImages = json_decode($product->gallery_images, true);
            foreach ($oldGalleryImages as $oldImage) {
                Storage::delete($product->oldImage);
            }
        }

        $galleryImages = [];
        foreach ($request->file('gallery_images') as $image) {
            $galleryImages[] = $image->store('products', 'public');
        }
        $data['gallery_images'] = json_encode($galleryImages);
    }

   
    if ($request->hasFile('video')) {
        if ($product->video) {
            Storage::delete($product->video);
        }
        $data['video'] = $request->file('video')->store('videos', 'public');
    }

    
    if ($request->hasFile('pdf_file')) {
        if ($product->pdf_file) {
            Storage::delete($product->pdf_file);
        }
        $data['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
    }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    public function show(Product $product)
    {
        $products = Product::with('subCategory')->get();
        return view('admin.products.show', compact('product'));
    }
    public function destroy(Product $product)
    {
        if ($product->main_image) {
            Storage::delete($product->main_image);
        }
        if ($product->gallery_images) {
            $oldGalleryImages = json_decode($product->gallery_images, true);
            foreach ($oldGalleryImages as $oldImage) {
                Storage::delete($product->oldImage);
            }
        }
        if ($product->video) {
            Storage::delete($product->video);
        }
        if ($product->pdf_file) {
            Storage::delete($product->pdf_file);
        }
        $product->delete();
    
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function downloadPdf(Product $product)
    {
        $pdf = PDF::loadView('admin.products.pdf', compact('product'));
        return $pdf->download('product-' . $product->id . '.pdf');
    }
}
