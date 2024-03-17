 <div class="modal fade" tabindex="-1" role="dialog" id="update_pedoman<?= $pedomansbm->id ?>">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Ubah Pedoman {{ $pedomansbm->jenis }}</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ url('/pedomans/update/' . $pedomansbm->id) }}">
                     @csrf
                     <div class="form-group">
                         <label>Jenis</label>
                         <div class="">
                             <!-- <input type="radio" name="jenis" id="jenis" value="{{ $pedomansbm->jenis }}" checked>
                             <label class="">
                                 {{ $pedomansbm->jenis }}</label> -->
                             <div id="sbm2">
                                 <input type="radio" name="jenis" class="btn-check" id="sbm2" value="SBM" autocomplete="off">
                                 <label>Standar Biaya
                                     Masukan</label>
                             </div>
                             <div id="torrab2">
                                 <input type="radio" name="jenis" class="btn-check" id="torrab2" value="TorRab" autocomplete="off">
                                 <label>Template TOR & RAB</label>
                             </div>
                             <div id="spj2"><input type="radio" name="jenis" class="btn-check" id="spj2" value="SPJ" autocomplete="off">
                                 <label>SPJ</label>
                             </div>
                             <div id="lpj2">
                                 <input type="radio" name="jenis" class="btn-check" id="lpj2" value="LPJ" autocomplete="off">
                                 <label>LPJ</label>
                             </div>
                         </div>
                     </div>
                     <div id="list2" class="form-group">
                         <label>Kategori File SPJ</label>
                         <select name="jenis" class="form-control">
                             <option selected="" disabled="">Pilih Kategori</option>
                             <option value="SPJ Dasar Hukum">Dasar Hukum</option>
                             <option value="SPJ Panduan">Panduan</option>
                             <option value="SPJ Template">Template</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label>Nama File</label>
                         <input name="nama" value="{{ old('nama', $pedomansbm->nama) }}" id="nama" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>Tahun File</label>
                         <input name="tahun" value="{{ old('tahun', $pedomansbm->tahun) }}" id="tahun" type="text" class="form-control">
                     </div>
                     <div class="form-group">
                         <label>File</label>
                         <input type="file" class="form-control-file" name="file" id="file" value="{{ old('file') }}">
                         <small>File yang sudah diupload:
                             <a class="text-primary" href="{{ asset('pedoman/' . $pedomansbm->file) }}" target="_blank"><?= $pedomansbm->file ?></a>
                         </small>

                     </div>
                     <input name="created_at" id="created_at" type="hidden" value="<?= date('Y-m-d') ?>">
                     <input name="updated_at" id="updated_at" type="hidden" value="<?= date('Y-m-d') ?>">
                     <div class="modal-footer">
                         <button class="btn btn-primary" type="submit">Update</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 {{-- Dropdown on Click Radio Button --}}
 <script>
     const lpj2 = document.getElementById("lpj2");
     const spj2 = document.getElementById("spj2");
     const sbm2 = document.getElementById("sbm2");
     const list2 = document.getElementById("list2");
     list2.style.display = "none";
     spj2.addEventListener("click", (event) => {
         if (list2.style.display = "none") {
             list2.style.display = "block";
         } else {
             list2.style.display = "none";
         }
     })
     lpj2.addEventListener("click", (event) => {
         list2.style.display = "none";
     })
     sbm2.addEventListener("click", (event) => {
         list2.style.display = "none";
     })
 </script>