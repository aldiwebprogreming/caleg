<?php 

		/**
		 * 
		 */
		class Login extends CI_Controller
		{
			
			function __construct()
			{
				parent::__construct();
			}

			function index(){

				$this->load->view('login/index');
			}

			function home(){
				$this->load->view('login/home');
			}


			function timsukses(){
				$this->load->view('login/timsukses');
			}

			function saksi(){
				$this->load->view('login/saksi');
			}


			function act_login(){
				
				$username = $this->input->post('username');
				$pass = $this->input->post('pass');
				$cek = $this->db->get_where('tbl_usercaleg', ['username' => $username])->row_array();
				if ($cek == true) {
					
					if (password_verify($pass, $cek['pass'])) {
						
						$data = [
							'username' => $username,
							'kode' => $cek['kode_caleg'],
						];
						$this->session->set_userdata($data);
						redirect('app/');
					}else{

						$this->session->set_flashdata('message', 'swal("Ops", "Password anda salah", "error" );');
						redirect('login');
					}
				}else{
					$this->session->set_flashdata('message', 'swal("Ops", "Akun anda tidak terdaftar", "error" );');
					redirect('login');
				}
			}

			function act_relawan(){
				$username = $this->input->post('username');
				$pass = $this->input->post('pass');
				$cek = $this->db->get_where('tbl_user_relawan', ['username' => $username])->row_array();
				if ($cek == true) {
					
					if (password_verify($pass, $cek['pass'])) {
						
						$data = [
							'username' => $username,
							'kode' => $cek['kode_caleg'],
							'relawan' => $cek['relawan'],
							'id_relawan' => $cek['id_relawan'],
						];
						$this->session->set_userdata($data);
						redirect('relawan/');
					}else{

						$this->session->set_flashdata('message', 'swal("Ops", "Password anda salah", "success" );');
						redirect('login/home');
					}
				}else{
					$this->session->set_flashdata('message', 'swal("Ops", "Akun anda tidak terdaftar", "error" );');
					redirect('login/home');
				}
			}


			function act_timsukses(){

				$username = $this->input->post('username');
				$pass = $this->input->post('pass');
				$cek = $this->db->get_where('tbl_ts', ['username' => $username])->row_array();
				if ($cek == true) {
					
					if (password_verify($pass, $cek['pass'])) {
						
						$data = [
							'username' => $username,
							'kode_caleg' => $cek['kode_caleg'],
							'nama' => $cek['nama'],
							'kode_ts' => $cek['kode_ts'],
						];
						$this->session->set_userdata($data);
						redirect('Timsukses/');
					}else{

						$this->session->set_flashdata('message', 'swal("Ops", "Password anda salah", "success" );');
						redirect('login/timsukses');
					}
				}else{
					$this->session->set_flashdata('message', 'swal("Ops", "Akun anda tidak terdaftar", "error" );');
					redirect('login/timsukses');
				}
			}

			function act_saksi(){

				$username = $this->input->post('username');
				$pass = $this->input->post('pass');
				$cek = $this->db->get_where('tbl_saksi', ['username' => $username])->row_array();
				if ($cek == true) {
					
					if (password_verify($pass, $cek['pass'])) {
						
						$data = [
							'username' => $username,
							'kode_caleg' => $cek['kode_caleg'],
							'nama' => $cek['nama'],
							'kode_saksi' => $cek['kode_saksi'],
							'role' => 'saksi',
						];
						$this->session->set_userdata($data);
						redirect('saksi/');
					}else{

						$this->session->set_flashdata('message', 'swal("Ops", "Password anda salah", "success" );');
						redirect('login/saksi');
					}
				}else{
					$this->session->set_flashdata('message', 'swal("Ops", "Akun anda tidak terdaftar", "error" );');
					redirect('login/saksi');
				}
			}


			function logout(){

				$this->session->unset_userdata('username');
				$this->session->unset_userdata('kode');
				redirect('login/');
			}

			function logout_relawan(){

				$this->session->unset_userdata('username');
				$this->session->unset_userdata('kode');
				$this->session->unset_userdata('relawan');
				redirect('login/home');
			}


			function logout_timsukses(){

				$this->session->unset_userdata('username');
				$this->session->unset_userdata('kode_ts');
				$this->session->unset_userdata('kode_caleg');
				redirect('login/timsukses');
			}

			function logout_saksi(){

				$this->session->unset_userdata('username');
				$this->session->unset_userdata('role');
				$this->session->unset_userdata('kode_saksi');
				$this->session->unset_userdata('kode_caleg');
				redirect('login/timsukses');
			}

		}		
	?>