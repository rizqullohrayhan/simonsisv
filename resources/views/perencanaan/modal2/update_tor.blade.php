 <!-- Modal Tambah TOR -->
 <div class="modal fade bd-example-modal-lg show" tabindex="-1" role="dialog" id="update_tor<?= $tor[$t]->id ?>">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Tambah TOR - <?= Auth()->user()->id_unit ?></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal" method="post" action="{{ url('/tor/update/'.$tor[$t]->id) }}">
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
                                 <option value="{{old('id_unit',$unit->id)}}">{{$unit->nama_unit}}</option>
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
                         <label>Kode Sub Kegiatan</label>
                         <select name="id_subK" id="id_subK" class="form-control">
                             <option value="1">K01-01</option>
                             <option value="1">K01-02</option>
                             <option value="1">K01-03</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label>Nama Kegiatan</label>
                         <input name="nama_kegiatan" value="{{old('nama_kegiatan',$tor[$t]->nama_kegiatan)}}" id="nama_kegiatan" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Latar Belakang</label>
                         <input name="latar_belakang" value="{{old('latar_belakang',$tor[$t]->latar_belakang)}}" id="latar_belakang" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Rasionalisasi</label>
                         <input name="rasionalisasi" value="{{old('rasionalisasi',$tor[$t]->rasionalisasi)}}" id="rasionalisasi" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Tujuan</label>
                         <input name="tujuan" value="{{old('tujuan',$tor[$t]->tujuan)}}" id="tujuan" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>mekanisme</label>
                         <input name="mekanisme" value="{{old('mekanisme',$tor[$t]->mekanisme)}}" id="mekanisme" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>keberlanjutan</label>
                         <input name="keberlanjutan" value="{{old('keberlanjutan',$tor[$t]->keberlanjutan)}}" id="keberlanjutan" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Nama PIC Kegiatan</label>
                         <input name="nama_pic" value="{{old('nama_pic',$tor[$t]->nama_pic)}}" id="nama_pic" type="text" class="form-control" value="">
                     </div>
                     <div class="form-group">
                         <label>Email PIC Kegiatan</label>
                         <input name="email_pic" value="{{old('email_pic',$tor[$t]->email_pic)}}" id="email_pic" type="text" class="form-control" value="">
                     </div>
                     <div class="form-group">
                         <label>Kontak PIC Kegiatan</label>
                         <input name="kontak_pic" value="{{old('kontak_pic',$tor[$t]->kontak_pic)}}" id="kontak_pic" type="text" class="form-control" value="">
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
                         <input name="jumlah_anggaran" value="{{old('jumlah_anggaran',$tor[$t]->nama_kegiatan)}}" id="jumlah_anggaran" value="" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Rencana Penarikan Dana</label>
                         <select name="id_tw" id="id_tw" class="form-control">
                             <?php for ($t2 = 0; $t2 < count($tw2); $t2++) { ?>
                                 <option value="1"><?= $tw2[$t2]->triwulan ?></option>
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