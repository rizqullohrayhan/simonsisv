<!-- <h1>{{$pengajuan}}</h1> -->
<?php if ($pengajuan == 0 || $dalamRevisi == 1) { ?>
    @can('anggaran_update')
    <button style="border:none;" class="iq-bg-primary rounded" style="padding: 1%;" data-toggle="modal" data-placement="top" title="Update Anggaran" data-original-title="Update Anggaran" href="" data-target="#update_anggaran<?= $anggaran[$i]->id ?>">
        <i class="ri-pencil-line"> </i>
    </button>
    @endcan
    @can('anggaran_delete')
    <form class="form-horizontal" method="get" action="{{ url('/anggaran/delete/'.base64_encode($anggaran[$i]->id)) }}">
        @csrf
        <input type="hidden" name="totalAnggaranTor" value="{{$tor[$t]->jumlah_anggaran}}">
        <input type="hidden" name="anggaranDiHapus" value="{{$anggaran[$i]->anggaran}}">
        <input type="hidden" name="id_tor" value="{{$tor[$t]->id}}">
        <button style="border:none;" class="ang-confirm iq-bg-danger rounded" type="submit" style="padding: 1%;margin:2%" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');">
            <i class="ri-delete-bin-line"></i>
        </button>
    </form>
    @endcan
<?php } ?>

<script>
    //  $(document).on('submit', '[id^=angconfirm]', function(e) {
    //     e.preventDefault();

    //     var data = $(this).serialize();

    //     return swal({
    //             title: "Are you sure?",
    //             text: "You will not be able to recover this imaginary file!",
    //             type: "warning",
    //             showCancelButton: true,
    //             confirmButtonColor: "#DD6B55",
    //             confirmButtonText: "Yes, delete it!",
    //             cancelButtonText: "No, cancel plx!",
    //             closeOnConfirm: false,
    //             closeOnCancel: false
    //         },
    //         function(isConfirm) {
    //             if (isConfirm) {
    //                 $.ajax({
    //                     type: 'POST',
    //                     url: '/torab',
    //                     data: data,
    //                     success: function(data) {
    //                         swal("Deleted!", "Your imaginary file has been deleted.", "success");
    //                     },
    //                     error: function(data) {
    //                         swal("NOT Deleted!", "Something blew up.", "error");
    //                     }
    //                 });
    //             } else {
    //                 swal("Cancelled", "Your imaginary file is safe :)", "error");
    //             }
    //         });

    //     return false;
    // });


    // $('#angcof').on('click', function(event) {
    //     event.preventDefault();
    //     const url = $(this).attr('href');
    //     swal({
    //         title: 'Are you sure?',
    //         text: 'This record and it`s details will be permanantly deleted!',
    //         icon: 'warning',
    //         buttons: ["Cancel", "Yes!"],
    //     }).then(function(value) {
    //         if (value) {
    //             window.location.href = url;
    //         }
    //     });
    // }); 
</script>