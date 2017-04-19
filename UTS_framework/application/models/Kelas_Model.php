<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_Model extends CI_Model {

	public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataKelas()
		{
			$this->db->select("id,nama");
			$query = $this->db->get('kelas');
			return $query->result();
		}

		public function getSiswaByKelas($idKelas)
		{
			$this->db->select("kelas.nama as namaKelas, siswa.nama as namaSiswa, DATE_FORMAT(siswa.tanggal_lahir,'%d-%m-%Y') as tanggal_lahir, siswa.foto as foto");
			$this->db->where('fk_kelas', $idKelas);	
			$this->db->join('kelas', 'kelas.id = siswa.fk_kelas', 'left');	
			$query = $this->db->get('siswa');
			return $query->result();
		}

		public function insertKelas()
		{
			$object = array('nama'  => $this->input->post('nama'));
			$this->db->insert('kelas', $object);
		}


		public function getKelas($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('kelas',1);
			return $query->result();

		}

		public function updateById($id)
		{
			$data = array('nama' => $this->input->post('nama'));
			$this->db->where('id', $id);
			$this->db->update('kelas', $data);
		}

		public function deleteKelas($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('kelas');
		}

}

/* End of file Kelas_Model.php */
/* Location: ./application/models/Kelas_Model.php */
 ?>