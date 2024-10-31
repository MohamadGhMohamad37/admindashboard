@extends('admin.layout.app')
@section('title','Create Category')
@section('header')
<link href="{{url('https://unpkg.com/filepond/dist/filepond.css')}}" rel="stylesheet">
<script src="{{url('https://unpkg.com/filepond/dist/filepond.js')}}"></script>

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
                <h3 class="fw-bold mb-3">Create Category</h3>
                <h6 class="op-7 mb-2">Category/<a href="{{route('categories.index')}}">Categories</a> /Add New</h6>
              </div>
            </div>
            <div class="container mt-5">
    <h1 class="mb-4">Create New Category</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
        @csrf

        <!-- Category Names in Multiple Languages -->
        <div class="form-group">
            <label>Name (En)</label>
            <input type="text" name="name_en" class="form-control" >
        </div>
        <div class="form-group">
            <label>Name (De)</label>
            <input type="text" name="name_de" class="form-control">
        </div>
        <div class="form-group">
            <label>Name (Fr)</label>
            <input type="text" name="name_fr" class="form-control">
        </div>
        <div class="form-group">
            <label>Name (Ar)</label>
            <input type="text" name="name_ar" class="form-control">
        </div>
        <div class="form-group">
            <label>Name (Zh)</label>
            <input type="text" name="name_zh" class="form-control">
        </div>
        <div class="form-group">
            <label>Name (Tr)</label>
            <input type="text" name="name_tr" class="form-control">
        </div>

        <!-- Descriptions in Multiple Languages -->
        <div class="form-group">
            <label>Description (En)</label>
            <textarea name="description_en" id="editor_en" rows="5" class="form-control" ></textarea>
        </div>
        <div class="form-group">
            <label>Description (De)</label>
            <textarea name="description_de" id="editor_de" class="form-control" rows="3" ></textarea>
        </div>
        <div class="form-group">
            <label>Description (Fr)</label>
            <textarea name="description_fr" id="editor_fr" class="form-control" rows="3" ></textarea>
        </div>
        <div class="form-group">
            <label>Description (Ar)</label>
            <textarea name="description_ar" id="editor_ar" class="form-control" rows="3" ></textarea>
        </div>
        <div class="form-group">
            <label>Description (Zh)</label>
            <textarea name="description_zh" id="editor_zh" class="form-control" rows="3" ></textarea>
        </div>
        <div class="form-group">
            <label>Description (Tr)</label>
            <textarea name="description_tr" id="editor_tr" class="form-control" rows="3" ></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <div id="drop-area" class="drop-area">
                <p>Drag & Drop your image here or click to select</p>
                <input type="file" name="image" id="image" class="form-control" required style="display: none;">
                <img id="image-preview" src="#" alt="Image Preview" style="display: none; margin-top: 10px; max-width: 100%;">
            </div>
        </div>

        <div class="form-group">
            <label for="gallery_images">Gallery Images</label>
            <div id="gallery-drop-area" class="drop-area">
                <p>Drag & Drop your gallery images here or click to select</p>
                <input type="file" name="images[]" id="gallery_images" class="form-control" multiple style="display: none;">
                <div id="gallery-preview" style="margin-top: 10px;"></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Category</button>
    </form>
</div>

<script>  // Handle single image upload
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
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js')}}"></script>
@endsection
