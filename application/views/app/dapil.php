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
          <h3 class="box-title">  <i class="fa fa-users"></i> Data Dapil</h3>

        </div>
        <div class="box-body">
          <hr>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah Dapil
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i> Form Tambah Dapil</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="<?= base_url('app/act_addDapil') ?>">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kode Dapil</label>
                      <input name="kode" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Dapil</label>
                      <input type="text" name="dapil" class="form-control">
                    </div>


                    <div class="form-group">


                    </div>
                    <label for="exampleInputEmail1">Wilayah</label>

                    <?php foreach($kec as $list){ ?>

                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="wilayah[]" type="checkbox" id="inlineCheckbox1" value="<?= $list['id'] ?>">
                        <label class="form-check-label" for="inlineCheckbox1"><?= $list['name'] ?></label>
                      </div>

                    <?php } ?>

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
                  <th>Dapil</th>
                  <th>Wilayah</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach($dapil as $data){ ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['Kode'] ?></td>
                    <td><?= $data['dapil'] ?></td>
                    <td>
                      <?php 
                      $wilayah = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $data['Kode']])->result_array();
                      foreach ($wilayah as $val) {
                       $name = $this->db->get_where('tbl_kecamatan', ['id' => $val['wilayah']])->row_array();
                       echo $name['name']. "<br>";
                     }
                     ?>
                   </td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Dapil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <form method="post" action="<?= base_url('app/act_editdapil') ?>">

                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <input type="hidden" name="kode2" value="<?= $data['Kode'] ?>">

                        <div class="form-group">
                          <label for="exampleInputEmail1">Kode Dapil</label>
                          <input name="kode" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?= $data['Kode'] ?>">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Dapil</label>
                          <input type="text" name="dapil" class="form-control" value="<?= $data['dapil'] ?>">
                        </div>

                        <label for="exampleInputEmail1">Wilayah</label>

                        <?php foreach($kec as $list){ ?>

                          <?php 
                          $this->db->where('kode_dapil', $data['Kode']);
                          $this->db->where('wilayah', $list['id']);
                          $cek = $this->db->get('tbl_wilayah_dapil')->row_array();

                          if ($cek == true) {
                            $checked = 'checked';
                          }else{
                            $checked = '';
                          }


                          ?>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" <?= $checked ?> name="wilayah[]" type="checkbox" id="inlineCheckbox1" value="<?= $list['id'] ?>">
                            <label class="form-check-label" for="inlineCheckbox1"><?= $list['name'] ?></label>
                          </div>
                        <?php  } ?>

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
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Dapil</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                      <h4>Apakah anda ingin menghapus data ini ? </h4>
                      <form method="post" action="<?= base_url('app/act_hapusDapil') ?>">
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