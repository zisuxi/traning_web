@extends('layouts.app')
@section('main-content')
    <form id="formElement" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-6  mt-5">
                <div class="card custom-card">
                    <div class="card-header">
                        <h4 class="display-5">Edit User</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div class="form-group">
                                <label for=""> Name :</label>
                                <input class="form-control" placeholder="Enter your username" type="text"
                                    name="user_name" value="{{ $edit_user->user_name }}">
                                <strong id="user_name" class="text-danger"></strong>
                            </div>
                            <div class="form-group">
                                <label for=""> Email :</label>
                                <input class="form-control" placeholder="Enter Your Email" type="email" name="email"
                                    value="{{ $edit_user->email }}">
                                <strong class="text-danger" id="email"></strong>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""> Dob :</label>
                                        <input class="form-control" placeholder="Enter your username" type="date"
                                            name="dob" value="{{ $edit_userMeta->dob }}">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""> Contact No :</label>

                                        <input class="form-control" name="contact_no" placeholder="Enter Your Conact No "
                                            type="number" value="{{ $edit_userMeta->contact_no }}">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6  mt-5">
                <div class="card custom-card">

                    <div class="card-header">
                        <h4 class="display-5">Edit Personal Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> Country :</label>
                                        <input class="form-control" name="country" placeholder="Enter Your " type="text"
                                            value="{{ $edit_userMeta->country }}">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> State :</label>

                                        <input class="form-control" name="state" placeholder="Enter Your State"
                                            type="text" value="{{ $edit_userMeta->state }}">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> City :</label>
                                        <input class="form-control" name="city" placeholder="Enter Your city"
                                            type="text" value="{{ $edit_userMeta->city }}">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> Zip Code :</label>
                                        <input class="form-control" name="zip_code" placeholder="Enter Your city"
                                            type="text" value="{{ $edit_userMeta->zip_code }}">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""> Street Address :</label>

                                <textarea name="street_address" id="" cols="3" class="form-control" placeholder="Enter Your Address"
                                    value="">{{ $edit_userMeta->street_address }}</textarea>
                                <strong class="text-danger" id=""></strong>
                                <input type="hidden" id="hidden" value="{{ $edit_user->id }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">

                <div class="card-footer">
                    <div class="col-lg-12 d-flex justify-content-end">
                        <button class="btn ripple btn-main-primary updateData text-white"
                            style="background-color:#11235A;" id="update_user">Update user</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".updateData", function(stop) {
                stop.preventDefault();
                const button = document.getElementById("update_user");
                button.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                button.setAttribute("disabled", "disabled");
                setTimeout(function() {
                    button.removeAttribute("disabled");
                    button.innerHTML = "+Update user";
                }, 500);
                var updateId = $("#hidden").val();
                var formdata = new FormData(formElement);
                $.ajax({
                    url: "/user/" + updateId,
                    method: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.message == 200) {
                            button.removeAttribute("disabled");
                            button.innerHTML = "Update user";
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: "User  Updated Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        } else {
                            button.removeAttribute("disabled");
                            button.innerHTML = "Update user";
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: "User not  Updated ..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
