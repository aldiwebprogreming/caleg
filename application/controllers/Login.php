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

						$this->session->set_flashdata('message', 'swal("Ops", "Password anda salah", "success" );');
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
		}
	?>