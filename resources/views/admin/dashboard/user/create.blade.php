@extends('admin.layout.app')
@section('title','Create User')
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
                <h3 class="fw-bold mb-3">Create User</h3>
                <h6 class="op-7 mb-2">User/<a href="{{route('admin.users')}}">User</a> /Add New</h6>
              </div>
            </div>
            <div class="container mt-5">
    <h1 class="mb-4">Create New User</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.storeuser') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
        @csrf

        <!-- Product Names in Multiple Languages -->
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" >
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control">
        </div>
        <div class="form-group">
            <label>User Name</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label>Re Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="number" name="phone_number" class="form-control">
        </div>
        <div class="form-group">
            <label>Date Birthday</label>
            <input type="date" name="birth_date" class="form-control">
        </div>
        <div class="form-group">
            <label>Job</label>
            <input type="text" name="job" class="form-control">
        </div>
        <div class="form-group">
            <label>Country</label>
            <input type="text" name="country" class="form-control">
        </div>
        <div class="form-group">
            <label>State</label>
            <input type="text" name="state" class="form-control">
        </div>
        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control">
        </div>
        <div class="form-group">
            <label>Address1</label>
            <input type="text" name="address1" class="form-control">
        </div>
        <div class="form-group">
            <label>Address2</label>
            <input type="text" name="address2" class="form-control">
        </div>
        <div class="form-group">
            <label>Zip code</label>
            <input type="text" name="zip_code" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" name="role" hidden value="user" class="form-control">
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <div id="drop-area" class="drop-area">
                <p>Drag & Drop your image here or click to select</p>
                <input type="file" name="profile_image" id="image" class="form-control" style="display: none;">
                <img id="image-preview" src="#" alt="Image Preview" style="display: none; margin-top: 10px; max-width: 100%;">
            </div>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Save Admin</button>
    </form>
</div>

<script>
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
</script>
          </div>
        </div>

@endsection
@section('script')
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
    <!-- Sweet Alert -->
    <script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{asset('assets/js/setting-demo2.js')}}"></script>
@endsection
