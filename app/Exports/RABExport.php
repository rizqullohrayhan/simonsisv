<?php

namespace App\Exports;


use App\Models\Rab;
use App\Models\Anggaran;
use App\Models\Tor;
use App\Models\Unit;
use App\Models\Triwulan;
use App\Models\User;
use App\Models\SubKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class RABExport implements
    FromView,
    WithTitle,
    ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Rab::all();
    // }
    protected $ids;

    function __construct($ids)
    {
        $this->ids = $ids;
    }
    public function view(): View
    {
        $id = base64_decode($this->ids);;
        $tor = Tor::all();
        $judulTOR =  DB::table('tor')->select('nama_kegiatan')->where('id', $id)->get();
        $judulTOR2 = $judulTOR[0]->nama_kegiatan;
        $unit = Unit::all();
        $unit2 = Unit::all();
        $rab = DB::table('rab')->get();
        $userrole = User::join();
        $tw = Triwulan::all();
        $kelompok_mak = DB::table('kelompok_mak')->get();
        $belanja_mak = DB::table('belanja_mak')->get();
        $detail_mak = DB::table('detail_mak')->get();
        $indikator_ks = DB::table('indikator_k')->get();
        $indikator_subk = DB::table('indikator_subk')->get();
        $status = DB::table('status')->get();
        $roles = DB::table('roles')->get();
        $trx_status_tor = DB::table('trx_status_tor')->get();
        $tabeltahun = DB::table('tahun')->get();
        $pagu = DB::table('pagu')->get();
        $subkeg = DB::table('indikator_subK')->get();
        $kategori_subK =  SubKegiatan::Kategori_Sub();
        $komponen_jadwal = DB::table('komponen_jadwal')->get();
        $indikator_iku = DB::table('indikator_iku')->get();
        $users = DB::table('users')->get();
        $anggaran = DB::table('anggaran')->get();
        $rab_ang = Anggaran::Rab_Ang();
        $tabelRole =  Role::all();
        $data = [
            'tor' => $tor, 'rab' => $rab, 'unit' => $unit, 'unit2' => $unit2, 'tw' => $tw, 'userrole' => $userrole,
            'kelompok_mak' => $kelompok_mak, 'belanja_mak' => $belanja_mak, 'detail_mak' => $detail_mak,
            'indikator_ks' => $indikator_ks, 'indikator_subk' => $indikator_subk,
            'status' => $status, 'tabeltahun' => $tabeltahun, 'pagu' => $pagu, 'subkeg' => $subkeg,
            'kategori_subK' => $kategori_subK, 'komponen_jadwal' => $komponen_jadwal, 'users' => $users,
            'indikator_iku' => $indikator_iku, 'id' => $id, 'trx_status_tor' => $trx_status_tor, 'roles' => $roles,
            'anggaran' => $anggaran, 'subkeg' => $subkeg,  'rab_ang' => $rab_ang, 'detail_mak' => $detail_mak,
            'tabelRole' => $tabelRole, 'id' => $id
        ];
        return view('perencanaan.validasi.printRABExcel', $data);
    }
    public function registerEvents(): array

    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {

                $event->sheet->getDelegate()->getRowDimension('6', '7', '8', '9', '12', '14', '16', '32')
                    ->setRowHeight(200);

                // $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(50);
                $event->sheet->getDelegate()->getStyle('A13:A15', 'J6:J8', 'J10:J11')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // Set border for range
                $event->sheet->setAllBorders('thin');

                $event->sheet->getStyle('A13:A15')->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ]
                ]);
                // Set auto size for sheet
                $event->sheet->setAutoSize(true);
            },


        ];
    }
    public function title(): string
    {
        return "RAB";
    }
}
