<?php
	function clean_form($str)
		{
			$str = strip_tags($str, "<a>");
			$str = str_replace("\n", "<br />", $str);
			$str = str_replace("''", "'", $str);
			return $str;
		}
	
	function upload_clean($str)
		{
			$str = strip_tags($str, "<a>");
			$str = str_replace("'", "\'", $str);
			$str = str_replace("\"", "\\\"", $str);
			return $str;
		}
		
	
	function validate_email($email)
		{
		        return (true);
			$exp = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
			if(eregi($exp,$email))
				{
					return true;
				}
			else 
				return false;
		}
?>