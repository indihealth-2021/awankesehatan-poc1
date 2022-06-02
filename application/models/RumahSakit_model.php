<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RumahSakit_model extends CI_Model {
    public function get_user($id){
        $this->db->select('id,name,username,email,id_user_level,aktif');
        $this->db->from('master_user');
        $this->db->where('id_user_kategori = 6 AND id = '.$id);

        return $this->db->get()->row();
    }

    public function get_all_users(){
        $this->db->select('id,name,username,email,id_user_level,aktif');
        $this->db->from('master_user');
        $this->db->where('id_user_kategori = 6');
        $data = $this->db->get()->result();

        return $data;
    }

    public function insert_user($data){
        $user_data = array(
            'name'=>$data['name'],
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'id_user_kategori'=>6,
            'id_user_level'=>$data['id_user_level'],
            'aktif'=>$data['aktif']
        );

        return $this->db->insert('master_user', $user_data);
    }

    public function update_user($id, $data){
        $user_data = array(
            'name'=>$data['name'],
            'username'=>$data['username'],
            'email'=>$data['email'],
            'id_user_level'=>$data['id_user_level'],
            'aktif'=>$data['aktif']
        );

        $this->db->where('id_user_kategori = 6 AND id = '.$id);
        return $this->db->update('master_user', $user_data);
    }

    public function delete_user($id){
        $this->db->where('id',$id);
        return $this->db->delete('master_user');
    }
}