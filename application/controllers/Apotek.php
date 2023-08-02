<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apotek extends CI_Controller {
	public $data;

	private $bingMapsAPIKey = "AuPkBhRU1tlp5gG2Vki8-LpP7ooPssnBv_MQ_u1BNoPXIWZiY7AF_3BVvpLQz7XC";

	public function __construct() {
		parent::__construct();
		$this->load->model("apotek_model");

		$this->load->library('session');
		$this->load->library('all_controllers');
    }

	private function singularDistanceMatrix($origin, $destination) {
		# documentation: https://learn.microsoft.com/en-us/bingmaps/rest-services/routes/calculate-a-distance-matrix
		$base = "https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?origins=".$origin."&destinations=".$destination;
		$base .= "&travelMode=driving&key=".$this->bingMapsAPIKey;

		return file_get_contents($base);
	}

	private function DistanceMatrix($origins, $destinations) {
		# documentation: https://learn.microsoft.com/en-us/bingmaps/rest-services/routes/calculate-a-distance-matrix
		$base = "'https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix";

		$base .= "?origins=";
		for( $i = 0; $i < count($origins); $i ++ ) {
			if( $i >= 0 && $i < count($origins)-1 ) {
				$base .= $origins[$i][0].",".$origins[$i][1].";";
			}else { // Last index
				$base .= $origins[$i][0].",".$origins[$i][1];
			}
		}

		$base .= "&destinations=";
		for( $i = 0; $i < count($destinations); $i ++ ) {
			if( $i >= 0 && $i < count($destinations)-1 ) {
				$base .= $destinations[$i][0].",".$destinations[$i][1].";";
			}else { // Last index
				$base .= $destinations[$i][0].",".$destinations[$i][1];
			}
		}

		return file_get_contents($base.'&travelMode=driving&key='.$this->bingMapsAPIKey);
	}

	/**
	 * Get travel distance in meters and travel duration in seconds from calculated distance matrix
	 *
	 * Internal method used to retrieve travelDistance and travelDuration from result array.
	 *
	 * @param	string	$origin			A string with "$lat,$long" format
	 * @param	string	$destination	A string with "$lat,$long" format
	 * @return	array	with a prediction and calculated value of travelDistance with the distance in meters and predicted value of the travelDuration corresponding to the traffic in minutes
	 */
	private function getTravelDistanceAndDuration($origin, $destination) {
		$temp = json_decode($this->singularDistanceMatrix($origin=$origin, $destination=$destination), $associative=true);
		$temp = $temp["resourceSets"][0]["resources"][0]["results"][0];
		return [
			"travelDistance" => $temp["travelDistance"],
			"travelDuration" => $temp["travelDuration"]
		];
	}

	private function approximateLocation($query) {
		# docs: https://learn.microsoft.com/en-us/bingmaps/rest-services/locations/find-a-location-by-query#url-template
		$base = "http://dev.virtualearth.net/REST/v1/Locations/".urlencode($query)."?o=json&key=".$this->bingMapsAPIKey;
		return json_decode(file_get_contents($base), $associative=true)["resourceSets"][0]["resources"][0];
	}

	public function findNearest() {
		if($this->input->post("get_all")) {
			$temp = $this->db->query("SELECT master_apotek.id, master_apotek.nama as text FROM master_apotek")->result_array();
			for($i = 0; $i < count($temp); $i ++) {
				$temp[$i]["text"] = $temp[$i]["id"]." - ".$temp[$i]["text"];
			}

			echo json_encode(array(
				'incomplete_results' => false,
				'items' => $temp,
				'total' => count($temp) // Total rows without LIMIT on SQL query
			)); exit();
		}

		$id_kota		=	$this->input->post("id_kota");
		$id_kecamatan 	=	$this->input->post("id_kecamatan");
		$lat			=	$this->input->post("lat");
		$long			=	$this->input->post("long");

		$searchTerm	= $this->input->post('searchTerm');
		$pglm 		= $this->input->post("page_limit");
		$page_lim	= (empty($pglm) ? 10 : $pglm);
		$pg 		= $this->input->post("page");
		$page 		= (empty($pg) ? 0 : $pg);
		$limit 		= $page * $page_lim;

		$query = "SELECT master_apotek.id, master_apotek.nama as text, master_apotek.latitude, master_apotek.longitude FROM master_apotek WHERE master_apotek.alamat_kota=".$id_kota;

		if ($searchTerm) {
			$query 	.= "AND master_apotek.nama LIKE '%" . $searchTerm . "%' LIMIT $limit , $page_lim ;";
		}

		$apotek = $this->db->query($query)->result_array();
		$total	= $this->apotek_model->get_all();

		if( $apotek != null ) {
			if( ($lat == null && $long == null) ) {
				if($id_kecamatan != null) {
					$executable_query = "SELECT master_kecamatan.name FROM master_kecamatan WHERE master_kecamatan.id=".$id_kecamatan;
					$kecamatan = $this->db->query($executable_query)->result()[0]->name;

					[$lat, $long] = $this->approximateLocation($kecamatan)["point"]["coordinates"];
				}else {
					$executable_query = "SELECT master_kota.name FROM master_kota WHERE master_kota.id=".$id_kota;
					$kota = $this->db->query($executable_query)->result()[0]->name;

					[$lat, $long] = $this->approximateLocation($kota)["point"]["coordinates"];
				}
			}

			for( $i = 0; $i < count($apotek); $i ++ ) {
				$origin			= $lat.",".$long;
				$destination	= $apotek[$i]["latitude"].",".$apotek[$i]["longitude"];

				$distanceAndDuration = $this->getTravelDistanceAndDuration($origin=$origin, $destination=$destination);

				$apotek[$i]["distanceAndDuration"] = $distanceAndDuration;
				$apotek[$i]["text"] .= " - ±".$distanceAndDuration["travelDistance"]. " km dari lokasi pasien";
			}

			# Sorting (ASC) an associative array
			usort($apotek, function ($item1, $item2) {
				return $item1['distanceAndDuration']["travelDistance"] <=> $item2['distanceAndDuration']["travelDistance"];
			});
		}

		echo json_encode(array(
            'incomplete_results' => false,
            'items' => $apotek,
            'total' => count($total) // Total rows without LIMIT on SQL query
        ));
	}

	public function getApotek() {
		$id_apotek		= $this->input->post("id_apotek");

		$id_provinsi 	= $this->input->get("id_provinsi");
		$id_kota 		= $this->input->get("id_kota");
		$id_kecamatan 	= $this->input->get("id_kecamatan");
		$id_kelurahan 	= $this->input->get("id_kelurahan");

		$return			= $this->input->get("return");

		$query 	= 'SELECT * FROM master_apotek WHERE master_apotek.aktif=1';

		if($id_apotek)   	{$query .= "AND master_apotek.id=".$id_apotek;}
		// if($id_provinsi) 	{$query .= "AND master_apotek.alamat_provinsi=".$id_provinsi;}
		// if($id_kota) 		{$query .= "AND master_apotek.alamat_kota=".$id_kota;}
		// if($id_kecamatan)	{$query .= "AND master_apotek.alamat_kecamatan=".$id_kecamatan;}
		// if($id_kelurahan)	{$query .= "AND master_apotek.alamat_kelurahan=".$id_kelurahan;}

		if($return == "json") {
			$searchTerm	= $this->input->get('searchTerm');
			$pglm 		= $this->input->get("page_limit");
			$page_lim	= (empty($pglm) ? 10 : $pglm);
			$pg 		= $this->input->get("page");
			$page 		= (empty($pg) ? 0 : $pg);
			$limit 		= $page * $page_lim;
			$cnt 		= $this->db->query("select id from master_apotek WHERE aktif = 1")->result();

			$query 	.= "AND master_apotek.nama LIKE '%" . $searchTerm . "%' LIMIT $limit , $page_lim ;";

			$list_apotek = $this->db->query($query)->result_array();

			$result = array(
				'incomplete_results' => false,
				'items' => $list_apotek,
				'total' => count($cnt) // Total rows without LIMIT on SQL query
			);
		}else  {
			$result = $this->db->query($query)->result_array();
		}

		echo $result;
	}

	public function getApotekOnUser() {
		//$id_apotek = $this->input->post('id_apotek');
		$id_user = $this->input->post("id_user");
		// if($id_apotek){
		// 	$list_apotek = $this->db->query('SELECT * FROM master_apotek ORDER BY nama')->result_array();
		// 	foreach($list_apotek as $idx=>$apotek){
		// 			if($id_apotek == $apotek['id']){
		// 				$list_apotek[$idx]['selected'] = 'selected';
		// 			}
		// 			else{
		// 				$list_apotek[$idx]['selected'] = '';
		// 			}
		// 	}

		// }
		// else{
			if($id_user){
				$user = $this->db->query('SELECT id_apotek FROM master_user WHERE id = '.$id_user)->row();
				if(!$user){
					show_404();
				}
			}
			$list_apotek = $this->db->query('SELECT * FROM master_apotek ORDER BY nama')->result_array();
			if($id_user){
				foreach($list_apotek as $idx=>$apotek){
					if($user->id_apotek == $apotek['id']){
						$list_apotek[$idx]['selected'] = 'selected';
					}
					else{
						$list_apotek[$idx]['selected'] = '';
					}
				}
			}

		echo json_encode($list_apotek);
	}

	public function getAll() {
		$allApotek = $this->db->query("SELECT * FROM master_apotek")->result_array();
		echo json_encode($allApotek);
	}
}
