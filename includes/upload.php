<?php
	class Media{
		public $imageInfo;
		public $fileName;
		public $fileType;
		public $fileTempPath;
		public $empPath=SITE_ROOT.DS.'..'.DS.'uploads/employees';
		public $userPath=SITE_ROOT.DS.'..'.DS.'uploads/users';
		public $productPath=SITE_ROOT.DS.'..'.DS.'uploads/products';
		public $errors=array();
		public $upload_errors=array(
			0=>'Sin errores, el archivo subido se actualizó correctamente.',
			1=>'El archivo subido excede la directiva del tamaño máximo en php.ini.',
			2=>'El archivo subido excede el tamaño máximo especificado en el formulario HTML.',
			3=>'El archivo subido fue actualizado parcialmente.',
			4=>'Ningun archivo fue subido.',
			6=>'Desconocida la carpeta temporal.',
			7=>'Error al escribir el archivo en el disco.',
			8=>'Una extension PHP paró la subida del archivo.'
		);
		public $upload_extensions=array('gif','jpg','jpeg','png');
		public function file_ext($filename){
			$ext=strtolower(substr($filename,strrpos($filename,'.')+1));
			if(in_array($ext,$this->upload_extensions)){
				return true;
			}
		}
		public function upload($file){
			if(!$file||empty($file)||!is_array($file)):
				$this->errors[]="Ningún archivo subido.";
				return false;
			elseif($file['error']!=0):
				$this->errors[]=$this->upload_errors[$file['error']];
				return false;
			elseif(!$this->file_ext($file['name'])):
				$this->errors[]='Formato de archivo incorrecto.';
				return false;
			else:
				$this->imageInfo=getimagesize($file['tmp_name']);
				$this->fileName=basename($file['name']);
				$this->fileType=$this->imageInfo['mime'];
				$this->fileTempPath=$file['tmp_name'];
				return true;
			endif;
		}
		public function process(){
			if(!empty($this->errors)):
				return false;
			elseif(empty($this->fileName)||empty($this->fileTempPath)):
				$this->errors[]="La ubicación del archivo no esta disponible.";
				return false;
			elseif(!is_writable($this->productPath)):
				$this->errors[]=$this->productPath."Debe tener permisos de escritura.";
				return false;
			elseif(file_exists($this->productPath."/".$this->fileName)):
				$this->errors[]="El archivo {$this->fileName} ya existe.";
				return false;
			else:
				return true;
			endif;
		}
		public function process_media(){
			if(!empty($this->errors)){
				return false;
			}
			if(empty($this->fileName)||empty($this->fileTempPath)){
				$this->errors[]="La ubicación del archivo no se encuenta disponible.";
				return false;
			}
			if(!is_writable($this->productPath)){
				$this->errors[]=$this->productPath."Debe tener permisos de escritura.";
				return false;
			}
			if(file_exists($this->productPath."/".$this->fileName)){
				$this->errors[]="El archivo {$this->fileName} ya existe.";
				return false;
			}
			if(move_uploaded_file($this->fileTempPath,$this->productPath.'/'.$this->fileName)){
				if($this->insert_media()){
					unset($this->fileTempPath);
					return true;
				}
			}else{
				$this->errors[]="Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
				return false;
			}
		}
		public function process_user($id){
			if(!empty($this->errors)){
				return false;
			}
			if(empty($this->fileName)||empty($this->fileTempPath)){
				$this->errors[]="La ubicación del archivo no esta disponible.";
				return false;
			}
			if(!is_writable($this->userPath)){
				$this->errors[]=$this->userPath."Debe tener permisos de escritura.";
				return false;
			}
			if(!$id){
				$this->errors[]="ID de usuario ausente.";
				return false;
			}
			$ext=explode(".",$this->fileName);
			$new_name=randString(8).$id.'.'.end($ext);
			$this->fileName=$new_name;
			if($this->user_image_destroy($id)){
				if(move_uploaded_file($this->fileTempPath,$this->userPath.'/'.$this->fileName)){
					if($this->update_userImg($id)){
						unset($this->fileTempPath);
							return true;
					}
				}else{
					$this->errors[]="Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
					return false;
				}
			}
		}
		private function update_userImg($id){
			global $db;
			$sql="UPDATE users SET";
			$sql.=" image='{$db->escape($this->fileName)}'";
			$sql.=" WHERE id='{$db->escape($id)}'";
			$result=$db->query($sql);
			return ($result&&$db->affected_rows()===1 ? true:false);
		}
		public function user_image_destroy($id){
			$image=find_by_id('users',$id);
			if($image['image']==='no_image.jpg'){
				return true;
			}else{
				unlink($this->userPath.'/'.$image['image']);
				return true;
			}
		}
		public function process_emp(){
		    if(!empty($this->errors)){
		        return false;
		    }
		    if(empty($this->fileName)||empty($this->fileTempPath)){
		        $this->errors[]="La ubicación del archivo no se encuenta disponible.";
		        return false;
		    }
		    if(!is_writable($this->empPath)){
		        $this->errors[]=$this->productPath."Debe tener permisos de escritura.";
		        return false;
		    }
		    if(file_exists($this->empPath."/".$this->fileName)){
		        $this->errors[]="El archivo {$this->fileName} ya existe.";
		        return false;
		    }
		    if(move_uploaded_file($this->fileTempPath,$this->empPath.'/'.$this->fileName)){
		        if($this->insert_media(1)){
		            unset($this->fileTempPath);
		            return true;
		        }
		    }else{
		        $this->errors[]="Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
		        return false;
		    }
		}
		private function update_empImg($id){
		    global $db;
		    $sql="UPDATE employees SET";
		    $sql.=" image='{$db->escape($this->fileName)}'";
		    $sql.=" WHERE id='{$db->escape($id)}'";
		    $result=$db->query($sql);
		    return ($result&&$db->affected_rows()===1 ? true:false);
		}
		public function emp_image_destroy($id){
		    $image=find_by_id('employees',$id);
		    if($image['image']==='no_image.jpg'){
		        return true;
		    }else{
		        unlink($this->empPath.'/'.$image['image']);
		        return true;
		    }
		}
		private function insert_media($dest=0){
			global $db;
			$destino = "";
			if($dest == 1){$destino="employees";}
			$sql="INSERT INTO media ( file_name,file_type,file_destino)";
			$sql.=" VALUES ";
			$sql.="('{$db->escape($this->fileName)}','{$db->escape($this->fileType)}','{$db->escape($destino)}')";
			return ($db->query($sql) ? true : false);
		}
		public function media_destroy($id,$file_name){
			$this->fileName=$file_name;
			if(empty($this->fileName)){
				$this->errors[]="Falta el archivo de foto.";
				return false;
			}
			if(!$id){
				$this->errors[]="ID de foto ausente.";
				return false;
			}
			if(delete_by_id('media',$id)){
				unlink($this->productPath.'/'.$this->fileName);
				return true;
			}else{
				$this->error[]="Se ha producido un error en la eliminación de fotografías.";
				return false;
			}
		}
	}
?>