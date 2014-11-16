<?php
namespace Home\Controller;
use Think\Upload;
use Think\Image;

class FileController extends HomeController {
	//图片上传测试
	public function upload() {
		$Upload = new Upload();
		$Upload->rootPath = C('UPLOAD_PATH');
		$Upload->maxSize = 1048579;
		$info = $Upload->upload();
		if ($info) {
			$imgPath = C('UPLOAD_PATH').$info['Filedata']['savepath'].$info['Filedata']['savename'];
			$image = new Image();
			$image->open($imgPath);
			$thumbPath = C('UPLOAD_PATH').$info['Filedata']['savepath'].'180_'.$info['Filedata']['savename'];
			$image->thumb(180, 180)->save($thumbPath);
			$image->open($imgPath);
			$unfoldPath = C('UPLOAD_PATH').$info['Filedata']['savepath'].'550_'.$info['Filedata']['savename'];
			$image->thumb(550, 550)->save($unfoldPath);
			$imageArr = array(
				'thumb'=>$thumbPath,
				'unfold'=>$unfoldPath,
				'source'=>$imgPath,
			);
			$this->ajaxReturn($imageArr);
		} else {
			echo $Upload->getError();
		}
	}
}