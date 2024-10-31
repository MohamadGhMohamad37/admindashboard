@extends('admin.layout.app')
@section('title','Create Category')
@section('header')
<link href="{{url('https://unpkg.com/filepond/dist/filepond.css')}}" rel="stylesheet">
<script src="{{url('https://unpkg.com/filepond/dist/filepond.js')}}"></script>
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
            <label>Main Image</label>
            <div id="dropzone" style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
                <p>Drag image here or click to select image</p>
                <input type="file" id="fileInput" name="image" style="display: none;">
                <img id="preview" src="#" alt="Preview" style="display: none; max-width: 100%; margin-top: 10px;">
            </div>
        </div>
                <!-- Progress bar -->
                <div id="progressContainer" style="display: none; margin-top: 10px;">
            <div style="border: 1px solid #ccc; width: 100%; height: 20px; background-color: #f3f3f3;">
                <div id="progressBar" style="height: 100%; width: 0%; background-color: green;"></div>
            </div>
            <span id="progressPercentage" style="display: none;">0%</span>
        </div>
        <div id="imageDetails" style="margin-top: 10px; display: none;">
            <h5>Image details:</h5>
            <p><strong>the name:</strong> <span id="imageName"></span></p>
            <p><strong>Size:</strong> <span id="imageSize"></span></p>
            <p><strong>Type:</strong> <span id="imageType"></span></p>
        </div>
        <!-- Multiple Image Upload with FilePond -->
        <div class="form-group">
            <label>Additional Images</label>
            <input type="file" name="images[]" id="imageUpload" class="filepond" accept="image/*" multiple>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Category</button>
    </form>
</div>

<script>
      const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');
    const imageDetails = document.getElementById('imageDetails');
    const imageName = document.getElementById('imageName');
    const imageSize = document.getElementById('imageSize');
    const imageType = document.getElementById('imageType');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');
    const progressPercentage = document.getElementById('progressPercentage');

    dropzone.addEventListener('dragover', (event) => {
        event.preventDefault(); // To prevent default behavior
        dropzone.style.borderColor = 'green';// Change border color when dragging
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.style.borderColor = '#ccc'; // Restore default color when leaving
    });

    dropzone.addEventListener('drop', (event) => {
        event.preventDefault(); // To prevent default behavior
        dropzone.style.borderColor = '#ccc'; // Restore default color
        const files = event.dataTransfer.files; // Get the files you have pulled

        if (files.length > 0) {
            fileInput.files = files; // Set input files
            displayImage(files[0]); // Display image
            uploadFile(files[0]); // Start uploading the file
        }
    });

    dropzone.addEventListener('click', () => {
        fileInput.click(); // Open file selection dialog when clicking on the area
    });

    fileInput.addEventListener('change', (event) => {
        const files = event.target.files; // Get selected files

        if (files.length > 0) {
            displayImage(files[0]); // Display image
            uploadFile(files[0]); // Start uploading the file
        }
    });

    function displayImage(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result; // Set the image source to display
            preview.style.display = 'block'; // Display image

            // عرض تفاصيل الصورة
            imageName.textContent = file.name; // Image name
            imageSize.textContent = (file.size / 1024).toFixed(2) + ' KB'; // Size (in KB)
            imageType.textContent = file.type; // Image type
            imageDetails.style.display = 'block';// Show image details
        }
        reader.readAsDataURL(file); // Read file as Data URL
    }

    function uploadFile(file) {
        const xhr = new XMLHttpRequest();
        const formData = new FormData();
        formData.append('image', file); // Add the file to FormData

    // Update progress bar
        xhr.upload.addEventListener('progress', (event) => {
            if (event.lengthComputable) {
                const percentComplete = (event.loaded / event.total) * 100;
                progressBar.style.width = percentComplete + '%'; // Set the width of the progress bar
                progressPercentage.textContent = Math.round(percentComplete) + '%'; // Display percentage
                progressPercentage.style.display = 'block'; // Display percentage
                progressContainer.style.display = 'block'; // Display progress bar container
            }
        });

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
