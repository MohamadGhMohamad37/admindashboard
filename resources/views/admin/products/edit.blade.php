@extends('admin.layout.app')
@section('title','Create Sub Category')
@section('header')
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>

<link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css')}}" rel="stylesheet">
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js')}}"></script>


<style>
    .drop-area {
        border: 2px dashed #ccc;
        border-radius: 5px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        margin-top: 10px;
    }
    .drop-area.hover {
        border-color: #333;
    }
    .gallery-image {
        display: inline-block;
        margin: 5px;
        max-width: 100px;
        max-height: 100px;
    }
</style>
@endsection
@section('content')
<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Create Sub Category</h3>
                <h6 class="op-7 mb-2">Category/<a href="{{route('subcategories.index')}}">Sub Categories</a> /Add New</h6>
              </div>
            </div>
            <div class="container mt-5">
    <h1 class="mb-4">Create New Sub Category</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="categoryForm">
                @csrf
                @method('PUT')
        <!-- Category Names in Multiple Languages -->
        <div class="form-group">
            <label>Name (En)</label>
            <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}" class="form-control" >
        </div>
        <div class="form-group">
            <label>Name (De)</label>
            <input type="text" name="name_de" value="{{ old('name_en', $product->name_de) }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Name (Fr)</label>
            <input type="text" name="name_fr" value="{{ old('name_en', $product->name_fr) }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Name (Ar)</label>
            <input type="text" name="name_ar" value="{{ old('name_en', $product->name_ar) }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Name (Zh)</label>
            <input type="text" name="name_zh" value="{{ old('name_en', $product->name_zh) }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Name (Tr)</label>
            <input type="text" name="name_tr" value="{{ old('name_en', $product->name_tr) }}" class="form-control">
        </div>

        <!-- Descriptions in Multiple Languages -->
        <div class="form-group">
            <label>Description (En)</label>
            <textarea name="description_en" id="editor_en" rows="5" class="form-control" >{!! old('description_en', $product->description_en) !!}</textarea>
        </div>
        <div class="form-group">
            <label>Description (De)</label>
            <textarea name="description_de" id="editor_de" class="form-control" rows="3" >{!! old('description_en', $product->description_de) !!}</textarea>
        </div>
        <div class="form-group">
            <label>Description (Fr)</label>
            <textarea name="description_fr" id="editor_fr" class="form-control" rows="3" >{!! old('description_en', $product->description_fr) !!}</textarea>
        </div>
        <div class="form-group">
            <label>Description (Ar)</label>
            <textarea name="description_ar" id="editor_ar" class="form-control" rows="3" >{!! old('description_en', $product->description_ar) !!}</textarea>
        </div>
        <div class="form-group">
            <label>Description (Zh)</label>
            <textarea name="description_zh" id="editor_zh" class="form-control" rows="3" >{!! old('description_en', $product->description_zh) !!}</textarea>
        </div>
        <div class="form-group">
            <label>Description (Tr)</label>
            <textarea name="description_tr" id="editor_tr" class="form-control" rows="3" >{!! old('description_en', $product->description_tr) !!}</textarea>
        </div>
        <div class="form-group">
            <label for="subcategory">Select Sub Category</label>
            <select name="subcategories" id="subcategory" class="form-control">
                <option value="">Select Sub Category</option>
                @foreach($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}" {{ $subCategory->id == $product->subcategories ? 'selected' : '' }}>{{ $subCategory->name_en }}</option>

                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <div id="drop-area" class="drop-area">
                <p>Drag & Drop your image here or click to select</p>
                <input type="file" name="main_image" id="image" class="form-control"  style="display: none;">
                <img id="image-preview" src="{{ asset('storage/' .$product->main_image) }}" alt="Image Preview" style="margin-top: 10px; max-width: 100%;">
            </div>
        </div>

        <div class="form-group">
            <label for="gallery_images">Gallery Images</label>
            <div id="gallery-drop-area" class="drop-area">
                <p>Drag & Drop your gallery images here or click to select</p>
                <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" multiple style="display: none;">
                <div id="gallery-preview" style="margin-top: 10px;">
                                @php
                                    $images = json_decode($product->gallery_images, true); // فك ترميز JSON إلى مصفوفة
                                @endphp
                                    @foreach ($images as $image)
                                     <img src="{{ asset('storage/' .$image) }}" class="gallery-image" alt="Gallery Image">
                                     @endforeach
                        </div>
            </div>
        </div>

        <div class="form-group">
            <label for="pdf">File PDF</label>
            <div id="pdf-drop-area" class="drop-area">
                <p>Drag & Drop your File PDF here or click to select</p>
                <input type="file" name="pdf_file" id="pdf" class="form-control" accept="application/pdf"  style="display: none;">
                <iframe src="{{ asset('storage/' .$product->pdf_file) }}" id="pdf-preview" style=" margin-top: 10px; max-width: 100%;" frameborder="0"></iframe>
            </div>
        </div>
        <div class="form-group">
            <label for="video">Upload Video</label>
            <div id="video-drop-area" class="drop-area">
                <p>Drag & Drop your video here or click to select</p>
                <input type="file" name="video" id="video" class="form-control" accept="video/*"  style="display: none;">
                <video id="video-preview" src="{{ asset('storage/' .$product->video) }}" controls style=" margin-top: 10px; max-width: 100%;"></video>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Product</button>
    </form>
</div>

<script>
    // Handle PDF upload
    const pdfDropArea = document.getElementById('pdf-drop-area');
    const pdfFileInput = document.getElementById('pdf');
    const pdfPreview = document.getElementById('pdf-preview');

    // Prevent default drag behaviors for PDF area
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        pdfDropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight PDF drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        pdfDropArea.addEventListener(eventName, () => pdfDropArea.classList.add('hover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        pdfDropArea.addEventListener(eventName, () => pdfDropArea.classList.remove('hover'), false);
    });

    // Handle dropped PDF file
    pdfDropArea.addEventListener('drop', handlePdfDrop, false);
    pdfDropArea.addEventListener('click', () => pdfFileInput.click());

    function handlePdfDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handlePdfFiles(files);
    }

    pdfFileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            displayPdf(file);
        }
    });

    function handlePdfFiles(files) {
        if (files.length) {
            const file = files[0];
            pdfFileInput.files = files; // This line ensures the dropped file is set
            displayPdf(file);
        }
    }

    function displayPdf(file) {
        const fileURL = URL.createObjectURL(file);
        pdfPreview.src = fileURL;
        pdfPreview.style.display = 'block'; // Show the PDF preview
    }

  // Handle single image upload
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.add('hover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, () => dropArea.classList.remove('hover'), false);
    });

    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);
    dropArea.addEventListener('click', () => fileInput.click());

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length) {
            const file = files[0];
            // Update the file input with the dropped file
            fileInput.files = files; // This line ensures the dropped file is set
            displayImage(file);
        }
    }

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            displayImage(file);
        }
    });

    function displayImage(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block'; // Show the image
        }
        reader.readAsDataURL(file);
    }
// Handle gallery images upload
const galleryDropArea = document.getElementById('gallery-drop-area');
const galleryFileInput = document.getElementById('gallery_images');
const galleryPreview = document.getElementById('gallery-preview');

galleryDropArea.addEventListener('drop', handleGalleryDrop, false);
galleryDropArea.addEventListener('click', () => galleryFileInput.click());

function handleGalleryDrop(e) {
    preventDefaults(e); // Prevent default behavior
    const dt = e.dataTransfer;
    const files = dt.files;
    handleGalleryFiles(files);
}

galleryFileInput.addEventListener('change', (e) => {
    const files = e.target.files;
    if (files.length) {
        handleGalleryFiles(files);
    }
});

function handleGalleryFiles(files) {
    galleryPreview.innerHTML = ''; // Clear previous images
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('gallery-image');
            galleryPreview.appendChild(img);
        }
        reader.readAsDataURL(file);
    });

    // Update the file input with the dropped files
    galleryFileInput.files = files; // This line ensures the dropped files are set
}
// Handle video upload
const videoDropArea = document.getElementById('video-drop-area');
const videoFileInput = document.getElementById('video');
const videoPreview = document.getElementById('video-preview');

// Prevent default drag behaviors for video area
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    videoDropArea.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
});

// Highlight video drop area when item is dragged over it
['dragenter', 'dragover'].forEach(eventName => {
    videoDropArea.addEventListener(eventName, () => videoDropArea.classList.add('hover'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    videoDropArea.addEventListener(eventName, () => videoDropArea.classList.remove('hover'), false);
});

// Handle dropped video file
videoDropArea.addEventListener('drop', handleVideoDrop, false);
videoDropArea.addEventListener('click', () => videoFileInput.click());

function handleVideoDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    handleVideoFiles(files);
}

videoFileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (file) {
        displayVideo(file);
    }
});

function handleVideoFiles(files) {
    if (files.length) {
        const file = files[0];
        videoFileInput.files = files; // This line ensures the dropped file is set
        displayVideo(file);
    }
}

function displayVideo(file) {
    const fileURL = URL.createObjectURL(file);
    videoPreview.src = fileURL;
    videoPreview.style.display = 'block'; // Show the video
}

</script>
          </div>
        </div>

@endsection
@section('script')
<!-- Include CKEditor from CDN-->
<script src="{{url('https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js')}}"></script>
<script>
// Activate CKEditor on the specified field
//En
    ClassicEditor.create(document.querySelector('#editor_en'))
        .catch(error => {
            console.error(error);
        });
//Ar
ClassicEditor.create(document.querySelector('#editor_ar'))
        .catch(error => {
            console.error(error);
        });
//Zh
ClassicEditor.create(document.querySelector('#editor_zh'))
        .catch(error => {
            console.error(error);
        }); 
//Fr
ClassicEditor.create(document.querySelector('#editor_fr'))
        .catch(error => {
            console.error(error);
        });
//De
ClassicEditor.create(document.querySelector('#editor_de'))
        .catch(error => {
            console.error(error);
        });
//Tr
ClassicEditor.create(document.querySelector('#editor_tr'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    $(document).ready(function() {
        $('#subcategory').select2({
            placeholder: "Select Sub Category",
            allowClear: true
        });
    });
</script>
@endsection