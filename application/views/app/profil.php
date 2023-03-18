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
           <div class="alert alert-danger" role="alert">
            Hello <?= $this->session->username ?>.<br>
            Untuk saat ini profil anda masih kosong, mohon untuk mengisi data profil anda dengan lengkap dan benar.
          </div>
        <?php }else{ ?>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkaps" class="form-control">
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
                <select class="form-control" name="jk">
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
                <select class="form-control" name="jk">
                  <option>-- Pilih Dapil --</option>
                  <?php foreach ($dapil as $data) { ?>
                    <option><?= $data['dapil'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
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