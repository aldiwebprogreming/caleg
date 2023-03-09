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
          <h3 class="box-title">  <i class="fa fa-users"></i> Data Pemilih Anda</h3>

        </div>
        <div class="box-body">
          <hr>
          <!-- Button trigger modal -->


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
                  <?php foreach($pemilih as $data){ ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $data['nama_pemilih'] ?></td>
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
                      <td><?= $data['alamat_lengkap'] ?></td>
                      <td><?= $data['nik'] ?></td>
                      <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModaldetail<?= $data['id'] ?>"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModaledit<?= $data['id'] ?>"><i class="fa fa-pen"></i></button>

                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalhapus<?= $data['id'] ?>"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    
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