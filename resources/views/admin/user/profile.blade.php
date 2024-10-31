@extends('admin.layout.app')
@section('title','Admin Profile')
@section('header')
<style>
    .avatar-away::before, .avatar-offline::before, .avatar-online::before{
        position: absolute;
        right: 28px;
        bottom: 28px;
        width: 10%;
        height: 10%;
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
                <h3 class="fw-bold mb-3">Profile</h3>
              </div>
            </div>
            
            <div class="row row-demo-grid">
                  <div class="col-6 col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="avatar-online ">
                        <img src="{{asset('assets/img/jm_denis.jpg')}}" class="avatar-img rounded-circle" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-8">
                    <div class="card">
                      <div class="card-body">
                        
                             @if (Auth::check())
                                @if(Auth::user()->email_verified === 1)
                                Email confirmed
                                
                                @else
                                Email is not confirmed, please confirm the email<br>
                                <form action="{{ route('confirm.email') }}" method="post">
                                    @csrf
                                    <button
                                    type="submit"
                                    class="btn btn-primary"
                                    id="alert_demo_6"
                                    >
                                    confirm
                                    </button>
                            </form>
                                @endif
                            @else
                            No Result
                            @endif
                      <table class="table table-typo" style="background-color:#dddddd;">
                      <tbody>
                        <tr>
                          <td>
                            <p>First Name</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->first_name }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>Last Name</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->last_name }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>User Name</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->username }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>Email</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->email }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>Birth Day</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->birth_date }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>job</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->job }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>country</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->country }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>state</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->state }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>city</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->city }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>Address 1</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->address1 }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>Address 2</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->address2 }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>zip code</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->zip_code }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>phone number</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->phone_number }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>created at</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->created_at }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
                        <tr>
                          <td>
                            <p>updated at</p>
                          </td>
                          <td>
                            <span class="h5">
                            @if (Auth::check())
                            {{ Auth::user()->updated_at }}
                            @else
                            No Result
                            @endif
                          </span>
                        </td>
                        </tr>
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