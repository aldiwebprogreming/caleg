<style>
  td{
    font-weight: normal;
  }
</style>
<!-- Main content -->
<section class="content">


  <div class="row">
    <div class="col-md-12">

      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">  <i class="fa fa-user"></i> Data Relawan</h3>

        </div>
        <div class="box-body">
          <hr>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah Relawan
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i> Form Tambah Relawan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="<?= base_url('app/act_addRelawan') ?>">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Relawan</label>
                      <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kecamatan</label>
                      <select class="form-control" name="kec" id="kec_relawan">
                        <option value="">-- Pilih Kecamatan --</option>
                        <?php 
                        foreach ($kec as $va) {

                          $list = $this->db->get_where('tbl_kecamatan', ['id' => $va['wilayah']])->row_array(); ?>
                          <option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
                        <?php }?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kelurahan</label>
                      <select class="form-control" name="kel" id="kel_relawan">
                        <option disabled>-- Pilih Kelurahan --</option>
                      </select>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <textarea class="form-control" name="alamat" required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">NO NIK</label>
                      <input type="number" name="nik" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Kelamin</label>
                      <select class="form-control" name="jk">
                        <option disabled>-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">NO Telp</label>
                      <input type="number" name="no_telp" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                      <select class="form-control" name="pendidikan">
                        <option disabled>-- Pilih Pendidikan Terakhir --</option>
                        <option>SMA</option>
                        <option>S1</option>
                        <option>S2</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Foto Relawan</label>
                      <input type="file" name="foto" class="form-control">
                    </div>




                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Data</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>



        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Kec</th>
                  <th>Kel</th>
                  
                  <th>Alamat</th>
                  <th>Nik</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach($relawan as $data){ ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td>
                      <?php 
                      $kecamatan = $this->db->get_where('tbl_kecamatan',['id' => $data['kec']])->row_array();
                      echo $kecamatan['name']
                      ?>
                    </td>
                    <td>
                      <?php 
                      $kelurahan = $this->db->get_where('tbl_kelurahan',['id' => $data['kel']])->row_array();
                      echo $kelurahan['name']
                      ?>
                    </td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['nik'] ?></td>
                    <td>
                      <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModaldetail<?= $data['id'] ?>"><i class="fa fa-eye"></i></button>
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModaledit<?= $data['id'] ?>"><i class="fa fa-pen"></i></button>

                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalhapus<?= $data['id'] ?>"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>

                  <!-- Modal Detail -->
                  <div class="modal fade" id="exampleModaldetail<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Detail Data Relawan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <?php 
                          $kecamatan = $this->db->get_where('tbl_kecamatan',['id' => $data['kec']])->row_array();
                          $kelurahan = $this->db->get_where('tbl_kelurahan',['id' => $data['kel']])->row_array();

                          ?>
                          <label>Nama :</label>
                          <h5><?= $data['nama'] ?></h5>
                          <hr>
                          <label>Kec :</label>
                          <h5><?= $kecamatan['name'] ?></h5>
                          <hr>
                          <label>Kel :</label>
                          <h5><?= $kelurahan['name'] ?></h5>
                          <hr>
                          <label>Alamat :</label>
                          <h5><?= $data['alamat'] ?></h5>
                          <hr>
                          <label>JK :</label>
                          <h5><?= $data['jk'] ?></h5>
                          <hr>
                          <label>NIK :</label>
                          <h5><?= $data['nik'] ?></h5>
                          <hr>
                          <label>No Telp :</label>
                          <h5><?= $data['no_telp'] ?></h5>
                          <hr>
                          <label>Foto :</label>
                          <h5><?= $data['foto'] ?></h5>
                          <hr>
                          <label>Date :</label>
                          <h5><?= $data['date'] ?></h5>
                          <hr>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- End Modal Detail -->


                  <!-- Modal Edit -->
                  <div class="modal fade" id="exampleModaledit<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Data Relawan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <form method="post" action="<?= base_url('app/act_editRelawan') ?>">
                          <input type="hidden" name="id" value="<?= $data['id'] ?>">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nama Relawan</label>
                            <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?= $data['nama'] ?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Kecamatan</label>
                            <select class="form-control" name="kec" id="kec_relawanedit">
                              <?php 
                              $kecamatan = $this->db->get_where('tbl_kecamatan',['id' => $data['kec']])->row_array();
                              ?>
                              <option value="<?= $kecamatan['id'] ?>"><?= $kecamatan['name'] ?></option>
                              <option value="">-- Pilih Kecamatan --</option>
                              <?php 
                              foreach ($kec as $va) {

                                $list = $this->db->get_where('tbl_kecamatan', ['id' => $va['wilayah']])->row_array(); ?>
                                <option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
                              <?php }?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Kelurahan</label>
                            <select class="form-control" name="kel" id="kel_relawanedit">
                              <?php 
                              $kelurahan = $this->db->get_where('tbl_kelurahan', ['id' => $data['kel']])->row_array();
                              ?>
                              <option value="<?= $kelurahan['id'] ?>"><?= $kelurahan['name'] ?></option>
                              <option disabled>-- Pilih Kelurahan --</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <textarea class="form-control" name="alamat" required><?= $data['alamat'] ?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">NO NIK</label>
                            <input type="number" name="nik" class="form-control" value="<?= $data['nik'] ?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <select class="form-control" name="jk">
                              <option><?= $data['jk'] ?></option>
                              <option disabled>-- Pilih Jenis Kelamin --</option>
                              <option>Laki - Laki</option>
                              <option>Perempuan</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">NO Telp</label>
                            <input type="number" value="<?= $data['no_telp'] ?>" name="no_telp" class="form-control">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                            <select class="form-control" name="pendidikan">
                              <option><?= $data['pendidikan_terakhir'] ?></option>
                              <option disabled>-- Pilih Pendidikan Terakhir --</option>
                              <option>SMA</option>
                              <option>S1</option>
                              <option>S2</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Foto Relawan</label>
                            <input type="file" name="foto" class="form-control">
                          </div>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- End Modal Edit -->

                <!-- Modal Hapus -->
                <div class="modal fade" id="exampleModalhapus<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Relawan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <h4>Apakah anda ingin menghapus data ini ? </h4>
                        <form method="post" action="<?= base_url('app/act_hapusRelawan') ?>">
                          <input type="hidden" name="id" value="<?= $data['id'] ?>">


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- End Modal Edit -->



              <?php } ?>


            </tbody>
            <tfoot>
              <tr>
               <th>No</th>
               <th>Nama</th>
               <th>Kec</th>
               <th>Kel</th>
               
               <th>Alamat</th>
               <th>Nik</th>
               <th>Opsi</th>
             </tr>
           </tfoot>
         </table>
       </div>
     </div>

   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->



</div>
</div>


</section>
<!-- /.content -->
</div>