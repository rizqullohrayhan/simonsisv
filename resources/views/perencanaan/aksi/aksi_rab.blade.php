<?php
$pengajuan = 0;
$detail = "Lengkapi Data";
$name;
for ($trx1 = 0; $trx1 < count($trx_status_tor); $trx1++) {
    if ($trx_status_tor[$trx1]->id_tor == $tor[$t]->id) {
        for ($st1 = 0; $st1 < count($status); $st1++) {
            if ($trx_status_tor[$trx1]->id_status == $status[$st1]->id) {
                $name = $status[$st1]->nama_status;
                if ($status[$st1]->nama_status == "Proses Pengajuan") {
                    $pengajuan = 1;
                    $detail = "Detail";
                }
            }
        }
    }
}
?>
<?php
foreach ($role as $roles) {
    if ($roles->id == Auth::user()->role) {
        $RoleLogin = $roles->name;
    }
}
?>
<?php if ($pengajuan == 0 && ($tor[$t]->nama_pic == Auth::user()->name || $RoleLogin == "Prodi" || $RoleLogin == "Admin")) { ?>
    <?php if ($pengajuan == 0) { ?>
        @can('rab_update')
        <button class="badge badge-info rounded" data-toggle="modal" title="Update RAB" data-original-title="Update RAB" data-target="#update_rab<?= $rab[$r]->id ?>">
            <i class="fa fa-edit"></i>
        </button>
        @endcan
        @can('rab_delete')
        <a href="{{url('/rab/delete/'.base64_encode($rab[$r]->id))}}" class="button rab-confirm" title="Delete" id="rab-delete-confirm2">
            <button class="badge badge-info rounded">
                <i class="fa fa-trash"></i>
            </button>
        </a>
        @endcan
    <?php } ?>
<?php } ?>
<!-- 
<a href="{{url('/rab/detail/'.  $rab[$r]->id)}}"><button class="badge badge-info rounded"><i class="fa fa-tasks"></i>
    </button></a> -->
<div>
    <!-- <form method="post" action="/tor/ajuanKeg">
        @csrf
        <div class=" form-group">
            <input type="hidden" class="form-control" value="1" id="id_status" name="id_status">
            <input type="hidden" class="form-control" value="-" id="komentar" name="komentar">
            <input type="hidden" name="create_by" value="<?= Auth()->user()->id ?>">
            <input type="hidden" name="id_rab" value="<?php
                                                        // echo $rab[$b]->id 
                                                        ?>">
            <?php date_default_timezone_set('Asia/Jakarta'); ?>
            <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d H:i:s') ?>">
            <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
        </div>
        <button class="badge badge-info rounded" type="submit">
            Ajukan
        </button>
    </form> -->
</div>


<?php
// $ket = "Ajukan";
// $dis = "";
// $color = "warning";
// if (!empty($pengusulan)) {
//     for ($q = 0; $q < count($pengusulan); $q++) {
//         $ket = "Sudah Diajukan";
//         $dis = "Disabled";
//         $color = "success";
//     }
// }
?>