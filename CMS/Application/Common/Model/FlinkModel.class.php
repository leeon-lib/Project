<?php

/**
* 友情链接管理模型
*/
class FlinkModel extends Model
{
	public $table = 'flink';

	public $validate = array(
		array('fname','nonull','名称不能为空',2,3),
		array('url','nonull','链接地址不能为空',2,3),
		array('url','http','链接地址不合法',2,3),
	);

	public $auto = array(
		array('addtime','time','function',2,1),
		array('logo','_thumb','method',2,3),
		array('url','_url','method',2,3),
	);

	/**
	 * logo上传
	 */
	public function _thumb()
	{
		if (count($_FILES)) {
		// 如果是执行添加 
			if ($_FILES['logo']['error'] == 4) {
			// 如果没有上传文件
				$this->error = 'Logo没有上传';
			} else {
				$upload = new Upload();
				$files = $upload->upload();
				// 如果产生错误，则抛出错误并终止
				if (!$files) {
					$this->error = $upload->error;
					return false;
				}
				// 缩略
				$image = new Image();
				return $image->thumb($files[0]['path']);
			}
		} else {
		// 如果是执行编辑修改
			return $_POST['logo'];
		}
	}

	/**
	 * URL处理
	 */
	public function _url()
	{
		$url = Q('post.url');
		return 'http://' . $url . '/';
	}

	/**
	 * 添加、编辑修改友情链接
	 */
	public function intoFlink()
	{
		if (!$this->create()) return false;
		if ($this->error) return false;
		
		if (!array_key_exists('fid' , $_POST)) {
			$this->add();
		} else {
			$fid = (int)Q('post.fid');
			$this->where("fid={$fid}")->save();
		}
		return true;
	}
}