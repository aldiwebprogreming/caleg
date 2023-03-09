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
          <h3 class="box-title">  <i class="fa fa-users"></i> Data Caleg</h3>

        </div>
        <div class="box-body">
          <hr>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah Caleg
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i> Form Tambah Caleg</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="<?= base_url('app/act_addCaleg') ?>">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kode</label>
                      <input name="kode" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?= $kode ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="text" name="nama" class="form-control" required>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">No Urut</label>
                      <input type="number" name="no_urut" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Dapil</label>
                      <select class="form-control" name="dapil" required>
                        <option disabled>-- Pilih Dapil --</option>
                        <?php 
                        foreach ($dapil as $data) {
                         ?>
                         <option value="<?= $data['Kode'] ?>"><?= $data['dapil'] ?></option>
                       <?php } ?>
                     </select>
                   </div>


                   <div class="form-group">
                    <label for="exampleInputEmail1">Foto</label>
                    <input type="file" name="foto" class="form-control">
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
                  <th>No Urut</th>
                  <th>Dapil</th>
                  <th>Foto</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach($caleg as $data){ ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['no_urut'] ?></td>
                    <td><?= $data['dapil'] ?></td>
                    <td><?= $data['foto'] ?></td>

                    <td>


                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModaledit<?= $data['id'] ?>"><i class="fa fa-pen"></i></button>

                      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalhapus<?= $data['id'] ?>"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="exampleModaledit<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Data Caleg</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <form method="post" action="<?= base_url('app/act_editCaleg') ?>">

                          <input type="hidden" name="id" value="<?= $data['id'] ?>">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>">
                          </div>


                          <div class="form-group">
                            <label for="exampleInputEmail1">No Urut</label>
                            <input type="number" name="no_urut" class="form-control" value="<?= $data['no_urut'] ?>">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Dapil</label>
                            <select class="form-control" name="dapil">
                              <?php 
                              $da = $this->db->get_where('tbl_dapil', ['Kode' => $data['dapil']])->row_array();
                              ?>
                              <option><?= $da['dapil'] ?></option>
                              <option disabled>-- Pilih Dapil --</option>
                              <?php 
                              foreach ($dapil as $data1) {
                                ?>
                                <option value="<?= $data1['Kode'] ?>"><?= $data1['dapil'] ?></option>
                              <?php } ?>
                            </select>
                          </div>


                          <div class="form-group">
                            <label for="exampleInputEmail1">Foto</label>
                            <input type="file" name="foto" class="form-control">
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
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Caleg</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <h4>Apakah anda ingin menghapus data ini ? </h4>
                        <form method="post" action="<?= base_url('app/act_hapusCaleg') ?>">
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
               <th>Kode</th>
               <th>Dapil</th>
               <th>Map</th>
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