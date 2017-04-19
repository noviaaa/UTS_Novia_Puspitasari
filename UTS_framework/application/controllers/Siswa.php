<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function index($idKelas)
	{
		$this->load->model('kelas_model');
		$data["siswa_list"] = $this->kelas_model->getSiswaByKelas($idKelas);
		$this->load->view('siswa',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('siswa', 'trim|required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'trim|required|date');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('tambah_siswa_view');
		} else {
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types']  = 'gif|jpg|png';
			$config['max_size']       = 1000000000;
			$config['max_width']      = 10240;
			$config['max_height']     = 7680;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				$this->load->model('tambah_pegawai_view',$error);
			}

			$this->kelas_model->insertsiswa($idKelas);
			redirect('siswa');
		}


	}

	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[100]');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('kelas_model');
		$data['kelas']=$this->kelas_model->getKelas($id);
			//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_kelas_view',$data);

		}else{
			$this->kelas_model->updateById($id);
			redirect('kelas');
		}
	}

	public function delete($id)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->load->model('kelas_Model');

		$this->kelas_Model->deleteSiswa($id);	
		if($this->form_validation->run()==FALSE){
				redirect('siswa');
			}
	}
}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */
 ?>