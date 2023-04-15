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
          <h3 class="box-title">  <i class="fa fa-users"></i> Data Hasil Akhir Suara</h3>

        </div>
        <div class="box-body">
          <hr>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
           Tambah Bukti Suara
         </button>

       <!--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalgrafig">
            Grafik Pemilih
          </button> -->


          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i> Form Tambah Data Pemilih Anda</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="<?= base_url('saksi/act_tambah_suara') ?>" enctype="multipart/form-data">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah Seluarah Suara</label>
                      <input name="jml_suara" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputEmail1">Bukti Suara</label>
                      <input type="file" name="bukti" class="form-control">
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
                  <th>Jml Suara</th>
                  <th>Bukti</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach($suara as $data){ ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['jml_suara'] ?></td>
                    <td>
                      <a target="_blank" href="<?= base_url('assets/berkassaksi/') ?><?= $data['bukti'] ?>">
                        <img src="<?= base_url('assets/berkassaksi/') ?><?= $data['bukti'] ?>" class="img-fluid" alt="Responsive image" style="height: 100px;">
                      </a>
                    </td>
                    <td>
                      <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModaldetail<?= $data['id'] ?>"><i class="fa fa-eye"></i></button>
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModaledit<?= $data['id'] ?>"><i class="fa fa-pen"></i></button>

                      <!--   <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalhapus<?= $data['id'] ?>"><i class="fa fa-trash"></i></button> -->
                    </td>
                  </tr>


                <?php } ?>


              </tbody>
              <tfoot>
                <tr>
                 <th>No</th>
                 <th>Jml Suara</th>
                 <th>Bukti</th>
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