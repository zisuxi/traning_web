   @extends('layouts.app')
   @section('main-content')
       <!-- End Page Header -->
       <!-- Row -->
       <div class="row mt-3">
           <div class="col-lg-12">
               <div class="card custom-card">
                   <div class="card-header">
                       <h2 class="">Manage Videos</h2>
                   </div>

                   <div class="card-body ">

                       <div class="table-responsive  ">
                           <table id="tabledata" class="table table-hover table-bordered">
                               <thead>
                                   <tr>
                                       <td style="font-size: 12px;">Id</td>
                                       <td style="font-size: 12px;">Title</td>
                                       <td style="font-size: 12px;"> Video</td>
                                       <td>Actions</td>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php
                                   $num = 1;
                                   ?>
                                   @foreach ($data as $da)
                                       <tr>
                                           <td>{{ $num++ }}</td>
                                           <td>{{ ucfirst($da->title) }}</td>
                                           <td>
                                               <a href="{{ './video/' . $da->vedio }}"
                                                   target="_blank">{{ $da->vedio }}</a>
                                           </td>
                                           <td>
                                               <div class="hstack gap-3 flex-wrap">
                                                   <!-- Download button for each video -->
                                                   <a class="link-success fs-15 downloadRecord"
                                                       data-video="{{ $da->vedio }}" data-toggle="tooltip"
                                                       data-placement="top" title="Download" style="margin-left: 10px;">
                                                       <i class="fas fa-download"
                                                           style="font-size: 20px; cursor: pointer"></i>
                                                   </a>

                                                   <!-- Delete button -->
                                                   <a class="link-success fs-15 deleteRecord" style="margin-left: 20px;" data-toggle="tooltip"
                                                       data-placement="top" title="Remove"
                                                       data-delete='{{ $da->id }}'>
                                                       <i class="fas fa-trash" style="font-size: 20px; cursor: pointer"></i>
                                                   </a>
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
               $(document).on("click", ".deleteRecord", function(e) {
                   e.preventDefault()
                   Swal.fire({
                       title: "Are you sure?",
                       text: "You won't be able to revert this!",
                       icon: "warning",
                       showCancelButton: true,
                       confirmButtonColor: "#b31e1e !important",
                       cancelButtonColor: "#b31e1e !important",
                       confirmButtonText: "Yes, delete it!",
                   }).then((result) => {
                       if (result.isConfirmed) {
                           var deleteId = $(this).data("delete");
                           var element = this;
                           $.ajax({
                               url: "/upload_video/" + deleteId,
                               method: "DELETE",
                               success: function(response) {
                                   if (response == 200) {
                                       Swal.fire({
                                           toast: true,
                                           icon: "success",
                                           title: "Video Deleted Successfully..!",
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
                                           title: "Video Not Deleted ..!",
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
               });
           })
       </script>
       {{-- download button --}}
       <script>
           document.addEventListener("DOMContentLoaded", function() {
               document.querySelectorAll('.downloadRecord').forEach(function(element) {
                   element.addEventListener('click', function(event) {
                       event.preventDefault();
                       var videoFilename = this.getAttribute('data-video');
                       var downloadUrl = './video/' + videoFilename;
                       var a = document.createElement('a');
                       a.href = downloadUrl;
                       a.download = videoFilename;
                       a.style.display = 'none';
                       document.body.appendChild(a);
                       a.click();
                       document.body.removeChild(a);
                   });
               });
           });
       </script>
   @endsection
