<?php
class FilesHelper
{
	public static function fileExt($file,$uc = true,$last = true)
	{
		$parts = explode('.',$file);
		if(count($parts)>2) {
			if($last) {
				$ext = $parts[count($parts)-1];
			} else $ext = array($parts[count($parts)-2],$parts[count($parts)-1]);
		} else $ext = $parts[count($parts)-1];

		if(is_array($ext)) {
			foreach($ext as &$x) {
				if($uc) $x = strtoupper($x); else $x = strtolower($x);
			}
		} else {
			if($uc) $ext = strtoupper($ext); else $ext = strtolower($ext);
		}
		return $ext;
	}

	public static function fileBaseName($file)
	{
		//remove directories
		$parts = explode('/',$file);
		$file = $parts[count($parts)-1];
		$parts = explode('.',$file);
		unset($parts[count($parts)-1]);
		return implode('.',$parts);
	}

	public static function fileDirPath($path)
	{
		$pos = strrpos($path,'/');
		return substr($path,0,$pos+1);
	}

	public static function scandirByExt($path,$extensions = array())
	{
		$result = array();

		if(is_dir(TL_ROOT . '/' . $path)) {
			$files = scandir(TL_ROOT . '/' . $path);

			foreach($files as $file) {
				if(!is_dir(TL_ROOT . '/' . $path.'/'.$file)) {
					$ext = explode('.',$file);
					$ext = strtolower($ext[count($ext)-1]);
					if(in_array($ext,$extensions,false)) $result[] = $file;
				}
			}
		}
		return $result;
	}

	public static function fileModTime($path)
	{
		if(file_exists(TL_ROOT . '/'. $path)) {
			return filemtime(TL_ROOT . '/'. $path);
		} else return false;
	}
}
?>
