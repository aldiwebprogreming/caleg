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
          <h3 class="box-title">  <i class="fa fa-users"></i> Data User Caleg</h3>

        </div>
        <div class="box-body">
          <hr>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah user caleg
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
                  <form method="post" action="<?= base_url('app/act_addusercaleg') ?>">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kode</label>
                      <select class="form-control" name="kode">
                        <option disabled>-- Pilih caleg --</option>
                        <?php foreach($caleg as $kd){ ?>
                          <option value="<?= $kd['kode'] ?>"><?= $kd['nama'] ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" name="username" class="form-control" required>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" name="pass" class="form-control" required>
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
                    <th>Kode</th>
                    <th>Username</th>
                    <th>Dapil</th>
                    <th>Pass</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1 ?>
                  <?php foreach($usercaleg as $data){ ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $data['kode_caleg'] ?></td>
                      <td><?= $data['username'] ?></td>
                      <td>
                        <?php 
                        $dapil = $this->db->get_where('tbl_caleg', ['kode' => $data['kode_caleg']])->row_array();
                        echo $dapil['dapil']
                        ?>
                      </td>
                      <td><?= $data['pass'] ?></td>

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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data User Caleg</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                           <form method="post" action="<?= base_url('app/act_edituserCaleg') ?>">

                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Kode</label>
                              <input type="text" name="nama" class="form-control" value="<?= $data['kode_caleg'] ?>" required>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Username</label>
                              <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
                            </div>


                            <div class="form-group">
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" name="pass" class="form-control" required>
                            </div>


                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save Edit</button>
                            </div>
                          </form>
                        </div>
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
                          <form method="post" action="<?= base_url('app/hapus_usercaleg') ?>">
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
                 <th>Username</th>
                 <th>Dapil</th>
                 <th>Pass</th>
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