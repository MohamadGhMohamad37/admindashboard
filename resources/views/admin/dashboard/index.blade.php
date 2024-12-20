@extends('admin.layout.app')
@section('title','Mohamad Ghazi Mohamad Admin Dashboard')
@section('header')
@endsection
@section('content')

<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Admin Dashboard Create By Mohamad Ghazi Mohamad</h6>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="icon-people text-warning"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Number of visitors</p>
                          <h4 class="card-title">{{ $visitorCount }}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="icon-wallet text-success"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Available amounts</p>
                          <h4 class="card-title">
                          @if($available)
                                  @foreach($available as $item)
                                      <p>{{ $item['amount'] }} {{ $item['currency'] }}</p>
                                  @endforeach
                          @else
                              <p>There is no available balance at this time..</p>
                          @endif
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="icon-close text-danger"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Outstanding amounts</p>
                          <h4 class="card-title">
                          @if($pending)
                                  @foreach($pending as $item)
                                      <p>{{ $item['amount'] }} {{ $item['currency'] }}</p>
                                  @endforeach
                          @else
                              <p>There is no pending balance currently..</p>
                          @endif
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="icon-social-dropbox text-primary"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Number of products</p>
                          <h4 class="card-title">{{$productCount}}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">View All Visitors</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="multi-filter-select"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>ip address</th>
                            <th>user agent</th>
                            <th>Country</th>
                            <th>created at</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>ip address</th>
                            <th>user agent</th>
                            <th>Country</th>
                            <th>created at</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($visitors as $visitor)
                            <tr>
                                <td>{{ $visitor->ip_address }}</td>
                                <td>{{ $visitor->user_agent }}</td>
                                <td>
                                  @if($visitor->country)
                                  {{ $visitor->country }}
                                  @else
                                  No Result
                                  @endif
                                </td>
                                <td>{{ $visitor->created_at }}</td>
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