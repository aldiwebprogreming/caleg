<?php 

	/**
	 * 
	 */
	class Saksi extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			if ($this->session->kode_saksi == null) {
				
				redirect('login/saksi');
			}
		}

		function index(){

			$this->load->view('template_saksi/header');
			$this->load->view('saksi/index');
			$this->load->view('template_saksi/footer');
		}


		function tambah_suara(){

			$data['suara'] = $this->db->get_where('tbl_suara_saksi', ['kode_saksi'])->result_array();
			$this->load->view('template_saksi/header');
			$this->load->view('saksi/tambah_suara', $data);
			$this->load->view('template_saksi/footer');
		}

		function act_tambah_suara(){
			$config['upload_path']          = './assets/berkassaksi';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['min_size']             = 9000000;
			$config['remove_spaces']        = false;
			$config['encrypt_name'] 		= true;


			$this->load->library('upload', $config);
			if (!$this->upload->do_upload("bukti")){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', 'swal("Oops", "Ada kesalahan dalam upload gambar", "warning" );');
				redirect('saksi/tambah_suara');

			}else{

				$img = array('upload_data' => $this->upload->data());
				$new_name = $img['upload_data']['file_name'];

				$data = [
					'kode_saksi' => $this->session->kode_saksi,
					'kode_caleg' => $this->session->kode_caleg,
					'jml_suara' => $this->input->post('jml_suara'),
					'bukti' => $new_name   
				];

				$this->db->insert('tbl_suara_saksi', $data);
				$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil di buat", "success" );');
				redirect('saksi/tambah_suara');

			}

		}
	}
?>