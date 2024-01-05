@extends('layouts.app')
@section('main-content')
    <div class="row mt-5">
        <div class="col-lg-6 col-md-6 mx-auto">
            <div class="card custom-card">
                <div class="card-header">
                    <h5>Upload Video</h5>

                </div>
                <div class="card-body">
                    <form id="formData">
                        @csrf
                        <div class="row ">
                            <div class="col-md-12">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Your Title">
                                <strong id="title" class="text-danger"></strong> <br>
                            </div>

                            <div class="col-md-12">
                                <label for="">Upload Video</label>
                                <input type="file" name="upload_vedio" class="form-control">
                                <strong id="upload_vedio" class="text-danger"></strong>
                                <div id="myProgress" class="mt-5 progress-bar progress-bar-striped progress-bar-animated">
                                    <div id="myBar"></div>
                                </div>
                                <style>
                                    #myProgress {
                                        width: 100%;
                                        background-color: whitesmoke;
                                        border-radius: 20px;
                                        display: none;
                                    }

                                    #myBar {
                                        width: 1%;
                                        height: 10px;
                                        background-color: #11235A;
                                    }
                                </style>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button class="btn   rounded-pill  text-white" style="background-color:#11235A"
                                    id="uploadButton">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function move() {
                var i = 0;
                var elem = document.getElementById("myBar");
                var width = 1;
                var id = setInterval(frame, 10);

                function frame() {
                    if (width >= 100) {
                        clearInterval(id);
                        i = 0;
                    } else {
                        width++;
                        elem.style.width = width + "%";
                    }
                }

                return {
                    stop: function() {
                        clearInterval(id);
                        elem.style.width = "0%";
                        i = 0;
                    }
                };
            }

            $(document).on("click", "#uploadButton", function(e) {
                e.preventDefault();
                $("#myProgress").show();
                var progressBar = move();
                const button = document.getElementById("uploadButton");
                button.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                button.setAttribute("disabled", "disabled");
                setTimeout(function() {
                    button.removeAttribute("disabled");
                    button.innerHTML = "+Upload";
                }, 500);
                var Data = new FormData(formData);
                $.ajax({
                    url: "{{ url('upload_video') }}",
                    method: "POST",
                    data: Data,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        progressBar.stop();
                        if (res.message == 200) {
                            button.removeAttribute("disabled");
                            button.innerHTML = "Upload";
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: "Video Uploaded Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            setInterval(function() {
                                window.location.reload();
                            }, 2000);
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: "error",
                                title: "Video not inserted Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    },
                    error: function(error) {
                        progressBar.stop();
                        var error = error.responseJSON;
                        $.each(error.errors, function(key, value) {
                            $("#" + key).empty();

                            $("#" + key).append(value);
                        });
                    }
                });
            });
        });
    </script>
@endsection
