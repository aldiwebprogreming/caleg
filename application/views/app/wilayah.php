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
          <h3 class="box-title">  <i class="fa fa-map"></i> Data Wilayah Pemungutan Suara Anda</h3>

        </div>
        <div class="box-body">
          <hr>



          <div class="box-body">
            <div class="table-responsive">
             <?php foreach ($wilayah as $data) {
              $kec = $this->db->get_where('tbl_kecamatan', ['id' => $data['wilayah']])->row_array();

              ?>

              <h5 class="text-primary"><i class="fa fa-map-marker"></i> KECAMATAN <?= $kec['name'] ?></h5>

              <?php 
              $kel = $this->db->get_where('tbl_kelurahan', ['district_id' => $kec['id']])->result_array();

              ?>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Kel/Desa</th>
                    <th scope="col">Luas Wilayah</th>
                    <th scope="col">Jml Penduduk</th>
                    <th scope="col">Jml Pemilih Tetap</th>
                    <th scope="col">Jml Pemilih Anda</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1; 
                  $luas = 0;
                  $penduduk = 0;
                  $pemilih = 0;
                  ?>

                  <?php  foreach ($kel as $key ) {  ?>
                    <tr>
                      <th scope="row"><?= $no++ ?></th>
                      <td><?php  echo $key['name']; ?></td>
                      <?php 
                      $detail = $this->db->get_where('tbl_detail_wilayah', ['id_kel' => $key['id']])->row_array();
                      ?>
                      <td>
                       <?= $detail['luas_wilayah'] ?> KM2

                     </td>
                     <td><?= $detail['jml_penduduk'] ?> - jiwa</td>
                     <td><?= $detail['jml_ktp'] ?></td>
                     <td>
                      <?php 
                      $id_kel = $key['id'];
                      $kode_caleg = $this->session->kode;
                      $this->db->where('kel', $id_kel);
                      $this->db->where('kode_caleg', $kode_caleg);
                      $jml = $this->db->get('tbl_pemilih')->num_rows();
                      echo "<b>". $jml. " Pemilih </br>";
                      ?>
                    </td>
                    <td>
                      <a href="<?= base_url('app/detail_pemilih?kel=') ?><?= $key['id'] ?>" class="btn btn-info btn-small"><i class="fa fa-users"></i> Detail Pemilih Anda</a>
                    </td>
                  </tr>
                  <?php 
                  $luas = $detail['luas_wilayah'] + $luas;
                  $penduduk = $detail['jml_penduduk'] + $penduduk;
                  $pemilih = $detail['jml_ktp'] + $pemilih;
                  ?>
                <?php } ?>

              </tbody>
              <thead>
                <tr style="background-color: red; color: white;">
                  <th scope="" colspan="2">Total</th>
                  <th scope="col"><?= $luas ?> KM2</th>
                  <th scope="col"><?= $penduduk ?> - Jiwa</th>
                  <th scope="col"><?= $pemilih ?></th>
                  <th scope="col">-</th>
                  <th scope="col">-</th>
                </tr>
              </thead>
            </table> 
          <?php } ?>




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