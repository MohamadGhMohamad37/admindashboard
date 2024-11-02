@extends('admin.layout.app')
@section('title', 'Admin Details')
@section('header')
@endsection
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Admin Details</h3>
                <h6 class="op-7 mb-2">{{ $user->name }}</h6>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.admins') }}" class="btn btn-secondary">Back to Admins</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Admin Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>first name:</h5>
                        <p>{{ $user->first_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>last name:</h5>
                        <p>{{ $user->last_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>username:</h5>
                        <p>{{ $user->username }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Email:</h5>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Mobile Number:</h5>
                        <p>{{ $user->phone_number }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Role:</h5>
                        <p>{{ ucfirst($user->role) }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>country:</h5>
                        <p>{{ $user->country ?? 'No country Provided' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>state:</h5>
                        <p>{{ $user->state ?? 'No state Provided' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>city:</h5>
                        <p>{{ $user->city ?? 'No city Provided' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Address1:</h5>
                        <p>{{ $user->address1 ?? 'No Address1 Provided' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Address2:</h5>
                        <p>{{ $user->address2 ?? 'No Address2 Provided' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Verifed Email:</h5>
                        <p>
                                    @if($user->email_verified === 0)
                                    The Email Not Verifed
                                    @else
                                    The Email Verifed
                                    @endif                            
                        </p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5>Profile Image:</h5>
                        
                        @if($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" style="cursor: pointer; width:100%;" data-bs-toggle="modal" data-bs-target="#imageModal">
                            @else
                                <img src="{{ asset('assets/img/user.jpg') }}" style="cursor: pointer; width:100%;" data-bs-toggle="modal" data-bs-target="#imageModal">
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
