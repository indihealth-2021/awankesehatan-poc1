<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class All_model extends CI_Model {


    // NEWS //
    public function get_news($limit, $start, $where = ''){
        if($where != ''){
            $where = ' WHERE judul LIKE "%'.$where.'%"';
        }
        $query = $this->db->query('SELECT * FROM data_news'.$where.' LIMIT '.$limit.' OFFSET '.$start)->result();
        return $query;
    }

    public function select($table, $result = 'row', $where = NULL, $limit = NULL, $offset = NULL, $order = 'desc') {
        if (!is_null($where))  $this->db->where($where);

        if ($order == 'asc') {
            $this->db->order_by('id' . $order);
        } else {
            $this->db->order_by('created_at ' . $order);    
        }

        $query = $this->db->get($table, $limit, $offset);

        if ($result !== 'row') {
            return $query->result();
        }
		// echo var_dump($query);
		// die;
       // return $this->db->last_query();
        return $query->row();
    }
    public function select_union($status,$id_pasien){
         $hasil = $this->db->query("select * from no_antrian where status=".$status." union select * from no_antrian where id_pasien=".$id_pasien);         
         return $hasil->result();
    }
    public function select_total($id_dokter){
        $this->db->select('no_antrian.*');
        $this->db->from('no_antrian'); 
        $this->db->where('id_dokter',$id_dokter);
        $query = $this->db->get();
        //return $this->db->last_query();
        // $hasil =$query->result();                
         return $query;
    }

    public function select_data_tele($select, $table, $result = 'row', $where = NULL, $join = NULL) {
        $this->db->select($select);
        $this->db->from($table);

        if (!is_null($where))  $this->db->where($where);
        if (!is_null($join))  $this->db->join($join[0], $join[1]);

        $query = $this->db->get();

        if ($result !== 'row') {
            return $query->result();
        }

        return $query->row();
    }
    public function update_($set, $where, $table)
    {
        $this->db->set($set);
        $this->db->where($where);
        $update = $this->db->update($table);
        return $update;
    }
    public function update($table, $data, $where) {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($table, $where) {
        $this->db->delete($table, $where);

        return $this->db->affected_rows();
    }

    public function delete_no_child($table, $join, $foreign_key, $where) {
        $query = 'DELETE ' . $table . ' FROM '. $table . ' 
                    LEFT JOIN ' . $join . ' on ' . $table . '.id = ' . $join . '.' . $foreign_key . '
                  WHERE ' . $join . '.id IS NULL AND ' . $where;
        
        $this->db->query($query);
        
        return $this->db->affected_rows();
    }

    public function empty_table($table) {
        $this->db->empty_table($table);

        return $this->db->affected_rows();
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);   
      // return $this->db->last_query();
        return $this->db->affected_rows();
    }
    public function insert_($table, $data) {
        $this->db->insert($table, $data);   
        return $this->db->insert_id();
    }

    public function insert_batch($table, $data) {
        $this->db->insert_batch($table, $data);
//return $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function db_replace() {
        $this->db->replace('table', $data);

        return $this->db->affected_rows();
    }

    public function get_aktif_fasyankes($id_fasyankes) {
        $this->db->select('master_fasyankes.*');

        $this->db->from('master_fasyankes');
        $this->db->join('master_kota', 'master_fasyankes.id_kota = master_kota.id');
        $this->db->join('master_provinsi', 'master_kota.id_provinsi = master_provinsi.id');

        $this->db->where('master_fasyankes.aktif', 1);
        $this->db->where('master_kota.aktif', 1);
        $this->db->where('master_provinsi.aktif', 1);

        if (! is_null($id_fasyankes)) {
            $this->db->where('master_fasyankes.id', $id_fasyankes);

        }

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }
    public function get_history_pembayaran($id_dokter){        
        $this->db->select('(master_user.name) as dokter ,(master_specialist.name) as poli,(bukti_pembayaran.created_at) as tgl,(bukti_pembayaran.`status`) as bayar');        
        $this->db->from('master_user');
         $this->db->join('bukti_pembayaran', 'bukti_pembayaran.id_dokter = master_user.id');
        $this->db->join('data_poli', 'data_poli.id_dokter = master_user.id');       
         $this->db->join('master_specialist', 'data_poli.id_poli = master_specialist.id');
         $this->db->where('master_user.id', $id_dokter);
          $query = $this->db->get();       
      //  return $this->db->last_query();
        return $query->result();

    }
    public function get_operation_access($category_id, $page_id) {
        $this->db->select('app_operation.*');

        $this->db->from('app_akses');

        $this->db->join('app_operation', 'app_akses.id_operation = app_operation.id');

        $this->db->where('app_operation.aktif', 1);
        $this->db->where('app_operation.id_page', $page_id);
        $this->db->where('app_akses.id_user_kategori', $category_id);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_group_access($position_id, $category_id) {
        $this->db->select('app_page_group.*');

        $this->db->from('app_page_group');

        $this->db->join('app_position', 'app_page_group.id_position = app_position.id');
        $this->db->join('app_page', 'app_page_group.id = app_page.id_page_group');
        $this->db->join('app_operation', 'app_page.id = app_operation.id_page');
        $this->db->join('app_akses', 'app_operation.id = app_akses.id_operation');

        $this->db->where('app_position.aktif', 1);
        $this->db->where('app_page_group.aktif', 1);
        $this->db->where('app_page.aktif', 1);
        $this->db->where('app_operation.aktif', 1);
        $this->db->where('app_akses.id_user_kategori', $category_id);
        $this->db->where('app_page_group.id_position', $position_id);

        $this->db->group_by('app_page_group.id');

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function get_page_access($group_id, $category_id, $nama_group = null) {
        $this->db->select('app_page.*, app_layanan.id AS id_layanan');

        $this->db->from('app_page');
        $this->db->join('app_operation', 'app_page.id = app_operation.id_page');
        $this->db->join('app_akses', 'app_operation.id = app_akses.id_operation');
        $this->db->join('app_layanan', 'app_page.id = app_layanan.id', 'LEFT');

        $this->db->where('app_page.aktif', 1);
        $this->db->where('app_operation.aktif', 1);
        $this->db->where('app_akses.id_user_kategori', $category_id);
        $this->db->where('app_page.id_page_group', $group_id);

        $this->db->group_by('app_page.id');

        if (! is_null($nama_group) && strtolower($nama_group) == 'layanan') {
            $this->db->order_by('app_page.created_at asc');
        }

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function get_service_access($user_id) {
        $this->db->select('id_layanan');

        $this->db->from('data_akses_layanan');

        $this->db->where('id_user', $user_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function get_wilayah($table) {
        $this->db->select($table . '.id as value, ' . $table . '.nama as label');
        $this->db->from($table);

        if ($table == 'master_kota') {
            $this->db->join('master_provinsi', $table . '.id_provinsi = master_provinsi.id');
            $this->db->where('master_provinsi.aktif', 1);
        }

        $this->db->where($table . '.aktif', 1);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function data_table_pendaftaran($select, $from, $where = null, $join = null, $group_by = null) {
        $this->db->select($select);
        $this->db->from($from);
        $this->_where_join_pendaftaran($where, $join);
        $this->_filter();
        $this->_order();
        $this->db->limit($this->input->post('length'), $this->input->post('start'));

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function data_table_total_pendaftaran($select, $from, $filter = false, $where = null, $join = null, $group_by = null) {
        $this->db->select($select);
        $this->db->from($from);
        $this->_where_join_pendaftaran($where, $join);
        $this->_group($group_by);
        
        if ($filter == true) {
            $this->_filter();
        }

        $sql = $this->db->get_compiled_select();
        $result = $this->db->count_all_results('('.$sql.') as result', true);

        return $result;
    }

    private function _where_join_pendaftaran($where, $join) {
        if ( ! is_null($where)) {
            $this->db->like('id', $where);
            $this->db->or_like('no_identitas', $where);
            $this->db->or_like('nama', $where);
            $this->db->or_like('telp', $where);
        }

        if ( ! is_null($join)) {
            foreach ($join as $key => $value) {
                if (isset($value[2])) {
                    $this->db->join($value[0], $value[1], $value[2]);
                } else {
                    $this->db->join($value[0], $value[1]);
                }
            }
        }
    }

    public function data_table($select, $from, $where = null, $join = null, $group_by = null) {
        $this->db->select($select);
        $this->db->from($from);
        $this->_where_join($where, $join);
        $this->_filter();
        $this->_order();
        $this->db->limit($this->input->post('length'), $this->input->post('start'));

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function data_table_total($select, $from, $filter = false, $where = null, $join = null, $group_by = null) {
        $this->db->select($select);
        $this->db->from($from);
        $this->_where_join($where, $join);
        $this->_group($group_by);
        
        if ($filter == true) {
            $this->_filter();
        }

        $sql = $this->db->get_compiled_select();
        $result = $this->db->count_all_results('('.$sql.') as result', true);

        return $result;
    }

    private function _order() {
        $columns = $this->input->post('columns');
        $order = $this->input->post('order');
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $this->db->order_by($columns[$order_column]['data'], $order_dir);
    }

    private function _where_join($where, $join) {
        if ( ! is_null($where)) {
            $this->db->where($where);
        }

        if ( ! is_null($join)) {
            foreach ($join as $key => $value) {
                if (isset($value[2])) {
                    $this->db->join($value[0], $value[1], $value[2]);
                } else {
                    $this->db->join($value[0], $value[1]);
                }
            }
        }
    }

    private function _group($group_by) {
        if ( ! is_null($group_by)) {
            $this->db->group_by($group_by);
        }
    }

    private function _filter() {
        $columns = $this->input->post('columns');
        $search = $this->input->post('search');
        $filter = '';

        if ( ! empty($search['value'])) {
            foreach ($columns as $key => $value) {
                if ( ! is_numeric($value['data']) && ! empty($value['data']) && ! is_null($value['data'])) {
                    if ($key == 1) {
                        $filter .= $value['data'] . ' LIKE "%'. $search['value'] .'%" ESCAPE "!"';
                    } else {
                        $filter .= ' OR ' . $value['data'] . ' LIKE "%'. $search['value'] .'%" ESCAPE "!"';
                    }
                }
            }

            $this->db->having($filter);
        }
    }

    public function get_payment($where)
    {
        $this->db->select('bukti_pembayaran.*, b.name as name_dokter, c.name as name_pasien');
        $this->db->from('bukti_pembayaran');
        $this->db->join('master_user b', 'b.id = bukti_pembayaran.id_dokter', 'LEFT');
        $this->db->join('master_user c', 'c.id = bukti_pembayaran.id_pasien', 'LEFT');
        $this->db->where($where);
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_nominal($id = NULL)
    {
        $this->db->select('*');
        $this->db->from('nominal');
	if (!is_null($id)) $this->db->where('id',$id);
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_poli($id = NULL)
    {
        $this->db->select('data_poli.*, master_user.name as name_dokter, master_specialist.name as name_poli');
        $this->db->from('data_poli');
        $this->db->join('master_user', 'master_user.id = data_poli.id_dokter', 'LEFT');
        $this->db->join('master_specialist', 'master_specialist.id = data_poli.id_poli', 'LEFT');
	
	if (!is_null($id)) $this->db->where('data_poli.id', $id);
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_search($search)
    {
        $this->db->select('*');
        $this->db->from('data_news');
	$this->db->like('judul',$search);
        $result = $this->db->get()->result();
        return $result;
    }
}