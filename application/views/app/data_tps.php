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
          <h3 class="box-title">  <i class="fa fa-users"></i> Data TPS</h3>

        </div>
        <div class="box-body">
          <hr>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah TPS
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i> Form Tambah TPS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="<?= base_url('app/act_addtps') ?>">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Dapil</label>
                      <select class="form-control" name="kode_dapil" id="dapil">
                        <option> -- Pilih Dapil --</option>
                        <?php foreach ($dapil as $data) { ?>
                          <option value="<?= $data['Kode'] ?>"><?= $data['dapil'] ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kec</label>
                      <select class="form-control" name="kec" id="kecdapil">
                        <option>-- Pilih Kecamatan --</option>
                      </select>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Kel / Desa</label>
                      <select class="form-control" name="kel" id="keldapil">
                        <option>-- Pilih Kelurahan --</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat TPS</label>
                      <textarea class="form-control" name="alamat" placeholder="Masukan alamat lengkap tps"></textarea>
                    </div>



                    <div class="form-group">
                      <label for="exampleInputEmail1">TPS</label>
                      <input type="text" name="tps" class="form-control" placeholder="Masukan nama TPS dan nomor TPS">
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
                  <th>Kec</th>
                  <th>Kel</th>
                  <th>Alamat</th>
                  <th>TPS</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach($tps as $data){ ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td>
                      <?php 
                      $kec = $this->db->get_where('tbl_kecamatan',['id' => $data['kec']])->row_array();
                      echo $kec['name'];
                      ?>
                    </td>
                    <td>
                     <?php 
                     $kel = $this->db->get_where('tbl_kelurahan',['id' => $data['kel']])->row_array();
                     echo $kel['name'];
                     ?>
                   </td>
                   <td><?= $data['alamat'] ?></td>
                   <td><?= $data['tps'] ?></td>
                   <td>


                     <!--  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModaledit<?= $data['id'] ?>"><i class="fa fa-pen"></i></button> -->

                     <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalhapus<?= $data['id'] ?>"><i class="fa fa-trash"></i></button>
                   </td>
                 </tr>

                 <!-- Modal Edit -->
                 <div class="modal fade" id="exampleModaledit<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Tps</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <form method="post" action="<?= base_url('app/act_editdapil') ?>">

                        <input type="hidden" name="id" value="<?= $data['id'] ?>">

                          <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Dapil</label>
                            <select class="form-control" name="kode_dapil" id="dapil">
                              <option> -- Pilih Dapil --</option>
                              <?php foreach ($dapil as $data2) { ?>
                                <option value="<?= $data['Kode'] ?>"><?= $data['dapil'] ?></option>
                              <?php } ?>
                            </select>
                          </div> -->

                          <div class="form-group">
                            <label for="exampleInputEmail1">Kec</label>
                            <select class="form-control" name="kec" id="kecdapil">
                              <option>-- Pilih Kecamatan --</option>
                            </select>
                          </div>


                          <div class="form-group">
                            <label for="exampleInputEmail1">Kel / Desa</label>
                            <select class="form-control" name="kel" id="keldapil">
                              <option><?= $data['kel'] ?></option>
                              <option>-- Pilih Kelurahan --</option>
                            </select>
                          </div>



                          <div class="form-group">
                            <label for="exampleInputEmail1">Alamat TPS</label>
                            <textarea class="form-control" name="alamat" placeholder="Masukan alamat lengkap tps"><?= $data['alamat'] ?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">TPS</label>
                            <input type="text" name="tps" class="form-control" placeholder="Masukan nama TPS dan nomor TPS" value="<?= $data['tps'] ?>">
                          </div>



                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save Edit</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Hapus TPS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <h4>Apakah anda ingin menghapus data ini ? </h4>
                        <form method="post" action="<?= base_url('app/act_hapustps') ?>">
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
               <th>Kec</th>
               <th>Kel</th>
               <th>Alamat</th>
               <th>Tps</th>
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