<?php 

	/**
	 * 
	 */
	class Relawan extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index(){

			$data['pemilih'] = $this->db->get_where('tbl_pemilih', ['kode_caleg' => $this->session->kode])->num_rows();

			$id_relawan = $this->session->id_relawan;
			$data['jml_pemilihanda'] = $this->db->get_where('tbl_pemilih',['kode_relawan' => $id_relawan])->num_rows();
			
			$data['kel'] = $this->db->get_where('tbl_relawan', ['id' => $this->session->id_relawan])->row_array();

			$this->load->view('template/header2');
			$this->load->view('relawan/index', $data);
			$this->load->view('template/footer');
		}

		function pemilih(){
			$data['pemilih'] = $this->db->get_where('tbl_pemilih', ['kode_relawan' => $this->session->id_relawan])->result_array();
			$this->db->join('tbl_usercaleg', 'tbl_caleg.kode = tbl_usercaleg.kode_caleg');
			$this->db->from('tbl_caleg');
			$caleg = $this->db->get()->row_array();

			$data['kec'] = $this->db->get_where('tbl_wilayah_dapil', ['kode_dapil' => $caleg['dapil']])->result_array();

			$this->load->view('template/header2');
			$this->load->view('relawan/pemilih', $data);
			$this->load->view('template/footer');
		}

		function act_editpemilih(){

			$id = $this->input->post('id');
			$data = [
				
				'nama_pemilih' =>  $this->input->post('nama'),
				'jk' =>  $this->input->post('jk'),
				'umur' =>  $this->input->post('umur'),
				// 'kode_relawan' => '',
				'kec' =>  $this->input->post('kec'),
				'kel' =>  $this->input->post('kel'),
				'alamat_lengkap' =>  $this->input->post('alamat'),
				'nik' =>  $this->input->post('nik'),
			];

			$this->db->where('id', $id);
			$this->db->update('tbl_pemilih', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil diubah", "success");');
			redirect('relawan/pemilih');
		}

		function act_addpemilih(){
			
			$kode = $this->session->kode;
			$data = [
				'kode_caleg' => $kode ,                                                                
				'nama_pemilih' =>  $this->input->post('nama'),
				'jk' =>  $this->input->post('jk'),
				'umur' =>  $this->input->post('umur'),
				'kode_relawan' => $this->session->id_relawan,
				'kec' =>  $this->input->post('kec'),
				'kel' =>  $this->input->post('kel'),
				'alamat_lengkap' =>  $this->input->post('alamat'),
				'nik' =>  $this->input->post('nik'),
			];

			$this->db->insert('tbl_pemilih', $data);
			$this->session->set_flashdata('message', 'swal("Yess", "Data berhasil ditambah", "success");');
			redirect('relawan/pemilih');
		}

		function wilayah_kerja(){
			$id = $this->session->id_relawan;
			$relawan = $this->db->get_where('tbl_relawan',['id' => $id])->row_array();
			$data['kel'] = $this->db->get_where('tbl_kelurahan', ['id' => $relawan['kel']])->row_array();
			$data['kec'] = $this->db->get_where('tbl_kecamatan', ['id' => $relawan['kec']])->row_array();
			$data['det'] = $this->db->get_where('tbl_detail_wilayah', ['id_kel' => $relawan['kel']])->row_array();
			$this->load->view('template/header2');
			$this->load->view('relawan/wilayah_kerja', $data);
			$this->load->view('template/footer');
		}


	}

?>