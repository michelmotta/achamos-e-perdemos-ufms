<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\Utility\Text;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

class UploadComponent extends Component{

	public $max_files = 3;

	public function uploadFiles( $data )
	{
		if (!empty($data)) {
			if (count($data) > $this->max_files) {
				throw new NotFoundException("Error Processing Request, max number files accepted is {$this->max_files}", 1);
			}
			$response = array();
			foreach ($data as $file) {
				$filename = $file['name'];
				$file_tmp_name = $file['tmp_name'];
				$dir = WWW_ROOT . 'img' . DS . 'uploads';
				$allowed = array('png','jpg', 'jpeg', 'bmp');
				if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
					throw new Exception("Error Processing Request", 1);
				}elseif (is_uploaded_file($file_tmp_name)) {
					$filename = Text::uuid() . '-' . $filename;
					move_uploaded_file($file_tmp_name, $dir.DS.$filename);
					array_push($response, $filename);
				}
			}
		}

		return $response;
	}
}