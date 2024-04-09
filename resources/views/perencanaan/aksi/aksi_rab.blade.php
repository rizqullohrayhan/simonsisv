@php
$pengajuan = 0;
$detail = "Lengkapi Data";
$name;
for ($trx1 = 0; $trx1 < count($trx_status_tor); $trx1++) {
    if ($trx_status_tor[$trx1]->id_tor == $tItem->id) {
        for ($st1 = 0; $st1 < count($status); $st1++) {
            if ($trx_status_tor[$trx1]->id_status == $status[$st1]->id) {
                if ($status[$st1]->nama_status != "Revisi") {
                    $pengajuan = 1;
                    $detail = "Detail";
                } else {
                    $pengajuan = 0;
                }
            }
        }
    }
}
foreach ($role as $roles) {
    if ($roles->id == Auth::user()->role) {
        $RoleLogin = $roles->name;
    }
}
@endphp
@if ($pengajuan == 0 && $RoleLogin == "Prodi")
        @can('rab_update')
        <button class="badge badge-info rounded" data-toggle="modal" title="Update RAB" data-original-title="Update RAB" data-target="#update_rab<?= $rabrev->id ?>">
            <i class="fa fa-edit"></i>
        </button>
        @endcan
        @can('rab_delete')
        <a href="{{url('/rab/delete/'.base64_encode($rabrev->id))}}" class="button rab-confirm" title="Delete" id="rab-delete-confirm2">
            <button class="badge badge-info rounded">
                <i class="fa fa-trash"></i>
            </button>
        </a>
        @endcan
@endif