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
          <h3 class="box-title">  <i class="fa fa-users"></i> Peta </h3>

        </div>
        <div class="box-body">
          <hr>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Tambah Relawan
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus"></i> Form Tambah Relawan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="<?= base_url('app/act_addRelawan') ?>">

                   <div class="form-group">
                    <label for="exampleInputEmail1">Kabupaten</label>
                    <select class="form-control" name="" id="kab">
                      <option>-- Pilih Kab --</option>
                      <?php foreach ($kab as $data) { ?>
                        <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Kec</label>
                    <select class="form-control" id="kec">
                      <option>-- Pilih Kec --</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1" id="kel">Kel</label>

                    <option>-- Pilih Kel --</option>





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




      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->



  </div>
</div>


</section>
<!-- /.content -->
</div>

<script>
  $(document).ready(function(){
    alert('ebunga');
  })
</script>