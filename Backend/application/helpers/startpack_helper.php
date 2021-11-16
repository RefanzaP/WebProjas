<?php 

	function kel(){
		$CI = & get_instance();

		$kel = $CI->db->select('id_kel, ket')->get('j_kel')->result_array();
		foreach ($kel as $j_kel) {
			$list[$j_kel['id_kel']] = $j_kel['ket'];
		}
		return $list;
	}

	function status(){
		$CI = & get_instance();

		$status = $CI->db->select('id_status, ket')->get('status')->result_array();
		foreach ($status as $stts) {
			$list[$stts['id_status']] = $stts['ket'];
		}
		return $list;
	}

	function group(){
		$CI = & get_instance();

		$status = $CI->db->select('id_group, ket')->get('group_m')->result_array();
		foreach ($status as $stts) {
			$list[$stts['id_group']] = $stts['ket'];
		}
		return $list;
	}

?>