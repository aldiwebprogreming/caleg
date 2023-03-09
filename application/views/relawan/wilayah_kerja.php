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
          <h3 class="box-title">  <i class="fa fa-map"></i> Data Wilayah Kerja Anda</h3>

        </div>
        <div class="box-body">
          <hr>

          <div class="row">

           <div class="col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-location"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-info"><?= $kec['name'] ?></span>
                <span class="info-box-number">
                  Desa <small class="text-success"></small>

                  <h6 class="text-danger" style="font-weight:bold;"><?= $kel['name'] ?></h6>
                </span>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-check"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-info"><?= $kel['name'] ?></span>
                <span class="info-box-number">
                  <?= $det['jml_ktp'] ?><small class="text-success"> </small>

                  <h6 class="text-danger" style="font-weight:bold;">DPT</h6>
                </span>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-map"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-info"><?= $kel['name'] ?></span>
                <span class="info-box-number">
                  <?= $det['luas_wilayah'] ?>    Km2               <small class="text-success"></small>

                  <h6 class="text-danger" style="font-weight:bold;">LUAS WILAYAH</h6>
                </span>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-info"><?= $kel['name'] ?></span>
                <span class="info-box-number">
                  <?= $det['jml_penduduk'] ?>  <small class="text-success"></small>

                  <h6 class="text-danger" style="font-weight:bold;">JUMLAH PENDUDUK</h6>
                </span>
              </div>
            </div>
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