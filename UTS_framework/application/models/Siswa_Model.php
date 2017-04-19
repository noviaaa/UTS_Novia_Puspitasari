<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_Model extends CI_Model {

 public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	
	
			public function getdatasiswa()
		{
			$this->db->select("id,nama,DATE_FORMAT(tanggal_lahir,'%d-%m-%Y') as tanggal_lahir, foto");
			$query = $this->db->get('siswa');
			return $query->result();
		}

		public function getsiswa($id)
		{
			$this->db->where('fk_kelas',$id);
			$query = $this->db->get('siswa');
			return $query->result();
		}

		public function insertsiswa()
		{
			$object = array(
				'nama' => $this->input->post('nama'),
                'id' => $this->input->post('id'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'foto' => $this->upload->data('file_name'),
                'fk_kelas' => $this->input->post('fk_kelas'),
				);
			$this->db->insert('siswa', $object);
		}


		public function getsiswaById($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('siswa',1);
			return $query->result();

		}

		public function updateById($id)
		{
			$object = array(
				'nama' => $this->input->post('nama'),
                'id' => $this->input->post('id'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'foto' => $this->upload->data('file_name'),
                'fk_kelas' => $this->input->post('fk_kelas')
				);
			$this->db->where('id', $id);
			$this->db->update('siswa', $object);
		}
		
		public function delete($id){
			$this->db->where('id',$id);
			$this->db->delete('siswa');
		}  


}

/* End of file Siswa_Model.php */
/* Location: ./application/models/Siswa_Model.php */

 ?>