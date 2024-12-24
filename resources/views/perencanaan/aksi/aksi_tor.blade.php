@php
    $buttonVerif = collect($komponen_jadwal)->contains('id_tor', $tItem->id) ? 'Ada' : 'Tidak';

    $statusNames = [];
    $creators = [];
    $pengajuan = 0;
    $pengajuanPerbaikan = 0;
    $final = '';
    $detail = 'Lengkapi Data';
    $jumlahval = 0;

    foreach ($trx_status_tor as $trx_item) {
        if ($trx_item->id_tor == $tItem->id) {
            $jumlahval++;
            foreach ($status as $status_item) {
                if ($trx_item->id_status == $status_item->id) {
                    foreach ($user as $user_item) {
                        if ($trx_item->create_by == $user_item->id) {
                            foreach ($role as $role_item) {
                                if ($user_item->role == $role_item->id) {
                                    $statusNames[] = $status_item->nama_status;
                                    $creators[] = $trx_item->role_by;
                                    if ($status_item->nama_status == 'Belum Dinilai') {
                                        $pengajuan++;
                                        $detail = 'Detail';
                                    }
                                    if ($status_item->nama_status == 'Revisi') {
                                        $pengajuan++;
                                        $detail = 'Detail';
                                    }
                                    if ($status_item->nama_status == 'Sudah Disetujui') {
                                        $final = 'Sudah Disetujui';
                                    }
                                    if ($status_item->nama_status == 'Sudah Revisi') {
                                        $pengajuanPerbaikan++;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    $revisi = collect($statusNames)->filter(function ($name) {
        return $name === 'Revisi';
    })->count();
    $perbaikan = collect($statusNames)->filter(function ($name) {
        return $name === 'Sudah Revisi';
    })->count();

    $RoleLogin = Auth::user()->role;
@endphp

<a href="{{ url('/lengkapitor/' . base64_encode($tItem->id)) }}">
    <button class="badge {{ $detail == 'Lengkapi Data' ? 'badge-danger' : 'badge-warning' }} rounded">{{ $detail }}</button>
</a>

@php
    $currentStatus = '';
    foreach ($trx_status_tor as $trx_item) {
        if ($trx_item->id_tor == $tItem->id) {
            foreach ($status as $status_item) {
                if ($status_item->id == $trx_item->id_status) {
                    $currentStatus = $status_item->nama_status;
                    foreach ($user as $user_item) {
                        $currentStatusRole =  $trx_item->role_by;
                    }
                }
            }
        }
    }
@endphp

@if ($pengajuan == 0 && ($tItem->id_unit == Auth::user()->id_unit || $RoleLogin == 'Prodi' || $RoleLogin == 'Admin'))
    @can('tor_update')
        <a href="{{ url('/tor/update/' . base64_encode($tItem->id)) }}" data-toggle="tooltip" title="Update">
            <button class="badge badge-primary rounded">
                <i class="fa fa-edit"></i>
            </button>
        </a>
    @endcan
    @can('tor_delete')
        <a href="{{ url('/tor/delete/' . base64_encode($tItem->id)) }}" class="button tor-confirm" data-toggle="tooltip" title="Delete">
            <button class="badge badge-primary rounded">
                <i class="fa fa-trash"></i>
            </button>
        </a>
    @endcan

    @php
        $sudahAdaRAB = collect($rab)->contains('id_tor', $tItem->id) ? 1 : 0;
    @endphp

    @can('rab_create')
        @if ($sudahAdaRAB == 0)
            <button class="search-toggle iq-waves-effect badge badge-info rounded" data-toggle="modal"
                    title="Tambah RAB" data-original-title="Tambah RAB" data-target="#tambah_rab{{ $tItem->id }}">Tambah
                RAB<br/></button>
        @endif
    @endcan

    @can('tor_ajuan')
        @php
            $buttonAjukan = 1;
        @endphp
        @foreach ($rab as $sr)
            @if ($sr->id_tor == $tItem->id)
                @foreach ($anggaran as $anggaran1)
                    @if ($anggaran1->id_rab == $sr->id && $buttonAjukan == 1)
                        <button class="badge badge-danger rounded" data-toggle="modal"
                                data-target="#ajukan{{ $tItem->id }}"
                                {{ $buttonVerif == 'Tidak' ? 'disabled' : '' }}>Ajukan TOR & RAB</button>
                        @php
                            $buttonAjukan += 1;
                        @endphp
                    @endif
                @endforeach
            @endif
        @endforeach
    @endcan
@endif

@if ($pengajuan >= 1)
    <button class="badge badge-success rounded" data-toggle="modal" data-target="#status{{ $tItem->id }}">Status</button>
@endif

@if ($currentStatus == 'Revisi')
    <form class="form-horizontal" method="get" action="{{ url('/tor/revisi/' . base64_encode($tItem->id)) }}">
        @csrf
        <input type="hidden" name="akses" value="1">
        <button class="badge badge-danger rounded" type="submit">Segera Revisi</button>
    </form>
@endif

@can('tor_ajuan')
    @if ($tItem->jenis_ajuan == 'Perbaikan' && $perbaikan < $revisi)
        <button class="badge badge-danger rounded" data-toggle="modal"
                data-target="#ajukan{{ $tItem->id }}"
                {{ $buttonVerif == 'Tidak' ? 'disabled' : '' }}>Ajukan TOR & RAB</button>
    @endif
@endcan

@if ($final == 'Sudah Disetujui')
    <badge class="badge badge-info rounded" data-toggle="modal"> SELESAI</badge>
    <a href="{{url('exportPdf/' . base64_encode($tItem->id) )}}" class="badge badge-info rounded" target="_blank"> Print</a>
@endif
