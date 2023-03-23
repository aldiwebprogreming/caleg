<?php 

	/**
	 * 
	 */
	class App extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			if ($this->session->username == null) {
				redirect('login/');
			}
		}

		function index(){
			$data['pemilih'] = $this->db->get_where('tbl_pemilih', ['kode_caleg' => $this->session->kode])->num_rows();
			$data['relawan'] = $this->db->get_where('tbl_relawan', ['kode_caleg' => $this->session->kode])->num_rows();
			$data['pos'] = $this->db->get_where('tbl_pos', ['kode_caleg' => $this->session->kode])->num_rows();

			$dapil = $this->db->get_where('tbl_caleg', ['kode' => $this->session->kode])->row_array();
			$data['wilayah'] = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $dapil['dapil']])->num_rows();

			if ($this->session->relawan) {
				$id_relawan = $this->session->id_relawan;
				$data['jml_pemilihanda'] = $this->db->get_where('tbl_pemilih',['kode_relawan' => $id_relawan])->num_rows();
			}

			$this->load->view('template/header');
			$this->load->view('app/index', $data);
			$this->load->view('template/footer');
		}

		function relawan(){
			$caleg = $this->session->kode;
			$data['relawan'] = $this->db->get_where('tbl_relawan', ['kode_caleg' => $caleg])->result_array();

			$this->db->join('tbl_usercaleg', 'tbl_caleg.kode = tbl_usercaleg.kode_caleg');
			$this->db->from('tbl_caleg');
			$caleg = $this->db->get()->row_array();

			$data['kec'] = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $caleg['dapil']])->result_array();

			$this->load->view('template/header');
			$this->load->view('app/relawan', $data);
			$this->load->view('template/footer');
		}

		function act_addRelawan(){

			$data = [
				'kode_caleg' => $this->session->kode,
				'kec' => $this->input->post('kec'),
				'kel' => $this->input->post('kel'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'nik' => $this->input->post('nik'),
				'jk' => $this->input->post('jk'),
				'pendidikan_terakhir' => $this->input->post('pendidikan'),
				'no_telp' => $this->input->post('no_telp'),
			];

			$this->db->insert('tbl_relawan', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success" );');
			redirect('app/relawan');
		}

		function act_editRelawan(){
			$id = $this->input->post('id');
			$data = [
				'nama' => $this->input->post('nama'),
				'kec' => $this->input->post('kec'),
				'kel' => $this->input->post('kel'),
				'alamat' => $this->input->post('alamat'),
				'nik' => $this->input->post('nik'),
				'jk' => $this->input->post('jk'),
				'pendidikan_terakhir' => $this->input->post('pendidikan'),
				'no_telp' => $this->input->post('no_telp'),
			];

			$this->db->where('id', $id);
			$this->db->update('tbl_relawan', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success" );');
			redirect('app/relawan');
		}

		function act_hapusRelawan(){
			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_relawan');
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil dihapus", "success" );');
			redirect('app/relawan');
		}

		function dapil(){

			$data['dapil'] = $this->db->get('tbl_dapil')->result_array();
			$data['kec'] = $this->db->get_where('tbl_kecamatan', ['regency_id' => 1213])->result_array();

			$this->load->view('template/header');
			$this->load->view('app/dapil', $data);
			$this->load->view('template/footer');
		}

		function act_addDapil(){

			$wilayah = $this->input->post('wilayah[]');
			$count = count($wilayah);

			$data = [
				'Kode' => $this->input->post('kode'),
				'dapil' => $this->input->post('dapil'),
				'map' => implode(',', $wilayah),
			];

			$this->db->insert('tbl_dapil', $data);

			for ($i=0; $i < $count ; $i++) { 

				$data = [
					'kode_dapil' => $this->input->post('kode'),
					'wilayah' => $wilayah[$i],
				];
				
				$this->db->insert('tbl_wilayah_dapil', $data);
			};

			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success" );');
			redirect('app/dapil');
		}

		function act_editdapil(){
			$id = $this->input->post('id');
			$data = [
				'Kode' => $this->input->post('kode'),
				'dapil' => $this->input->post('dapil'),
				'map' => $this->input->post('map'),
			];

			$this->db->where('id', $id);
			$this->db->update('tbl_dapil', $data);

			$this->db->where('kode_dapil', $this->input->post('kode2'));
			$this->db->delete('tbl_wilayah_dapil');

			$wilayah = $this->input->post('wilayah[]');
			$count = count($wilayah);

			for ($i=0; $i < $count ; $i++) { 

				$data = [
					'kode_dapil' => $this->input->post('kode'),
					'wilayah' => $wilayah[$i],
				];
				
				$this->db->insert('tbl_wilayah_dapil', $data);
			};




			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success" );');
			redirect('app/dapil');
		}

		function act_hapusDapil(){
			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_dapil');
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil dihapus", "success" );');
			redirect('app/dapil');
		}

		function caleg(){
			$data['caleg'] = $this->db->get('tbl_caleg')->result_array();
			$data['kode'] = "CL-".rand(0, 10000);
			$data['dapil'] = $this->db->get('tbl_dapil')->result_array();
			$this->load->view('template/header');
			$this->load->view('app/caleg', $data);
			$this->load->view('template/footer');
		}

		function act_addCaleg(){

			$data = [
				'kode' => $this->input->post('kode'),
				'nama' => $this->input->post('nama'),
				'no_urut' => $this->input->post('no_urut'),
				'dapil' => $this->input->post('dapil')
			];

			$cek = $this->db->get_where('tbl_caleg', ['no_urut' => $this->input->post('no_urut')])->row_array();
			if ($cek == true) {
				
				$this->session->set_flashdata('message', 'swal("Ops", "Nomor urut sudah terdaftar", "error" );');
				redirect('app/caleg');
			}

			$this->db->insert('tbl_caleg', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success" );');
			redirect('app/caleg');
		}

		function act_editCaleg(){

			$id = $this->input->post('id');
			$data = [
				
				'nama' => $this->input->post('nama'),
				'no_urut' => $this->input->post('no_urut'),
				'dapil' => $this->input->post('dapil')
			];
			$this->db->where('id', $id);
			$this->db->update('tbl_caleg', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success" );');
			redirect('app/caleg');
		}

		function act_hapusCaleg(){

			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_caleg');
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil dihapus", "success" );');
			redirect('app/caleg');
		}

		function usercaleg(){

			$data['caleg'] = $this->db->get('tbl_caleg')->result_array();
			$data['usercaleg'] = $this->db->get('tbl_usercaleg')->result_array();
			$this->load->view('template/header');
			$this->load->view('app/user_caleg', $data);
			$this->load->view('template/footer');

		}

		function act_addusercaleg(){
			$data = [
				'kode_caleg' => $this->input->post('kode'),
				'username' => $this->input->post('username'),
				'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT)
			];

			$kode =  $this->input->post('kode');

			$cek = $this->db->get_where('tbl_usercaleg', ['kode_caleg' => $kode])->row_array();

			if ($cek == true) {
				$this->session->set_flashdata('message', 'swal("Ops", "Data sudah terdaftar", "error" );');
				redirect('app/usercaleg');
			}else{

				$this->db->insert('tbl_usercaleg', $data);
				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success" );');
				redirect('app/usercaleg');
			}

		}

		function act_edituserCaleg(){

			$id = $this->input->post('id');
			$data = [
				
				'username' => $this->input->post('username'),
				'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT)
			];

			$this->db->where('id', $id);
			$this->db->update('tbl_usercaleg', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil di ubah", "success" );');
			redirect('app/usercaleg');

		}

		function hapus_usercaleg(){

			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_usercaleg');
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil dihapus", "success" );');
			redirect('app/usercaleg');
		}


		function wilayah(){
			$caleg = $this->session->kode;
			$kode = $this->db->get_where('tbl_caleg', ['kode' => $caleg])->row_array();
			$data['wilayah'] = $this->db->get_where('tbl_wilayah_dapil',['kode_dapil' => $kode['dapil']])->result_array();

			$this->load->view('template/header');
			$this->load->view('app/wilayah', $data);
			$this->load->view('template/footer');


		}

		function pos(){
			$data['wilayah'] = $this->db->get_where('tbl_wilayah_dapil',['kode_dapil' => 'DP-01'])->result_array();
			$data['relawan'] = $this->db->get('tbl_relawan')->result_array();
			$caleg = $this->session->kode;
			$data['pos'] = $this->db->get_where('tbl_pos', ['kode_caleg' => $caleg])->result_array();
			$this->load->view('template/header');
			$this->load->view('app/datapos', $data);
			$this->load->view('template/footer');

		}

		function get_kel(){
			$id = $this->input->get('id');
			$data['kel'] = $this->db->get_where('tbl_kelurahan', ['district_id' => $id])->result_array();
			$this->load->view('app/get_kel', $data);
		}

		function get_kel2(){
			$id = $this->input->get('id');
			$data['kel'] = $this->db->get_where('tbl_kelurahan', ['district_id' => $id])->result_array();
			$this->load->view('app/get_kel2', $data);
		}

		function act_addpos(){

			$data = [
				'kode_caleg' => $this->session->kode,
				'kec' => $this->input->post('kec'),
				'kel' => $this->input->post('kel'),
				'ketua' => $this->input->post('ketua'),
			];

			$cek = $this->db->get_where('tbl_pos', ['ketua' => $this->input->post('ketua')])->row_array();

			if ($cek == true) {
				$this->session->set_flashdata('message', 'swal("Ops", "Nama ketua sudah terdaftar", "error" );');
				redirect('app/pos');
			}else{

				$this->db->insert('tbl_pos', $data);
				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil di tambah", "success" );');
				redirect('app/pos');
			}
		}

		function act_editpos(){
			$id = $this->input->post('id');
			$data = [
				'kec' => $this->input->post('kec'),
				'kel' => $this->input->post('kel'),
				'ketua' => $this->input->post('ketua'),
			];

			$this->db->where('id', $id);
			$this->db->update('tbl_pos', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil di ubah", "success" );');
			redirect('app/pos');
		}

		function act_hapuspos(){

			$id = $this->input->post('id');

			$this->db->where('id', $id);
			$this->db->delete('tbl_pos');
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil di hapus", "success" );');
			redirect('app/pos');
		}

		function data_tps(){

			$data['tps'] = $this->db->get('tbl_tps')->result_array();
			$data['dapil'] = $this->db->get('tbl_dapil')->result_array();
			$this->load->view('template/header');
			$this->load->view('app/data_tps', $data);
			$this->load->view('template/footer');
		}

		function get_kecdapil(){

			$kodeDapil = $this->input->get('id');
			$data['wilayah'] = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $kodeDapil])->result_array();

			$this->load->view('app/get_wilayahdapil', $data);

		}

		function get_keldapil(){

			$id = $this->input->get('id');
			$data['kel'] = $this->db->get_where('tbl_kelurahan', ['district_id' => $id])->result_array();
			$this->load->view('app/get_keldapil', $data);
		}

		function act_addtps(){

			$jml = $this->input->post('tps');
			for ($i=1; $i <= $jml ; $i++) { 

				if ($i > 9) {
					$kode = "0".$i;
				}else{

					$kode = "00".$i;
				};
				
				$data = [
					'kode_dapil' => $this->input->post('kode_dapil'),
					'kec' => $this->input->post('kec'),
					'kel' => $this->input->post('kel'),
					'alamat' => $this->input->post('alamat'),
					'tps' => $kode,
				];
				$this->db->insert('tbl_tps', $data);

			}

			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success");');
			redirect('app/data_tps');
		}

		function act_hapustps(){
			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_tps');
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil dihapus", "success");');
			redirect('app/data_tps');

		}

		function petawilayah(){
			$data['kab'] = $this->db->get_where('tbl_kabupaten', ['id' => 1213])->result_array();
			$this->load->view('template/header');
			$this->load->view('app/peta', $data);
			$this->load->view('template/footer');

		}

		function getkec(){

			$id = $this->input->get('id');
			$data['kec'] = $this->db->get_where('tbl_kecamatan', ['regency_id' => $id])->result_array();
			$this->load->view('app/getkec', $data);


		}

		function getkel_relawan(){

			$id = $this->input->get('id');
			$data['kel'] = $this->db->get_where('tbl_kelurahan', ['district_id' => $id])->result_array();
			$this->load->view('app/get_kelrelawan', $data);		

		}

		function pemilih(){	
			$kode = $this->session->kode;
			$data['pemilih'] = $this->db->get_where('tbl_pemilih', ['kode_caleg' => $kode])->result_array();

			$this->db->join('tbl_usercaleg', 'tbl_caleg.kode = tbl_usercaleg.kode_caleg');
			$this->db->from('tbl_caleg');
			$caleg = $this->db->get()->row_array();

			$data['kec'] = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $caleg['dapil']])->result_array();

			$this->load->view('template/header');
			$this->load->view('app/pemilih', $data);
			$this->load->view('template/footer');
		}

		function act_addpemilih(){
			$kode = $this->session->kode;
			$data = [
				'kode_caleg' => $kode ,                                                                
				'nama_pemilih' =>  $this->input->post('nama'),
				'jk' =>  $this->input->post('jk'),
				'umur' =>  $this->input->post('umur'),
				'kode_relawan' => '',
				'kec' =>  $this->input->post('kec'),
				'kel' =>  $this->input->post('kel'),
				'alamat_lengkap' =>  $this->input->post('alamat'),
				'nik' =>  $this->input->post('nik'),
			];

			$this->db->insert('tbl_pemilih', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success");');
			redirect('app/pemilih');
		}

		function act_hapuspemilih(){
			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_pemilih');
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil dihapus", "success");');
			redirect('app/pemilih');

		}

		function act_editpemilih(){
			$id = $this->input->post('id');
			$data = [
				
				'nama_pemilih' =>  $this->input->post('nama'),
				'jk' =>  $this->input->post('jk'),
				'umur' =>  $this->input->post('umur'),
				'kode_relawan' => '',
				'kec' =>  $this->input->post('kec'),
				'kel' =>  $this->input->post('kel'),
				'alamat_lengkap' =>  $this->input->post('alamat'),
				'nik' =>  $this->input->post('nik'),
			];

			$this->db->where('id', $id);
			$this->db->update('tbl_pemilih', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success");');
			redirect('app/pemilih');
		}

		function detail_pemilih(){

			$kode = $this->session->kode;
			$kel = $this->input->get('kel');
			$this->db->where('kel', $kel);
			$this->db->where('kode_caleg', $kode);
			$data['pemilih'] = $this->db->get('tbl_pemilih')->result_array();
			$this->load->view('template/header');
			$this->load->view('app/detail_pemilih', $data);
			$this->load->view('template/footer');

		}

		function grafig_pemilih(){
			$kode = $this->session->kode;
			$data['pemilih'] = $this->db->get_where('tbl_pemilih', ['kode_caleg' => $kode])->result_array();

			$this->db->join('tbl_usercaleg', 'tbl_caleg.kode = tbl_usercaleg.kode_caleg');
			$this->db->from('tbl_caleg');
			$caleg = $this->db->get()->row_array();

			$data['kec'] = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $caleg['dapil']])->result_array();

			$this->load->view('template/header');
			$this->load->view('app/grafig_pemilih', $data);
			$this->load->view('template/footer');

		}

		function user_relawan(){
			$data['userrelawan'] = $this->db->get_where('tbl_user_relawan', ['kode_caleg' => $this->session->kode])->result_array();
			$data['relawan'] = $this->db->get_where('tbl_relawan',['kode_caleg' => $this->session->kode])->result_array();
			$this->load->view('template/header');
			$this->load->view('app/user_relawan', $data);
			$this->load->view('template/footer'); 
		}

		function act_adduserrelawan(){

			$relawan = $this->db->get_where('tbl_relawan', ['id' => $this->input->post('relawan')])->row_array();
			

			$data = [
				'kode_caleg' => $this->input->post('caleg'),
				'id_relawan' => $this->input->post('relawan'),
				'relawan' => $relawan['nama'],
				'username' => $this->input->post('username'),
				'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT)
			];

			$cek = $this->db->get_where('tbl_user_relawan', ['relawan' => $this->input->post('relawan')])->row_array();
			if ($cek == true) {
				$this->session->set_flashdata('message', 'swal("Ops", "Data sudah terdaftar", "error");');
				redirect('app/user_relawan');
			}else{

				$this->db->insert('tbl_user_relawan', $data);
				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success");');
				redirect('app/user_relawan');

			}
		}

		function act_edituserRelawan(){

			$id = $this->input->post('id');
			$data = [

				'relawan' => $this->input->post('relawan'),
				'username' => $this->input->post('username'),
				'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT)
			];

			$this->db->where('id', $id);
			$this->db->update('tbl_user_relawan', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success");');
			redirect('app/user_relawan');
		}

		function hapus_userrelawan(){
			$id = $this->input->post('id');

			$this->db->where('id', $id);
			$this->db->delete('tbl_user_relawan');
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil dihapus", "success");');
			redirect('app/user_relawan');
		}


		function tim_sukses(){
			$data['ts'] = $this->db->get_where('tbl_ts', ['kode_caleg' => $this->session->kode])->result_array();
			$data['dapil'] = $this->db->get('tbl_dapil')->result_array();
			$this->load->view('template/header');
			$this->load->view('app/data_ts', $data);
			$this->load->view('template/footer'); 
		}


		function gettps(){

			$id = $this->input->get('id');
			$data['tps'] = $this->db->get_where('tbl_tps', ['kel' => $id])->result_array();
			$this->load->view('app/get_tps', $data);
		}

		function act_addts(){

			$config['upload_path']          = './assets/berkas';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['min_size']             = 9000000;
			$config['remove_spaces']        = false;
			$config['encrypt_name'] 		= true;


			$this->load->library('upload', $config);
			if (!$this->upload->do_upload("foto")){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', 'swal("Oops", "Ada kesalahan dalam upload gambar", "warning" );');
				redirect('app/tim_sukses');

			}else{
				$img = array('upload_data' => $this->upload->data());
				$new_name = $img['upload_data']['file_name'];

				$data = [
					'kode_caleg' => $this->session->kode,
					'kode_ts' => "TS-". rand(0, 10000),
					'nama' => $this->input->post('nama'),
					'alamat_ts' => $this->input->post('alamat_ts'),
					'nohp' => $this->input->post('nohp'),
					'nik' => $this->input->post('nik'),
					'foto' => $new_name,
					'dapil' => $this->input->post('dapil'),
					'kec' => $this->input->post('kec'),
					'kel' => $this->input->post('kel'),
					'tps' => $this->input->post('tps'),
					'username' => $this->input->post('username'),
					'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
				];

				$this->db->insert('tbl_ts', $data);
				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success");');
				redirect('app/tim_sukses');
			}

		}

		function act_editts(){

			$id = $this->input->post('id');
			$foto = $_FILES['foto']['name'];

			if ($foto !== '') {
				
				$config['upload_path']          = './assets/berkas';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['min_size']             = 9000000;
				$config['remove_spaces']        = false;
				$config['encrypt_name'] 		= true;


				$this->load->library('upload', $config);
				if (!$this->upload->do_upload("foto")){
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('message', 'swal("Oops", "Ada kesalahan dalam upload gambar", "warning" );');
					redirect('app/tim_sukses');

				}else{
					$img = array('upload_data' => $this->upload->data());
					$new_name = $img['upload_data']['file_name'];

					$data = [
						'nama' => $this->input->post('nama'),
						'alamat_ts' => $this->input->post('alamat_ts'),
						'nohp' => $this->input->post('nohp'),
						'nik' => $this->input->post('nik'),
						'foto' => $new_name,
						'dapil' => $this->input->post('dapil'),
						'kec' => $this->input->post('kec'),
						'kel' => $this->input->post('kel'),
						'tps' => $this->input->post('tps'),
						'username' => $this->input->post('username'),
						'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
					];

					$this->db->where('id', $id);
					$this->db->update('tbl_ts', $data);

					$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success");');
					redirect('app/tim_sukses');

				}


			}else{

				$data = [
					'nama' => $this->input->post('nama'),
					'alamat_ts' => $this->input->post('alamat_ts'),
					'nohp' => $this->input->post('nohp'),
					'nik' => $this->input->post('nik'),
					// 'foto' => $new_name,
					'dapil' => $this->input->post('dapil'),
					'kec' => $this->input->post('kec'),
					'kel' => $this->input->post('kel'),
					'tps' => $this->input->post('tps'),
					'username' => $this->input->post('username'),
					'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
				];

				$this->db->where('id', $id);
				$this->db->update('tbl_ts', $data);

				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success");');
				redirect('app/tim_sukses');

			}

		}


		function act_hapusts(){

			$id = $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_ts');
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil dihapus", "success");');
			redirect('app/tim_sukses');
		}


		function profil(){
			
			$kode = $this->session->kode;
			$data['profil'] = $this->db->get_where('tbl_profil', ['kode_caleg' => $kode])->row_array();
			$data['dapil'] = $this->db->get_where('tbl_dapil')->result_array();

			$this->load->view('template/header');
			$this->load->view('app/profil', $data);
			$this->load->view('template/footer');
		}

		function act_profil(){

			$config['upload_path']          = './assets/profil';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['min_size']             = 9000000;
			$config['remove_spaces']        = false;
			$config['encrypt_name'] 		= true;


			$this->load->library('upload', $config);
			if (!$this->upload->do_upload("foto")){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', 'swal("Oops", "Ada kesalahan dalam upload gambar", "warning" );');
				redirect('app/profil');

			}else{
				$img = array('upload_data' => $this->upload->data());
				$new_name = $img['upload_data']['file_name'];

				$data = [
					'kode_caleg' => $this->session->kode,
					'Nama_lengkap' => $this->input->post('nama_lengkap'),
					'jk' => $this->input->post('jk'),
					'umur' => $this->input->post('umur'),
					'alamat' => $this->input->post('alamat'),
					'pendidikan' => $this->input->post('pendidikan'),
					'foto' => $new_name,
					'visi' => $this->input->post('visi'),
					'misi' =>$this->input->post('misi'),
				];

				$this->db->insert('tbl_profil', $data);
				$this->session->set_flashdata('message', 'swal("Yess", "Profil anda berhasil di buat", "success" );');
				redirect('app/profil');
			}

		}


	}

?>