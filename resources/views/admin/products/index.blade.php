@extends('admin.layout.app')
@section('title','Categories')
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
                <h3 class="fw-bold mb-3">Products</h3>
                <h6 class="op-7 mb-2">Category/ Products</h6>
              </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">View All Products</h4>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
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
                            <th>Nama (En)</th>
                            <th>Name (De)</th>
                            <th>Name (Fr)</th>
                            <th>Name (Tr)</th>
                            <th>Name (Ar)</th>
                            <th>Name (Zh)</th>
                            <th>Disc (En)</th>
                            <th>Disc (De)</th>
                            <th>Disc (Fr)</th>
                            <th>Disc (Tr)</th>
                            <th>Disc (Ar)</th>
                            <th>Disc (Zh)</th>
                            <th>Photo</th>
                            <th>Photo Gallery</th>
                            <th>PDF File</th>
                            <th>video</th>
                            <th>Sub Category</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Nama (En)</th>
                            <th>Name (De)</th>
                            <th>Name (Fr)</th>
                            <th>Name (Tr)</th>
                            <th>Name (Ar)</th>
                            <th>Name (Zh)</th>
                            <th>Disc (En)</th>
                            <th>Disc (De)</th>
                            <th>Disc (Fr)</th>
                            <th>Disc (Tr)</th>
                            <th>Disc (Ar)</th>
                            <th>Disc (Zh)</th>
                            <th>Photo</th>
                            <th>Photo Gallery</th>
                            <th>PDF File</th>
                            <th>video</th>
                            <th>Sub Category</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name_en }}</td>
                                <td>{{ $product->name_de }}</td>
                                <td>{{ $product->name_fr }}</td>
                                <td>{{ $product->name_ar }}</td>
                                <td>{{ $product->name_zh }}</td>
                                <td>{{ $product->name_tr }}</td>
                                <td>{!! $product->description_en !!}</td>
                                <td>{!! $product->description_de !!}</td>
                                <td>{!! $product->description_fr !!}</td>
                                <td>{!! $product->description_ar !!}</td>
                                <td>{!! $product->description_zh !!}</td>
                                <td>{!! $product->description_tr !!}</td>
                                <td>
                                <img src="{{ asset('storage/' . $product->main_image) }}" alt="Main Image" width="100" style="cursor: pointer;">
                                </td>
                                <td>
                                @if($product->gallery_images)
                                @php
                                    $images = json_decode($product->gallery_images, true); // فك ترميز JSON إلى مصفوفة
                                @endphp
                                    @foreach ($images as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="Additional Image" width="50" style="cursor: pointer;">
                                    @endforeach
                                @else
                                    No additional images
                                @endif
                                </td>
                                <td>
                                    @if($product->pdf_file)
                                    <iframe src="{{ asset('storage/' . $product->pdf_file) }}" width="300px" frameborder="0"></iframe>
                                    @else
                                    No File PDF
                                    @endif
                                </td>
                                <td>
                                    @if($product->video)
                                    <video src="{{ asset('storage/' . $product->video) }}" width="300px" controls></video>                                    
                                    @else
                                    No File PDF
                                    @endif
                                </td>
                                <td>
                                <a href="{{ route('subcategories.show', $product->subCategory) }}">
                                        {{ $product->subCategory->name_en ?? 'No Result' }}
                                </a> 
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-icon btn-round btn-info">
                                      <i class="fa fa-info"></i>
                                    </a> |
                                    <a href="{{ route('products.edit', $product) }}"  class="btn btn-icon btn-round btn-warning">
                                        <i class="icon-note"></i>
                                    </a> |
                                    <a href="{{ route('products.downloadPdf', $product) }}"  class="btn btn-icon btn-round btn-secondary">
                                        <i class="fas fa-file-pdf"></i>
                                    </a> |
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" id="alert_demo_{{ $product->id }}" class="btn btn-icon btn-round btn-danger">
                                            <i class="fas fa-backspace"></i>
                                        </button>
                                    </form>
                                </td>
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