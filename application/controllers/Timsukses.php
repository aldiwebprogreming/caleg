<?php 

	/**
	 * 
	 */
	class Timsukses extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index(){
			$data['jml_pemilih'] = $this->db->get_where('tbl_pemilih', ['kode_ts' => $this->session->kode_ts])->num_rows();
			$data['wk'] = $this->db->get_where('tbl_ts', ['kode_ts' => $this->session->kode_ts])->row_array();

			$this->load->view('template_ts/header');
			$this->load->view('ts/index', $data);
			$this->load->view('template_ts/footer');
		}

		function data_pemilih(){
			$data['pemilih'] = $this->db->get('tbl_pemilih')->result_array();
			$this->db->join('tbl_usercaleg', 'tbl_caleg.kode = tbl_usercaleg.kode_caleg');
			$this->db->from('tbl_caleg');
			$caleg = $this->db->get()->row_array();

			$data['kec'] = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $caleg['dapil']])->result_array();

			$kode_ts = $this->session->kode_ts;

			$data['ts'] = $this->db->get_where('tbl_ts', ['kode_ts' => $kode_ts])->row_array();
			$data['kec'] = $this->db->get_where('tbl_kecamatan', ['id' => $data['ts']['kec']])->row_array();
			$data['kel'] = $this->db->get_where('tbl_kelurahan', ['id' => $data['ts']['kel']])->row_array();

			$this->load->view('template_ts/header');
			$this->load->view('ts/data_pemilih', $data);
			$this->load->view('template_ts/footer');
		}

		function act_pemilih(){


			$config['upload_path']          = './assets/berkaspemilih';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['min_size']             = 9000000;
			$config['remove_spaces']        = false;
			$config['encrypt_name'] 		= true;


			$this->load->library('upload', $config);
			if (!$this->upload->do_upload("foto")){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', 'swal("Oops", "Ada kesalahan dalam upload gambar", "warning" );');
				redirect('Timsukses/data_pemilih');

			}else{
				$img = array('upload_data' => $this->upload->data());
				$new_name = $img['upload_data']['file_name'];

				$kode = $this->session->kode_ts;
				$data = [
					'kode_caleg' => 'CL-2802',                                                                
					'nama_pemilih' =>  $this->input->post('nama'),
					'jk' =>  $this->input->post('jk'),
					'umur' =>  $this->input->post('umur'),
					'kode_ts' => $kode,
					'kec' =>  $this->input->post('kec'),
					'kel' =>  $this->input->post('kel'),
					'tps' => $this->input->post('tps'),
					'foto_ktp' => $new_name,
					'alamat_lengkap' =>  $this->input->post('alamat'),
					'nik' =>  $this->input->post('nik'),
				];

				$this->db->insert('tbl_pemilih', $data);
				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success");');
				redirect('Timsukses/data_pemilih');
			}

		}


		function act_editpemilih(){

			$id = $this->input->post('id');
			$foto = $_FILES['foto_ktp']['name'];

			if ($foto !== '') {
				
				$config['upload_path']          = './assets/berkaspemilih';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['min_size']             = 9000000;
				$config['remove_spaces']        = false;
				$config['encrypt_name'] 		= true;
				
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload("foto_ktp")){
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('message', 'swal("Oops", "Ada kesalahan dalam upload gambar", "warning" );');
					redirect('Timsukses/data_pemilih');

				}else{
					$img = array('upload_data' => $this->upload->data());
					$new_name = $img['upload_data']['file_name'];

					$data = [

						'nama_pemilih' =>  $this->input->post('nama'),
						'jk' =>  $this->input->post('jk'),
						'umur' =>  $this->input->post('umur'),
						'kode_ts' => '',
						'kec' =>  $this->input->post('kec'),
						'kel' =>  $this->input->post('kel'),
						'tps' => $this->input->post('tps'),
						'foto_ktp' => $new_name,
						'alamat_lengkap' =>  $this->input->post('alamat'),
						'nik' =>  $this->input->post('nik'),
					];

					$this->db->where('id', $id);
					$this->db->update('tbl_pemilih', $data);

					$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success");');
					redirect('Timsukses/data_pemilih');
				}

			}else{

				$data = [

					'nama_pemilih' =>  $this->input->post('nama'),
					'jk' =>  $this->input->post('jk'),
					'umur' =>  $this->input->post('umur'),
					'kode_ts' => '',
					'kec' =>  $this->input->post('kec'),
					'kel' =>  $this->input->post('kel'),
					'tps' => $this->input->post('tps'),
					'alamat_lengkap' =>  $this->input->post('alamat'),
					'nik' =>  $this->input->post('nik'),
				];


				$this->db->where('id', $id);
				$this->db->update('tbl_pemilih', $data);

				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success");');
				redirect('Timsukses/data_pemilih');


			}

		}

		function profil(){

			$kode = $this->session->kode_ts;
			$data['profil'] = $this->db->get_where('tbl_ts', ['kode_ts' => $kode])->row_array();

			$this->load->view('template_ts/header');
			$this->load->view('ts/profil', $data);		
			$this->load->view('template_ts/footer');
		}

		function act_editprofil(){

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
					redirect('Timsukses/profil');

				}else{
					$img = array('upload_data' => $this->upload->data());
					$new_name = $img['upload_data']['file_name'];

					$data = [
						'nama' => $this->input->post('nama'),
						'alamat_ts' => $this->input->post('alamat_ts'),
						'nohp' => $this->input->post('nohp'),
						'nik' => $this->input->post('nik'),
						'foto' => $new_name,
					];

					$this->db->where('id', $id);
					$this->db->update('tbl_ts', $data);

					$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success");');
					redirect('Timsukses/profil');

				}

			}else{

				$data = [
					'nama' => $this->input->post('nama'),
					'alamat_ts' => $this->input->post('alamat_ts'),
					'nohp' => $this->input->post('nohp'),
					'nik' => $this->input->post('nik'),

				];

				$this->db->where('id', $id);
				$this->db->update('tbl_ts', $data);

				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success");');
				redirect('Timsukses/profil');


			}

		}

		// function data_pemilih(){

		// 	$data['pemilih'] = $this->db->get_where('tbl_pemilih', ['kode_relawan' => $this->session->kode_ts])->result_array();
		// 	$this->db->join('tbl_usercaleg', 'tbl_caleg.kode = tbl_usercaleg.kode_caleg');
		// 	$this->db->from('tbl_caleg');
		// 	$caleg = $this->db->get()->row_array();

		// 	$data['kec'] = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $caleg['dapil']])->result_array();


		// 	$this->load->view('template_ts/header');
		// 	$this->load->view('ts/data_pemilih', $data);		
		// 	$this->load->view('template_ts/footer');

		// }
	}
?>