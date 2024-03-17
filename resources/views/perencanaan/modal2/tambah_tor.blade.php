 <!-- Modal Tambah TOR -->
 <div class="modal fade bd-example-modal-lg show" tabindex="-1" role="dialog" id="tambahtor<?= Auth()->user()->id_unit ?>">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Tambah TOR - <?= Auth()->user()->id_unit ?></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal" method="post" action="{{ url('/tor/create') }}">
                     @csrf
                     <div class="form-group">
                         <label>Jenis Ajuan</label><br />
                         <input type="radio" class="btn-check" name="jenis_ajuan" id="jenis_ajuan" value="Baru" autocomplete="off" checked>
                         <label class="" for="success-outlined">Baru</label>

                         <input type="radio" class="btn-check" name="jenis_ajuan" id="jenis_ajuan" value="Perbaikan" autocomplete=" off">
                         <label class="" for="danger-outlined">Perbaikan</label>
                     </div>
                     <div class="form-group">
                         <label>Prodi</label>
                         <?php if (Auth()->user()->role != 2) { ?>
                             <select name="id_unit" id="id_unit" class="form-control">
                                 @foreach($unit as $unit)
                                 <option value="{{$unit->id}}">{{$unit->nama_unit}}</option>
                                 @endforeach
                             </select>
                         <?php } ?>
                         <?php if (Auth()->user()->role == 2) { ?>
                             <select name="id_unit" id="id_unit" class="form-control">
                                 <?php for ($u2 = 0; $u2 < count($unit); $u2++) {
                                        if ($unit[$u2]->id == Auth()->user()->id_unit) { ?>
                                         <option value="{{$unit[$u2]->id}}">{{$unit[$u2]->nama_unit}}</option>
                                 <?php }
                                    } ?>
                             </select>
                         <?php } ?>
                     </div>
                     <div class="form-group">
                         <label>Kode Peningkatan</label>
                         <select name="id_p" class="form-control">
                             <?php for ($s = 0; $s < count($indikator_p); $s++) { ?>
                                 <option value="<?= $indikator_p[$s]->id ?>"><?= $indikator_p[$s]->P . " - " . substr($indikator_p[$s]->deskripsi, 0, 100) ?></option>
                             <?php } ?>
                         </select>
                     </div>
                     <div class="form-group">
                         <label>Nama Kegiatan</label>
                         <input name="nama_kegiatan" id="nama_kegiatan" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Latar Belakang</label>
                         <textarea class="form-control" id="latar_belakang" name="latar_belakang" rows="2"></textarea>
                     </div>
                     <div class="form-group">
                         <label>Rasionalisasi</label>
                         <textarea class="form-control" id="rasionalisasi" name="rasionalisasi" rows="2"></textarea>
                     </div>
                     <div class="form-group">
                         <label>Tujuan</label>
                         <textarea class="form-control" id="tujuan" name="tujuan" rows="2"></textarea>
                     </div>
                     <div class="form-group">
                         <label>mekanisme</label>
                         <textarea class="form-control" id="mekanisme" name="mekanisme" rows="2"></textarea>
                     </div>
                     <div class="form-group">
                         <label>keberlanjutan</label>
                         <textarea class="form-control" id="keberlanjutan" name="keberlanjutan" rows="2"></textarea>
                     </div>
                     <div class="form-group">
                         <label>Nama PIC Kegiatan</label>
                         <input name="nama_pic" id="nama_pic" type="text" class="form-control" value="">
                     </div>
                     <div class="form-group">
                         <label>Email PIC Kegiatan</label>
                         <input name="email_pic" id="email_pic" type="text" class="form-control" value="">
                     </div>
                     <div class="form-group">
                         <label>Kontak PIC Kegiatan</label>
                         <input name="kontak_pic" id="kontak_pic" type="text" class="form-control" value="">
                     </div>
                     <div class="form-group">
                         <label>Tanggal Mulai Pelaksanaan</label>
                         <input name="tgl_mulai_pelaksanaan" id="tgl_mulai_pelaksanaan" value="{{ old('tgl_pelaksanaan')}}" type="date" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Tanggal Selesai Pelaksanaan</label>
                         <input name="tgl_akhir_pelaksanaan" id="tgl_akhir_pelaksanaan" value="{{ old('tgl_pelaksanaan')}}" type="date" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Jumlah Anggaran</label>
                         <input name="jumlah_anggaran" id="jumlah_anggaran" value="" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Rencana Penarikan Dana</label>
                         <select name="id_tw" id="id_tw" class="form-control">
                             <?php for ($t2 = 0; $t2 < count($tw); $t2++) { ?>
                                 <option value="1"><?= $tw[$t2]->triwulan ?></option>
                             <?php } ?>
                         </select>
                     </div>
                     <!-- <div class="form-group">
                         <label for="exampleFormControlFile1">Unggah File : KAK dan RAB</label>
                         <input type="file" class="form-control-file" id="exampleFormControlFile1">
                     </div> -->
                     <button class="btn btn-primary mr-1" type="submit">Submit</button>
                 </form>
             </div>
         </div>
     </div>
 </div>