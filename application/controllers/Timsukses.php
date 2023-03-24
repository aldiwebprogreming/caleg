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

			$this->load->view('template_ts/header');
			$this->load->view('ts/index');
			$this->load->view('template_ts/footer');
		}

		function data_pemilih(){
			$data['pemilih'] = $this->db->get('tbl_pemilih')->result_array();
			$this->db->join('tbl_usercaleg', 'tbl_caleg.kode = tbl_usercaleg.kode_caleg');
			$this->db->from('tbl_caleg');
			$caleg = $this->db->get()->row_array();

			$data['kec'] = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $caleg['dapil']])->result_array();

			$kode_ts = 'TS-5658';

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

				$kode = $this->session->kode;
				$data = [
					'kode_caleg' => '34343' ,                                                                
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

				$this->db->insert('tbl_pemilih', $data);
				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success");');
				redirect('Timsukses/data_pemilih');
			}

		}


	}
?>