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
          <?php 
          if ($profil == true) {
           ?>
           <form method="post" action="<?= base_url('app/act_editprofil') ?>" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $profil['id'] ?>">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" value="<?= $profil['Nama_lengkap'] ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <label>Jenis Kelamin</label>
                <div class="form-group">
                  <select class="form-control" name="jk">
                    <option><?= $profil['jk'] ?></option>
                    <option>-- Pilih Jenis Kelamin --</option>
                    <option>Laki - Laki</option>
                    <option>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Umur</label>
                  <input type="number" name="umur" class="form-control" value="<?= $profil['umur'] ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <label>Alamat</label>
                <div class="form-group">
                  <textarea class="form-control" name="alamat"><?= $profil['alamat'] ?></textarea>
                </div>
              </div>
              <div class="col-sm-6">
                <label>Pendidikan</label>
                <div class="form-group">
                  <select class="form-control" name="pendidikan">
                    <option><?= $profil['pendidikan'] ?></option>
                    <option>-- Pilih Pendidikan --</option>
                    <option>SMA</option>
                    <option>S1</option>
                    <option>S2</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <label>Foto</label>
                <div class="form-group">
                  <input type="file" name="foto" class="form-control" id="image-sourceprofil" onchange="previewImageProfil();"/ >

                  <img id="image-previewprofil" src="<?= base_url('assets/profil/') ?><?= $profil['foto'] ?>" alt="foto" class="img-thumbnail" style="height: 200px; width: 200px;" >
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
                  <option>-- Pilih Dapil --</option>
                  <?php foreach ($dapil as $data) { ?>
                    <option value="<?= $data['Kode'] ?>"><?= $data['dapil'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <label>Visi</label>
              <div class="form-group">
                <textarea class="form-control" name="visi" required><?= $profil['visi'] ?></textarea>
              </div>
            </div>

            <div class="col-sm-6">
              <label>Misi</label>
              <div class="form-group">
                <textarea class="form-control" name="misi" required><?= $profil['misi'] ?></textarea>
              </div>
            </div> 


          </div>
          <input type="submit" name="kirim" class="btn btn-primary" value="Edit profil">
        </form>
      <?php }else{ ?>
        <div class="alert alert-danger" role="alert">
          Hello <?= $this->session->username ?>.<br>
          Untuk saat ini profil anda masih kosong, mohon untuk mengisi data profil anda dengan lengkap dan benar.
        </div>
        <form method="post" action="<?= base_url('app/act_profil') ?>" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control">
              </div>
            </div>
            <div class="col-sm-6">
              <label>Jenis Kelamin</label>
              <div class="form-group">
                <select class="form-control" name="jk">
                  <option>-- Pilih Jenis Kelamin --</option>
                  <option>Laki - Laki</option>
                  <option>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Umur</label>
                <input type="number" name="umur" class="form-control">
              </div>
            </div>
            <div class="col-sm-6">
              <label>Alamat</label>
              <div class="form-group">
                <textarea class="form-control" name="alamat"></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <label>Pendidikan</label>
              <div class="form-group">
                <select class="form-control" name="pendidikan">
                  <option>-- Pilih Pendidikan --</option>
                  <option>SMA</option>
                  <option>S1</option>
                  <option>S2</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <label>Foto</label>
              <div class="form-group">
                <input type="file" name="foto" class="form-control">

              </div>
            </div>
            <div class="col-sm-6">
              <label>Dapil</label>
              <div class="form-group">
                <select class="form-control" name="dapil">

                  <option>-- Pilih Dapil --</option>
                  <?php foreach ($dapil as $data) { ?>
                    <option value="<?= $data['Kode'] ?>"><?= $data['dapil'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <
              <label>Visi</label>
              <div class="form-group">
                <textarea class="form-control" name="visi" required></textarea>
              </div>
            </div>

            <div class="col-sm-6">
              <label>Misi</label>
              <div class="form-group">
                <textarea class="form-control" name="misi" required></textarea>
              </div>
            </div> 


          </div>
          <input type="submit" name="kirim" class="btn btn-primary" value="Simpan profil">
        </form>
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