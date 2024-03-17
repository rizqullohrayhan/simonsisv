<?php

//komponen jadwal di tor sudah ada ? '' : 'disable button Ajukan'
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

$buttonVerif = "Tidak";
for ($kj = 0; $kj < count($komponen_jadwal); $kj++) {
    if ($komponen_jadwal[$kj]->id_tor == $tor[$t]->id) {
        $buttonVerif = "Ada";
    }
} ?>

<?php
$pengajuan = 0;
$pengajuanPerbaikan = 0;
$i = 0;
$validasi = 0;
$final = '';
$detail = "Lengkapi Data";
$jumlahval = 0;
$name = [
    'status' => [],
    'pembuat' => []
];
for ($trx1 = 0; $trx1 < count($trx_status_tor); $trx1++) {
    if ($trx_status_tor[$trx1]->id_tor == $tor[$t]->id) {
        $jumlahval += 1;
        for ($st1 = 0; $st1 < count($status); $st1++) {
            if ($trx_status_tor[$trx1]->id_status == $status[$st1]->id) {
                for ($u5 = 0; $u5 < count($user); $u5++) {
                    if ($trx_status_tor[$trx1]->create_by == $user[$u5]->id) {
                        for ($r5 = 0; $r5 < count($role); $r5++) {
                            if ($user[$u5]->role == $role[$r5]->id) {
                                $name['status'][$i] = $status[$st1]->nama_status;
                                $name['pembuat'][$i]  = $trx_status_tor[$trx1]->role_by;
                            }
                        }
                    }
                }
                if ($status[$st1]->nama_status == "Proses Pengajuan") {
                    $pengajuan += 1;
                    $detail = "Detail";
                }
                // if ($status[$st1]->nama_status == "Validasi" && $name['pembuat'][$i] == "WD 3") {
                //     $validasi += 1;
                // }
                // if ($status[$st1]->nama_status == "Validasi" && $name['pembuat'][$i] == "WD 2") {
                //     $validasi += 1;
                // }
                if ($status[$st1]->nama_status == "Validasi" && $name['pembuat'][$i] == "WD 3") {
                    $final = "Validasi WD 3";
                }
                if ($status[$st1]->nama_status == "Pengajuan Perbaikan") {
                    $pengajuanPerbaikan += 1;
                }
                $i += 1;
            }
        }
    }
}

$revisi = 0;
$perbaikan = 0;
for ($st3 = 0; $st3 < count($name['status']); $st3++) {
    $name['status'][$st3];
    if ($name['status'][$st3] == "Revisi") {
        $revisi += 1;
    }
    if ($name['status'][$st3] == "Pengajuan Perbaikan") {
        $perbaikan += 1;
    }
}
?>


<!-- ------------------------------------------ A K S E S N A M A P I C ----------------------------------- -->
<!-- <h6>{{$tor[$t]->nama_pic. " ? " . Auth::user()->name}}</h6> -->
<?php
foreach ($role as $roles) {
    if ($roles->id == Auth::user()->role) {
        $RoleLogin = $roles->name;
    }
}
?>


<!-- -------------------------------------------------- B U T T O N ------------------------------------------ -->
<!-- LENGKAPI TOR -->
<a href="{{url('/lengkapitor/'.  base64_encode($tor[$t]->id))}}">
    <button class="badge {{$detail == 'Lengkapi Data' ? 'badge-danger' : 'badge-warning'}} rounded">{{ $detail}}</button>
</a>

<?php
$currentStatus = '';
for ($stk2 = 0; $stk2 < count($trx_status_tor); $stk2++) {
    if ($trx_status_tor[$stk2]->id_tor == $tor[$t]->id) {
        $trx_status_tor[$stk2]->id_status;

        foreach ($status as $statusTor) {
            if ($statusTor->id == $trx_status_tor[$stk2]->id_status) {
                $currentStatus = $statusTor->nama_status;
                foreach ($user as $userrole) {
                    $currentStatusRole =  $trx_status_tor[$stk2]->role_by;
                }
            }
        }
    } else {
    }
}
?>
<!-- VERIFIKASI OLEH KAPRODI  -->
@can('tor_verifikasi_kaprodi')
@if($currentStatus == "Proses Pengajuan" || $currentStatus == "Pengajuan Perbaikan")
<a href="{{url('/detailtor/'.  base64_encode($tor[$t]->id))}}">
    <button class="badge badge-warning rounded">Verifikasi Kaprodi</button>
</a>
@endif
@endcan

<!-- Jika belum diajukan oleh prodi atau pic, dan nama pic sama dengan user login, maka tampilkan aksi -->
<?php if ($pengajuan == 0 && ($tor[$t]->nama_pic == Auth::user()->name || $RoleLogin == "Prodi" || $RoleLogin == "Admin")) { ?>
    @can('tor_update')
    <a href="{{url('/tor/update/'.base64_encode($tor[$t]->id))}}" data-toggle="tooltip" title="Update">
        <button class="badge badge-primary rounded">
            <i class="fa fa-edit"></i>
        </button>
    </a>
    @endcan
    @can('tor_delete')
    <a href="{{url('/tor/delete/'.base64_encode($tor[$t]->id))}}" class="button tor-confirm" data-toggle="tooltip" title="Delete">
        <button class="badge badge-primary rounded">
            <i class="fa fa-trash"></i>
        </button>
    </a>
    @endcan
    <!-- <button class="search-toggle iq-waves-effect badge badge-primary rounded" data-toggle="modal" title="Detail TOR" data-original-title="Detail TOR" data-target="#detail_tor<?= $tor[$t]->id ?>"><i class="fa fa-tasks"></i><br />
</button> -->
    <?php $sudahAdaRAB = 0;
    foreach ($rab as $sr) {
        if ($sr->id_tor == $tor[$t]->id) {
            $sudahAdaRAB = 1;
        }
    } ?>
    @can('rab_create')
    <?php if ($sudahAdaRAB == 0) { ?>
        <button class="search-toggle iq-waves-effect badge badge-info rounded" data-toggle="modal" title="Tambah RAB" data-original-title="Tambah RAB" data-target="#tambah_rab<?= $tor[$t]->id ?>">Tambah RAB<br />
        </button>
    <?php } ?>
    @endcan
    @can('tor_ajuan')
    <?php
    $buttonAjukan = 1; //agar button ajukan tidak berulang ulang
    for ($sr = 0; $sr < count($rab); $sr++) {
        if ($rab[$sr]->id_tor == $tor[$t]->id) {
            foreach ($anggaran as $anggaran1) {
                if ($anggaran1->id_rab == $rab[$sr]->id && $buttonAjukan == 1) { ?>
                    <button class="badge badge-danger rounded" data-toggle="modal" data-target="#ajukan{{$tor[$t]->id}}" {{$buttonVerif == "Tidak" ? 'disabled' : ''}}>Ajukan TOR & RAB
                    </button>
    <?php $buttonAjukan += 1;
                }
            }
        }
    } ?>
    @endcan
<?php } ?>
<?php if ($pengajuan >= 1) { ?>
    <button class="badge badge-success rounded" data-toggle="modal" data-target="#status{{$tor[$t]->id}}">Status
    </button>
<?php } ?>

<!-- ------------------------------------------------ ---------------- ---------------- -->
<!-- ----------------- F I T U R  A L E R T  S E G E R A   R E V I S I ---------------  -->
<!-- ------------------------------------------------ ---------------- ---------------- -->

<?php
$pengajuan = 0;
$detail = "Lengkapi Data";
$name;
$dalamRevisi = 0; // apakah sekarang dalam proses revisi? jika iya, maka dpt ditampilkan aksi jadwal dan rab
$countRevisi = 0; //megnhitung brp kali revisi
$countPerbaikan = 0; //megnhitung brp kali perbaikan
for ($trx1 = 0; $trx1 < count($trx_status_tor); $trx1++) {
    if ($trx_status_tor[$trx1]->id_tor == $tor[$t]->id) {
        for ($st1 = 0; $st1 < count($status); $st1++) {
            if ($trx_status_tor[$trx1]->id_status == $status[$st1]->id) {
                $name = $status[$st1]->nama_status;
                if ($status[$st1]->nama_status == "Proses Pengajuan") {
                    $pengajuan = 1;
                    $detail = "Detail";
                }
                if ($status[$st1]->nama_status == "Revisi") {
                    $countRevisi += 1;
                }
                if ($status[$st1]->nama_status == "Pengajuan Perbaikan") {
                    $countPerbaikan += 1;
                }
            }
        }
    }
}

$dalamRevisi = 0; //false
$angSudahRevisi = "-"; //apakah ang sudah direvisi

//jika jumlah revisi tidak sama dengan perbaikan, maka aktifkan button aksi
if ($countRevisi != $countPerbaikan) {
    $dalamRevisi = 1;
}
$alertRevisi = ""; //menampilkan peringatan untuk merevisi jadwal dan rab

if ($dalamRevisi == 1) { //true
    foreach ($trx_status_tor as $revisian) {
        if ($revisian->id_tor == $tor[$t]->id) {

            //cek di tabel T O R apakah update_at > created_at di trx tor revisi
            $TorSudahRevisi = "-"; //apakah TOR sudah direvisi
            foreach ($tor as $torRev) {
                if ($torRev->updated_at > $revisian->created_at) {
                    $TorSudahRevisi = "Sudah";
                }
                if ($torRev->updated_at > $revisian->created_at) {
                    if ($TorSudahRevisi != "Sudah") {
                        $TorSudahRevisi = "Belum"; //berarti belum direvisi
                    }
                }
            }
        }
    }
}
?>

<?php if ($perbaikan < $revisi && $TorSudahRevisi == '-') { ?>
    <form class="form-horizontal" method="get" action="{{ url('/tor/revisi/'.  base64_encode($tor[$t]->id)) }}">
        @csrf
        <input type="hidden" name="akses" value="1">
        <button class="badge badge-danger rounded" type="submit">
            Segera Revisi
        </button>
    </form>
<?php } ?>



<!-- ------------------------------------------------ ---------------- ---------------- -->
<!-- ------------------------------------------------ ---------------- ---------------- -->
<!-- ------------------------------------------------ ---------------- ---------------- -->




@can('tor_ajuan')
<?php if ($tor[$t]->jenis_ajuan == "Perbaikan" && ($perbaikan < $revisi)) { ?>
    <button class="badge badge-danger rounded" data-toggle="modal" data-target="#ajukan{{$tor[$t]->id}}" {{$buttonVerif == "Tidak" ? 'disabled' : ''}}>Ajukan TOR & RAB
    </button>
<?php } ?>
@endcan

<?php if ($final == "Validasi WD 3") { ?>
    <badge class="badge badge-info rounded" data-toggle="modal"> SELESAI
    </badge>
<?php }
if ($validasi < 3) { ?>
    <!-- <badge class="badge badge-info rounded" data-toggle="modal"> {{$validasi}}
    </badge> -->
<?php } ?>


<!-- <button class="badge badge-info" data-toggle="modal" data-placement="top" data-target="#detail_tor{{$tor[$t]->id}}">
    <i class="fa fa-tasks"></i>
</button> -->