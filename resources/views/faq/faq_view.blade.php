@extends('layouts.app')
@section('main-content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">View Faq</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabledata" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td style="font-size: 12px;">Id</td>
                                    <td style="font-size: 12px;">Question</td>
                                    <td style="font-size: 12px;">Answer</td>
                                    <td style="font-size: 12px;">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp @forelse ($faq as $fa)
                                    <tr>
                                        <td>{{ $num++ }}</td>
                                        <td>
                                            {{ $fa->question }}
                                        </td>
                                        <td>
                                            <button class="btn  detail_faq" data-toggle="tooltip" data-placement="top"
                                                title="Answer detail " data-detail='{{ $fa->id }}'><i
                                                    class="fa-regular fa-eye-slash"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn  deleteBtn" data-delete='{{ $fa->id }}'
                                                data-toggle="tooltip" data-placement="top" title="remove"> <i
                                                    class="fa-solid fa-trash" style="font-size: 20px;"></i> </button>
                                        </td>
                                    </tr>
                                @empty
                                    <span>{{ 'Data not Found ' }}</span>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="modal fade" id="exampleModalLong" aria-labelledby="exampleModalLongTitle"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne" id="Detail_question">
                                            </button>
                                        </h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="accordion">
                                            <div class="card">

                                                <div id="collapseOne" class="" aria-labelledby="headingOne"
                                                    data-parent="#accordion">
                                                    <div class="card-body" id="detail_answer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".detail_faq", function(e) {
                e.preventDefault();
                var Detail_id = $(this).data('detail');

                $.ajax({
                    url: "/faq/" + Detail_id + "show",
                    method: "GET",
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.message == 200) {
                            $("#exampleModalLong").modal('show');
                            $("#Detail_question").empty();
                            $("#detail_answer").empty();
                            $("#Detail_answer").empty();
                            $("#Detail_question").append(
                                "<span class='badge badge-primary mx-3 '>Question </span>" +
                                '<span style="font-size:17px; font-weight:bold;     color: #eb6f33">' +
                                res.data.question + '</span>')
                            $("#detail_answer").append(
                                "<span class='badge badge-primary mx-3'>Answer </span>" +
                                '<span style="font-size:16px; font-weight:bold; color: #69697b;">' +
                                res.data.answer + '</span>')
                        }

                    }
                })
            })
            $(document).on("click", ".deleteBtn", function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault()
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#e12334",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        var deleteId = $(this).data("delete");
                        var element = this;
                        $.ajax({
                            url: "/faq/" + deleteId,
                            method: "DELETE",
                            success: function(response) {
                                if (response.message == 200) {
                                    Swal.fire({
                                        toast: true,
                                        icon: "success",
                                        title: "Data Deleted Successfully..!",
                                        animation: false,
                                        position: "top-right",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                    $(element).closest("tr").fadeOut();
                                } else {
                                    Swal.fire({
                                        toast: true,
                                        icon: "error",
                                        title: "Data Not Deleted ..!",
                                        animation: false,
                                        position: "top-right",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                }
                            },
                        });
                    }
                })
            })
        })
    </script>
@endsection
