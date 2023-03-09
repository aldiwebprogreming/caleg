<option>-- Pilih Kecamatan --</option>
<?php 
foreach ($wilayah as $data) {
	$kec = $this->db->get_where('tbl_kecamatan', ['id' => $data['wilayah']])->row_array();
	?>
	<option value="<?= $kec['id'] ?>"><?= $kec['name'] ?></option>
	<?php } ?>