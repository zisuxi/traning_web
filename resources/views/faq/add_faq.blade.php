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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""> Question :</label>
                                            <textarea name="question" cols="30" rows="5" class="form-control" placeholder="Enter your Question"
                                                required=""></textarea>
                                            <strong class="text-danger question"></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""> Answer :</label>
                                            <textarea name="answer" class="form-control" cols="30" rows="5" placeholder="Enter Your Answer"
                                                required=""></textarea>
                                            <strong class="text-danger answer"></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12 d-flex justify-content-end">
                                        <button class="btn ripple btn-main-primary submitData text-white"
                                            style="background-color:#11235A;" id="add_faq">Add Faq</button>
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
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("click", ".submitData", function(stop) {
                stop.preventDefault();
                const button = document.getElementById("add_faq");
                button.innerHTML =
                    "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Processing...";
                button.setAttribute("disabled", "disabled");
                setTimeout(function() {
                    button.removeAttribute("disabled");
                    button.innerHTML = "+Add Faq";
                }, 500);
                var formData = new FormData(form_submit);
                $.ajax({
                    url: "/faq",
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(res) {
                        if (res.message == 200) {
                            button.removeAttribute("disabled");
                            button.innerHTML = "Add user";
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                title: "FAQ added Successfully..!",
                                animation: false,
                                position: "top-right",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            setInterval(function() {
                                window.location.reload();
                            }, 3000);
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
                    error: function(error) {
                        var error = error.responseJSON;
                        $(".question").empty();
                        $(".answer").empty();
                        $(".question").append(error.errors.question);
                        $(".answer").append(error.errors.answer);


                    }
                });
            });
        });
    </script>
@endsection
