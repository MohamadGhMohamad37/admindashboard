@extends('admin.layout.app')
@section('title','Admin')
@section('header')
@endsection
@section('content')
<!-- Modal -->
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
<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Admin</h3>
                <h6 class="op-7 mb-2">User/ Admin</h6>
              </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">View All Admin</h4>
                    <a href="{{ route('admin.createadmin') }}" class="btn btn-primary">
                        <span class="btn-label">
                          <i class="fa fa-plus"></i>
                        </span>
                        Add New
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="multi-filter-select"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>birth date</th>
                            <th>job</th>
                            <th>country</th>
                            <th>state</th>
                            <th>city</th>
                            <th>address1</th>
                            <th>address2</th>
                            <th>zip code</th>
                            <th>phone number</th>
                            <th>email verified</th>
                            <th>profile image</th>
                            <th>created at</th>
                            <th>updated at</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>birth date</th>
                            <th>job</th>
                            <th>country</th>
                            <th>state</th>
                            <th>city</th>
                            <th>address1</th>
                            <th>address2</th>
                            <th>zip code</th>
                            <th>phone number</th>
                            <th>email verified</th>
                            <th>profile image</th>
                            <th>created at</th>
                            <th>updated at</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->first_name }}</td>
                                <td>{{ $admin->last_name }}</td>
                                <td>{{ $admin->username  }}</td>
                                <td>{{ $admin->email  }}</td>
                                <td>{{ $admin->birth_date }}</td>
                                <td>{{ $admin->job }}</td>
                                <td>{{ $admin->country }}</td>
                                <td>{{ $admin->state }}</td>
                                <td>{{ $admin->city }}</td>
                                <td>{{ $admin->address1 }}</td>
                                <td>{{ $admin->address2 }}</td>
                                <td>{{ $admin->zip_code }}</td>
                                <td>{{ $admin->phone_number }}</td>
                                <td>
                                    @if($admin->email_verified === 0)
                                    The Email Not Verifed
                                    @else
                                    The Email Verifed
                                    @endif
                                </td>
                                <td>
                        <div class="user-box">
                          <div class="avatar-lg">
                            @if($admin->profile_image)
                                <img src="{{ asset('storage/' . $admin->profile_image) }}" class="avatar-img rounded" alt="">
                            @else
                                <img src="{{ asset('assets/img/user.jpg') }}" class="avatar-img rounded" alt="">
                            @endif
                            </div>
                        </div>

                                </td>
                                <td>{{ $admin->created_at }}</td>
                                <td>{{ $admin->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
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
    <script>
    var SweetAlert2Demo = (function () {
        //== Demos
        var initDemos = function () {
            $("button[id^='alert_demo_']").click(function (e) {
                e.preventDefault(); // Prevent default button behavior
                var formId = $(this).attr('id').replace('alert_demo_', 'delete-form-'); // Get form ID
                
                swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            visible: true,
                            text: "No, cancel!",
                            className: "btn btn-danger",
                        },
                        confirm: {
                            text: "Yes, delete it!",
                            className: "btn btn-success",
                        },
                    },
                }).then((willDelete) => {
                    if (willDelete) {
                        // If confirmed, submit the form
                        $("#" + formId).submit();
                    } else {
                        swal("Your imaginary file is safe!", {
                            buttons: {
                                confirm: {
                                    className: "btn btn-success",
                                },
                            },
                        });
                    }
                });
            });
        };

        return {
            //== Init
            init: function () {
                initDemos();
            },
        };
    })();

    // Initialize the SweetAlert demo
    $(document).ready(function() {
        SweetAlert2Demo.init();
    });
</script>

    <script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    select.append(
                      '<option value="' + d + '">' + d + "</option>"
                    );
                  });
              });
          },
        });

        // Add Row
        $("#add-row").DataTable({
          pageLength: 5,
        });

        var action =
          '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function () {
          $("#add-row")
            .dataTable()
            .fnAddData([
              $("#addName").val(),
              $("#addPosition").val(),
              $("#addOffice").val(),
              action,
            ]);
          $("#addRowModal").modal("hide");
        });
      });
    </script>
    <script>
  $(document).ready(function () {
    // When clicking on an image
    $('tbody img').click(function() {
      var imageSrc = $(this).attr('src'); // Get image source
      $('#modalImage').attr('src', imageSrc); // Set the source for the image in the popup window
      $('#imageModal').modal('show'); // Display the popup window
    });
  });
</script>
        @endsection