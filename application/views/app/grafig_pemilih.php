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
          <h3 class="box-title">  <i class="fa fa-chart-simple"></i> Grafik Pemilih</h3>

        </div>
        <div class="box-body">
          <hr>

          <div class="row">
            <?php foreach ($kec as $data) { ?>

              <?php 
              $name_kec = $this->db->get_where('tbl_kecamatan', ['id' => $data['wilayah']])->row_array();
              ?>
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text text-info"><?= $name_kec['name'] ?></span>
                    <span class="info-box-number">
                      <?php 
                      $pemilih = 0;
                      $kel = $this->db->get_where('tbl_kelurahan', ['district_id' => $name_kec['id']])->result_array();
                      foreach ($kel as $value) {
                        $detail = $this->db->get_where('tbl_detail_wilayah', ['id_kel' => $value['id']])->row_array();
                        $pemilih = $detail['jml_ktp'] + $pemilih;
                      }
                      ?>
                      <?= $pemilih ?>
                      <small class="text-success">DPT</small>

                      <?php 
                      $jmlp = $this->db->get_where('tbl_pemilih',['kec' => $name_kec['id']])->num_rows();
                      ?>
                      <h6 class="text-danger" style="font-weight:bold;"><?= $jmlp ?> Pemilih Anda</h6>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            <?php } ?>
          </div>

          <div class="box-body">
            <?php foreach ($kec as $data) { ?>

              <?php 
              $name_kec = $this->db->get_where('tbl_kecamatan', ['id' => $data['wilayah']])->row_array();
              ?>
              <div class="card">
                <h4 class="text-info"><?= $name_kec['name'] ?></h4>
                <canvas id="myChart<?= $data['id'] ?>"></canvas>
              </div>
              <script type="text/javascript" src="<?= base_url('assets/') ?>chartjs/Chart.js"></script>

              <script>
                var ctx = document.getElementById("myChart<?= $data['id'] ?>").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {

                    labels: [
                    <?php $kel = $this->db->get_where('tbl_kelurahan', ['district_id' => $name_kec['id']])->  result_array(); 
                    foreach ($kel as $name_kel) {
                      ?>
                      "<?= strtolower($name_kel['name']) ?>",
                    <?php } ?>

                    ],

                    datasets: [{
                      label: '# of Votes',
                      data: [
                      <?php $kel = $this->db->get_where('tbl_kelurahan', ['district_id' => $name_kec['id']])->  result_array(); 
                      foreach ($kel as $name_kel) {

                        $this->db->where('kode_caleg', $this->session->kode);
                        $this->db->where('kel', $name_kel['id']);
                        $getnum = $this->db->get('tbl_pemilih')->num_rows();
                        ?>
                        <?= $getnum ?>,

                      <?php } ?>
                    // 100 jumlah pemilih
                    ],
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero:true
                      }
                    }]
                  }
                }
              });
            </script>

          <?php } ?>


        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->



    </div>
  </div>


</section>
<!-- /.content -->
</div>