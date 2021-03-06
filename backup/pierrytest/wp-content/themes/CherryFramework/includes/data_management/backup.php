<?php
	include_once ('../../../../../wp-load.php');
	include_once (PARENT_DIR . '/includes/data_management/pclzip.lib.php');
	$file_counter = 0;
	$all_file = 0;
	if (isset($_GET["theme_folder"])){ 
		$theme_folder = $_GET["theme_folder"];
	}

	create_zip ($theme_folder);

	function create_zip ($themeName){
		global $all_file;
		$all_themes_dir = str_replace('\\', '/', get_theme_root());
		$backup_dir = str_replace('\\', '/', WP_CONTENT_DIR).'/themes_backup';
		$zip_name = $backup_dir.$themeName.'.zip';
		$file_string = scan_dir($all_themes_dir.$themeName, array('.', '..', '.svn', 'thumbs.db'));
		$all_file = substr_count($file_string, ",");

		if(!is_dir($backup_dir)){
			if(mkdir($backup_dir, 0700)){
				$htaccess_file = fopen($backup_dir.'/.htaccess', 'a');
				$htaccess_text = 'deny from all';
				fwrite($htaccess_file, $htaccess_text);
				fclose($htaccess_file);
			}
		}

		$zip = new PclZip($zip_name);
		if ($zip->create($file_string, PCLZIP_OPT_REMOVE_PATH, $all_themes_dir.$themeName) == 0) {
			die("Error : ".$zip->errorInfo(true)); 
		}
	}
	function scan_dir ($dir, $exceptions_array){
		$scand_dir = scandir($dir);
		$scan_dir_string = array();
		foreach ($scand_dir as $file) {
			if(!in_array(strtolower($file), $exceptions_array)){
				$scan_file = $dir.'/'.$file;
				if(is_dir($scan_file)){
					$scan_file= scan_dir ($scan_file, $exceptions_array);
				}
				array_push($scan_dir_string, $scan_file);
			}
		}
		return implode(',', $scan_dir_string);
	}
?>