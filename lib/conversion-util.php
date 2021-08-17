<?php
class Converter {
	public function bdayToAge($bday) {
		$db = new Database();
		$db->query("CALL calculate_age(?, @age)");
		$db->bind(1, $bday);
		$db->execute();

		$db->query("SELECT @age");
		return $db->resultColumn();
	}

	public function shortToLongDate($date, $datetime) {
		if (isset($date)) {
			$time_stamp = strtotime($date);
			$format = "M. j, Y";
		}
		else {
			$time_stamp = strtotime($datetime);
			$format = "M. j, Y \\a\\t g:i A";
		}
		$formatted_date = date($format, $time_stamp);
		if (strpos($formatted_date, "May") !== false)
			$formatted_date = str_replace(".", "", $formatted_date);
		return $formatted_date;
	}
}