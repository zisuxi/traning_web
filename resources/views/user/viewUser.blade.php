@extends('layouts.app')
@section('main-content')

    <!-- End Page Header -->
    <!-- Row -->
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h2 class="">Manage  Users</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabledata" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td style="font-size: 12px;">Id</td>
                                    <td style="font-size: 12px;">Dob</td>
                                    <td style="font-size: 12px;"> User Name</td>
                                    <td style="font-size: 12px;">User Email</td>
                                    <td style="font-size: 12px;">Is Admin </td>
                                    <td style="font-size: 12px;">User Type </td>
                                    <td style="font-size: 12px;">street Address</td>
                                    <td style="font-size: 12px;">City</td>
                                    <td style="font-size: 12px;">Zip Code </td>
                                    <td style="font-size: 12px;">Country</td>
                                    <td style="font-size: 12px;">city</td>
                                    <td style="font-size: 12px;">State</td>
                                    <td style="font-size: 12px;">Contact No</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($user_meta as $meta)
                                    <tr>
                                        <td>{{ $meta->id }}</td>
                                        <td>{{ $array[$meta['id']]->dob }}</td>
                                        <td>{{ Ucfirst($meta->user_name) }}</td>
                                        <td>{{ $meta->email }}</td>
                                        <td>
                                            @if ($meta->Is_admin == 0)
                                                <span class="badge rounded-pill bg-info text-white mt-3 ml-3 p-2">{{ 'User' }}</span>
                                            @else
                                                <span class="badge badge-info">{{ 'Admin' }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($meta->Is_active == 0)
                                                <div class="form-group">
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox" id="SwitchCheck1"
                                                            value="{{ $meta->id }}">
                                                        <label class="form-check-label"
                                                            id="category_status_{{ $meta->id }}"><b
                                                                class="badge  text-white"
                                                                style="background-color:#596FB7">In-active</b> </label>
                                                    </div>
                                                </div>
                                                {{-- <span class="badge badge-success p-2">{{ 'In-active' }}</span> --}}
                                            @else
                                                <div class="form-group">
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox" id="SwitchCheck1"
                                                            value="{{ $meta->id }}" checked>
                                                        <label class="form-check-label"
                                                            id="category_status_{{ $meta->id }}"><b
                                                                class="badge  text-white"
                                                                style="background-color: red">Active</b> </label>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>

                                        <td>{{ $array[$meta['id']]->street_address }}</td>
                                        <td>{{ $array[$meta['id']]->city }}</td>
                                        <td>{{ $array[$meta['id']]->zip_code }}</td>
                                        <td>{{ $array[$meta['id']]->country }}</td>
                                        <td>{{ $array[$meta['id']]->city }}</td>
                                        <td>{{ $array[$meta['id']]->state }}</td>
                                        <td>{{ $array[$meta['id']]->contact_no }}</td>
                                        <td>
                                            <div class="hstack gap-3 flex-wrap">
                                                <a href="{{ 'user/' . $meta->id . '/edit' }}" data-toggle="tooltip"
                                                    data-placement="top" title="Edit"
                                                    class="link-danger fs-15 editData"><i class="fas fa-edit"
                                                        style="font-size: 20px;"></i></a>
                                                <a href="" class="link-success fs-15 deleteRecord"
                                                    data-toggle="tooltip" data-placement="top" title="Remove"
                                                    data-delete='{{ $meta->id }}'><i class="fas fa-trash  "
                                                        style="font-size: 20px;"></i></a>
                                            </div>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("click", ".deleteRecord", function(stop) {
                stop.preventDefault();
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
                            url: "/user/" + deleteId,
                            method: "DELETE",
                            success: function(response) {
                                if (response.status == 200) {
                                    Swal.fire({
                                        toast: true,
                                        icon: "success",
                                        title: "user Deleted Successfully..!",
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
                                        title: "user Not Deleted ..!",
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
            $(document).on("change", "#SwitchCheck1", function() {
                var value = $(this).val();
                $.ajax({
                    url: "/changeStatus/" + value,
                    method: "get",
                    contentType: false,
                    processData: false,
                    success: function(res) {

                        if (res.status.Is_active == 1) {
                            $("#category_status_" + res.status.id).empty();
                            $("#category_status_" + res.status.id).append(
                                "<span class='badge text-white' style='background-color:#596FB7'>In-active </span>"
                            );
                        } else {
                            $("#category_status_" + res.status.id).empty();
                            $("#category_status_" + res.status.id).append(
                                "<span class='badge text-white' style='background-color:red'>Active </span>"
                            );

                        }
                    }

                })
            });

        })
    </script>
@endsection
