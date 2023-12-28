@extends('layouts.app')
@section('main-content')
    <div class="row mt-5">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5>Upload Vedio</h5>
                </div>
                <div class="card-body">
                    <form id="formData" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="">Upload Vedio</label>
                                <input type="file" name="upload_vedio" class="form-control">
                            </div>
                            <div class="col-md-2 mt-4">

                                <button class="btn btn-primary rounded-pill uploadBtn" id="uploadButton">Upload</button>

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
            $(document).on("click", ".uploadBtn", function(e) {
                e.preventDefault();
                var Data = new FormData(formData);
                $.ajax({
                    url: "{{ url('video') }}",
                    method: "POST",
                    data: Data,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        alert(res)
                    }
                })

            })
        })
    </script>
@endsection
