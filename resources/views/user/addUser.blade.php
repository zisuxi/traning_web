@extends('layouts.app')
@section('main-content')
    <form action="" id="formData" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6  mt-5">
                <div class="card custom-card">
                    <div class="row">
                        <div class="col-md-6 ">
                            <h1
                                style="font-size: 26px;
                        margin-left: 20px;
                        margin-top: 10px;">
                            </h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div class="form-group">
                                <label for=""> Name :</label>
                                <input class="form-control" placeholder="Enter your username" type="text"
                                    name="user_name">
                                <strong id="user_name" class="text-danger"></strong>
                            </div>
                            <div class="form-group">
                                <label for=""> Email :</label>

                                <input class="form-control" placeholder="Enter Your Email" type="email" name="email">
                                <strong class="text-danger" id="email"></strong>
                            </div>
                            <div class="form-group">
                                <label for=""> Password :</label>
                                <input class="form-control" name="password" placeholder="Enter Your Password"
                                    type="password">
                                <strong id="password" class="text-danger"></strong>
                            </div>
                            <div class="form-group">
                                <label for=""> Confirm Password :</label>

                                <input class="form-control" name="password_confirmation" placeholder="Enter Your Password"
                                    type="password">
                                <strong id="password_confirmation" class="text-danger"></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6  mt-5">
                <div class="card custom-card">
                    <div class="row">
                        <div class="col-md-6 ">
                            <h1
                                style="font-size: 26px;
                        margin-left: 20px;
                        margin-top: 10px;">
                            </h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""> Dob :</label>
                                        <input class="form-control" placeholder="Enter your username" type="date"
                                            name="dob">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""> Contact No :</label>

                                        <input class="form-control" name="contact_no" placeholder="Enter Your Conact No "
                                            type="number">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> Country :</label>
                                        <input class="form-control" name="country" placeholder="Enter Your " type="text">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> State :</label>

                                        <input class="form-control" name="state" placeholder="Enter Your State"
                                            type="">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> City :</label>
                                        <input class="form-control" name="city" placeholder="Enter Your city"
                                            type="text">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> Zip Code :</label>
                                        <input class="form-control" name="zip_code" placeholder="Enter Your city"
                                            type="text">
                                        <strong id="" class="text-danger"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""> Street Address :</label>

                                <textarea name="street_address" id="" cols="3" class="form-control"
                                    placeholder="Enter Your Address"></textarea>
                                <strong class="text-danger" id=""></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">

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
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $(document).on("click", ".submitData", function(stop) {
                stop.preventDefault();
                var formdata = new FormData(formData);;
                $.ajax({
                    url: "/user",
                    method: "POST",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(res) {

                        if (res.status == 200) {
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
                            });
                        }
                    },
                    error: function(error) { // remove the parameter here
                        var error = error.responseJSON;
                        $.each(error.errors, function(key, value) {
                            $("#" + key).append(value)
                        })
                    }
                })
            });
            // < ----------============== add meta user ==================== --------->
            $(document).on("click", ".dataAdd", function(stop) {
                stop.preventDefault();
                var formData = new FormData(metaForm);
                $.ajax({
                    url: "/user-meta",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        alert(res)
                    }
                })
            })
        })
    </script>
@endsection
