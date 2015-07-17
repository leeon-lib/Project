<?php

/**
* 采购管理控制器
*/
class PurchaseController extends AuthController
{
	
	/**
	 * 采购单列表
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 添加采购单
	 */
	public function add()
	{
		// 公共配置文件中定义的‘销售方式’
		$saleType = C('SALE_TYPE');
		$warehouseList = M('warehouse')->all();
		$supplierList = M('supplier')->all();
		$this->assign('warehouseList', $warehouseList);
		$this->assign('supplierList', $supplierList);
		$this->assign('saleType', $saleType);
		$this->display();
	}


	/**
	 * 添加采购单
	 */
	public function operate()
	{
		if (4 == $_FILES['csv']['error'])
		{
			$this->error('请提交采购单文件！');
		}
		$supplierId = (int)Q('post.supplier_id');
		$warehouseId = (int)Q('post.warehouse_id');
		$saleType = (int)Q('post.sale_type');

		$filePath = $this->uploadCsv();
		$fp = fopen($filePath, 'r');
		$list = array();
		while ($data = fgetcsv($fp)) {
			// p($data);echo '<br />';
			$list[] = $data;
		}
		p($list);
		die;
	}

	/**
	 * 下载采购单模板
	 */
	public function downCsv()
	{
		$fileName = C('UPLOAD_PATH') . 'Files/purchase_import.csv';
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=product_import.csv');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: ' . filesize($fileName));
		readfile($fileName);
	}

	/**
	 * 采购文件上传
	 */
	public function uploadCsv()
	{
		$upObj = new Upload(C('UPLOAD_PATH') . '/Purchase/', array('csv'));
		$upFiles = $upObj->upload();
		if (empty($upFiles))
		{
			$this->error($upObj->error);
		} else {
			return $upFiles[0]['path'];
		}

	}

	/**
	 * 字符串转码
	 *
	 * @param mixed $var
	 */
	private function encoding($var)
	{
		if(is_string($var))
		{
			return iconv('gbk', 'utf-8', $var);
		}
		if(is_array($var))
		{
			foreach($var as $i => $v)
			{
				if(is_string($v))
				{
					$var[$i] = iconv('gbk', 'utf-8', $v);
				}
				else
				{
					$var[$i] = self::encoding($v);
				}
			}
			return $var;
		}
	}
}