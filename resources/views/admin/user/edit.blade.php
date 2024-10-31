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
                <h3 class="fw-bold mb-3">Edit Info Account</h3>
              </div>
            </div>
            <div class="container mt-5">
    <h2>Edit Account</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('user.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="First Name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Last Name" required>
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" value="{{ old('username', $user->username) }}" name="username" placeholder="Username" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" value="{{ old('email', $user->email) }}" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
        </div>

        <div class="form-group">
            <label for="password_confirmation">Re Password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re Password">
        </div>

        <div class="form-group">
            <label for="birth_date">Date Birthday:</label>
            <input type="date" class="form-control" id="birth_date" value="{{ old('birth_date', $user->birth_date) }}" name="birth_date">
        </div>

        <div class="form-group">
            <label for="job">Job:</label>
            <input type="text" class="form-control" id="job" name="job" value="{{ old('job', $user->job) }}" placeholder="job">
        </div>

        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $user->country) }}" placeholder="Country" required>
        </div>

        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $user->state) }}" placeholder="State" required>
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $user->city) }}" placeholder="City" required>
        </div>

        <div class="form-group">
            <label for="address1">Address 1:</label>
            <input type="text" class="form-control" id="address1" name="address1" value="{{ old('address1', $user->address1) }}" placeholder="Address 1" required>
        </div>

        <div class="form-group">
            <label for="address2">Address 2:</label>
            <input type="text" class="form-control" id="address2" value="{{ old('address2', $user->address2) }}" name="address2" placeholder="Address 2">
        </div>

        <div class="form-group">
            <label for="zip_code">Zip Code:</label>
            <input type="text" class="form-control" id="zip_code" value="{{ old('zip_code', $user->zip_code) }}" name="zip_code" placeholder="Zip Code" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone:</label>
            <input type="text" class="form-control" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" name="phone_number" placeholder="Phone" required>
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
          </div>
        </div>
        @endsection
        @section('script')
        
 <!--   Core JS Files   -->
 <script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
    <!-- Sweet Alert -->
    <script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
    <!-- jQuery Scrollbar -->
    <script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{asset('assets/js/setting-demo2.js')}}"></script>
<script>
    
      //== Class definition
      var SweetAlert2Demo = (function () {
        //== Demos
        var initDemos = function () {
          //== Sweetalert Demo 1
          $("#alert_demo_1").click(function (e) {
            swal("Good job!", {
              buttons: {
                confirm: {
                  className: "btn btn-success",
                },
              },
            });
          });

          //== Sweetalert Demo 2
          $("#alert_demo_2").click(function (e) {
            swal("Here's the title!", "...and here's the text!", {
              buttons: {
                confirm: {
                  className: "btn btn-success",
                },
              },
            });
          });

          //== Sweetalert Demo 3
          $("#alert_demo_3_1").click(function (e) {
            swal("Good job!", "You clicked the button!", {
              icon: "warning",
              buttons: {
                confirm: {
                  className: "btn btn-warning",
                },
              },
            });
          });

          $("#alert_demo_3_2").click(function (e) {
            swal("Good job!", "You clicked the button!", {
              icon: "error",
              buttons: {
                confirm: {
                  className: "btn btn-danger",
                },
              },
            });
          });

          $("#alert_demo_3_3").click(function (e) {
            swal("Good job!", "You clicked the button!", {
              icon: "success",
              buttons: {
                confirm: {
                  className: "btn btn-success",
                },
              },
            });
          });

          $("#alert_demo_3_4").click(function (e) {
            swal("Good job!", "You clicked the button!", {
              icon: "info",
              buttons: {
                confirm: {
                  className: "btn btn-info",
                },
              },
            });
          });

          //== Sweetalert Demo 4
          $("#alert_demo_4").click(function (e) {
            swal({
              title: "Good job!",
              text: "You clicked the button!",
              icon: "success",
              buttons: {
                confirm: {
                  text: "Confirm Me",
                  value: true,
                  visible: true,
                  className: "btn btn-success",
                  closeModal: true,
                },
              },
            });
          });

          $("#alert_demo_5").click(function (e) {
            swal({
              title: "Input Something",
              html: '<br><input class="form-control" placeholder="Input Something" id="input-field">',
              content: {
                element: "input",
                attributes: {
                  placeholder: "Input Something",
                  type: "text",
                  id: "input-field",
                  className: "form-control",
                },
              },
              buttons: {
                cancel: {
                  visible: true,
                  className: "btn btn-danger",
                },
                confirm: {
                  className: "btn btn-success",
                },
              },
            }).then(function () {
              swal("", "You entered : " + $("#input-field").val(), "success");
            });
          });

          $("#alert_demo_6").click(function (e) {
            swal("Wait while we process your request.", {
              buttons: false,
              timer: 10000,
            });
          });

          $("#alert_demo_7").click(function (e) {
            swal({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              type: "warning",
              buttons: {
                confirm: {
                  text: "Yes, delete it!",
                  className: "btn btn-success",
                },
                cancel: {
                  visible: true,
                  className: "btn btn-danger",
                },
              },
            }).then((Delete) => {
              if (Delete) {
                swal({
                  title: "Deleted!",
                  text: "Your file has been deleted.",
                  type: "success",
                  buttons: {
                    confirm: {
                      className: "btn btn-success",
                    },
                  },
                });
              } else {
                swal.close();
              }
            });
          });

          $("#alert_demo_8").click(function (e) {
            swal({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              type: "warning",
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
                swal("Poof! Your imaginary file has been deleted!", {
                  icon: "success",
                  buttons: {
                    confirm: {
                      className: "btn btn-success",
                    },
                  },
                });
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

      //== Class Initialization
      jQuery(document).ready(function () {
        SweetAlert2Demo.init();
      });
</script>
        @endsection