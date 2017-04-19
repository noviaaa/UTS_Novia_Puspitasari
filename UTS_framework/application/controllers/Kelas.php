<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function index()
	{
		$this->load->model('kelas_model');
		$data["kelas_list"] = $this->kelas_model->getDataKelas();
		$this->load->view('kelas',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation'); //untuk form validasi
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');//trim memo
		
		$this->load->model('kelas_model');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_kelas_view');
		}
		else{
			$this->kelas_model->insertKelas();
			redirect('kelas');
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

		$this->kelas_Model->deleteKelas($id);	
		if($this->form_validation->run()==FALSE){
				redirect('kelas');
			}
	}
}
	
/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */
 ?>