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
          <h3 class="box-title">  <i class="fa fa-user"></i> Profil </h3>
          <hr>
        </div>
        <div class="box-body">

         <form method="post" action="<?= base_url('Timsukses/act_editprofil') ?>" enctype="multipart/form-data">

          <input type="hidden" name="id" value="<?= $profil['id'] ?>">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="<?= $profil['nama'] ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nohp</label>
                <input type="number" name="nohp" class="form-control" value="<?= $profil['nohp'] ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nohp</label>
                <input type="number" name="nohp" class="form-control" required value="<?= $profil['nohp'] ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nik</label>
                <input type="number" name="nik" class="form-control" value="<?= $profil['nik'] ?>" required>
              </div>
            </div>
            <div class="col-sm-6">
              <label>Alamat</label>
              <div class="form-group">
                <textarea required class="form-control" name="alamat_ts"><?= $profil['alamat_ts'] ?></textarea>
              </div>
            </div>

            <div class="col-sm-6">
              <label>Dapil</label>
              <div class="form-group">
                <select class="form-control" name="dapil">

                 <option value="<?= $profil['dapil'] ?>">
                  <?php 
                  if ($profil['dapil'] == 'DP-01') {
                    echo "dapil 1";
                  }elseif($profil['dapil'] == 'DP-02'){
                    echo "dapil 2";
                  }elseif($profil['dapil'] == 'DP-03'){
                    echo "dapil 3";
                  }elseif($profil['dapil'] == 'DP-04'){
                    echo "dapil 4";
                  }elseif($profil['dapil'] == 'DP-05'){
                    echo "dapil 5";
                  }else{
                    echo "dapil 6";
                  }
                  ?>
                </option>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <label>Foto</label>
            <div class="form-group">
              <input type="file" name="foto" class="form-control" id="image-sourceprofilts" onchange="previewImageProfilTS();"/ >

              <img id="image-previewprofilts" src="<?= base_url('assets/berkas/') ?><?= $profil['foto'] ?>" alt="foto" class="img-thumbnail" style="height: 200px; width: 200px;" >
            </div>
            <input type="submit" name="kirim" class="btn btn-primary" value="Edit profil">
          </div>
          <br>

        </div>



      </div>

    </form>

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