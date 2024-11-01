@extends('admin.layout.app')
@section('title', 'Sub Category Details')
@section('header')
@endsection
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Sub Category Details</h3>
                <h6 class="op-7 mb-2">{{ $subcategory->name_en }}</h6>
            </div>
            <div class="ml-auto">
                <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Back to Sub Categories</a>
                <a href="{{ route('subcategories.edit', $subcategory) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sub Category Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Name (En):</h5>
                        <p>{{ $subcategory->name_en }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Name (De):</h5>
                        <p>{{ $subcategory->name_de }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Name (Fr):</h5>
                        <p>{{ $subcategory->name_fr }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Name (Ar):</h5>
                        <p>{{ $subcategory->name_ar }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Description (En):</h5>
                        <p>{!! $subcategory->description_en !!}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Description (De):</h5>
                        <p>{!! $subcategory->description_de !!}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Description (Fr):</h5>
                        <p>{!! $subcategory->description_fr !!}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Description (Ar):</h5>
                        <p>{!! $subcategory->description_ar !!}</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5>Main Image:</h5>
                        <img src="{{ asset('storage/' . $subcategory->image) }}" alt="Main Image" width="300" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal">
                    </div>
                    <div class="col-md-6">
                        <h5>Additional Images:</h5>
                        
                        @if($subcategory->images)
                            @php
                                $images = json_decode($subcategory->images, true); // فك ترميز JSON إلى مصفوفة
                             @endphp
                                @foreach ($images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Additional Image" width="50" style="cursor: pointer;">
                                @endforeach
                        @else
                                No additional images
                        @endif
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                                    @if($subcategory->pdf_file)
                                    <iframe src="{{ asset('storage/' . $subcategory->pdf_file) }}" width="100%" height="100%" frameborder="0"></iframe>
                                    @else
                                    No File PDF
                                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Preview -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Image" style="width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

<script>
$(document).ready(function () {
    // When clicking on an image
    $('img[data-bs-toggle="modal"]').click(function() {
        var imageSrc = $(this).attr('src'); // Get image source
        $('#modalImage').attr('src', imageSrc); // Set the source for the image in the popup window
        $('#imageModal').modal('show'); // Display the popup window
    });
});
</script>
@endsection
