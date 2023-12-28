@extends('layouts.app')

@section('main-content')
    <form id="form_submit" class="needs-validation was-validated" novalidate="">
        <div class="row">
            <div class="col-lg-8 mt-5 mx-auto">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Add Faq</h4>
                            </div>
                            {{-- <div class="col-md-6 d-flex justify-content-end">
                                <button type="button" onclick="add_more();"
                                    class="btn rounded-pill px-4 btn-outline-success font-medium waves-effect waves-light">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div id="product_fields">
                                <div class="row" id="product_attr_1">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for=""> Question :</label>
                                            <textarea name="question" cols="30" rows="5" class="form-control" placeholder="Enter your Question"
                                                required=""></textarea>
                                            <strong class="text-danger question-error"></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for=""> Answer :</label>
                                            <textarea name="answer" class="form-control" cols="30" rows="5" placeholder="Enter Your Answer"
                                                required=""></textarea>
                                            <strong class="text-danger answer-error"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6 text-start">
                                        <button class="btn ripple btn-main-primary">
                                            < Go Back</button>
                                    </div>
                                    <div class="col-lg-6 d-flex justify-content-end">
                                        <button class="btn ripple btn-main-primary submitData">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    {{-- <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script> --}}
    <script>
        // var count = 1;

        // function add_more() {
        //     count++;
        //     var html = '<div class="form-group" id="product_attr_' + count + '"><div class="row">';
        //     html +=
        //         '<div class="col-md-5 mt-3"><textarea class="form-control"  cols="30" rows="5" name="question[]" placeholder="Enter Question" required=""></textarea>  </div>';
        //     html +=
        //         '<div class="col-md-5 mt-3"><textarea class="form-control" cols="30" rows="5" name="answer[]" placeholder="Enter Answer" required=""></textarea> </div>';
        //     html +=
        //         '<div class="col-md-2 mt-3"><button type="button" onclick="remove_more(' +
        //         count +
        //         ');" class="btn rounded-pill px-4 btn-outline-danger font-medium waves-effect waves-light"><i class="fas fa-minus"></i></button></div>';
        //     html += '</div></div>';
        //     jQuery("#product_fields").append(html);
        // }

        // function remove_more(count) {
        //     jQuery("#product_attr_" + count).remove();
        // }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("click", ".submitData", function(stop) {
                stop.preventDefault();
                var formData = new FormData(form_submit);
                $.ajax({
                    url: "/faq",
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(res) {
                        if (res.message == 200) {
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: "Data inserted Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: "some thing went wronge..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });;
                        }
                    },
                    error: function(xhr) {
                        var error = xhr.responseJSON;

                    }
                });
            });
        });
    </script>
@endsection
{{-- @extends('layouts.app')
@section('main-content')


<form class="needs-validation" novalidate>
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationCustom01">First name</label>
        <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="validationCustom02">Last name</label>
        <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="validationCustomUsername">Username</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
          </div>
          <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
          <div class="invalid-feedback">
            Please choose a username.
          </div>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label for="validationCustom03">City</label>
        <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
        <div class="invalid-feedback">
          Please provide a valid city.
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="validationCustom04">State</label>
        <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
        <div class="invalid-feedback">
          Please provide a valid state.
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="validationCustom05">Zip</label>
        <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
        <div class="invalid-feedback">
          Please provide a valid zip.
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
          Agree to terms and conditions
        </label>
        <div class="invalid-feedback">
          You must agree before submitting.
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="submit">Submit form</button>
  </form>


@endsection --}}
