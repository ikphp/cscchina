<?php
/*
 * IKPHP爱客网 安装程序 @copyright (c) 2012-3000 IKPHP All Rights Reserved @author 小麦
* @Email:160780470@qq.com
*/
class settingAction extends backendAction {
	public function _initialize() {
		parent::_initialize ();
		$this->_mod = D ( 'setting' );
		$this->nav_mod = D('nav');
	}
	public function index() {
		$arrTime = $this->getZone();
		
		$this->title ( '站点设置' );
		$this->assign('arrTime', $arrTime);
      	$type = $this->_get('type', 'trim', 'index');
      	$this->assign('type', $type);
        $this->display($type);
	}
	public function url(){
		$this->title ( '链接形式' );
		$config_file = CONF_PATH . 'url.php';
		$config = require $config_file;
		if (IS_POST) {
			$url_model = $this->_post('url_model', 'intval', 0);
			
			$new_config = array(
					'URL_MODEL' => $url_model
			);
			if ($this->update_config($new_config, $config_file)) {
				$this->success(L('operation_success'));
			} else {
				$this->error(L('operation_failure'));
			}
		} else {
			$this->assign('config', $config);
			$this->display();
		}	
	}
	public function navlist(){
		$arrNav = $this->nav_mod->select();
		$this->assign('list',$arrNav);
		$this->title ( '网站导航设置' );
		$this->display();		
	}
	public function setnav(){
		$ik = $this->_get('ik');
		if($ik == 'add'){
			//添加
			if (IS_POST) {
				$id = $this->_post('id','trim','0');
				if(empty($id)){
					if (false === $this->nav_mod->create ()) {
						$this->error ( $this->nav_mod->getError () );
					}
					// 保存当前数据对象
					$aid = $this->nav_mod->add ();
					if ($aid !== false) { // 保存成功
						$this->redirect(U('setting/navlist'));
					}else{
						$this->error ( '新增失败!' );
					}
				}else{
					if (false === $this->nav_mod->create ()) {
						$this->error ( $this->nav_mod->getError () );
					}
					 $this->nav_mod->where(array('id'=>$id))->save();
					 $this->redirect(U('setting/navlist'));
				}

					
			} else {
				$this->title ( '添加网站导航' );
				$this->display();
			}
		}
		if($ik == 'edit'){
			$id = $this->_get('id');
			$strNav = $this->nav_mod->where(array('id'=>$id))->find();
			$this->assign('strNav',$strNav);
			$this->title ( '编辑网站导航' );
			$this->display();
		}
		if($ik == 'del'){
			$id = $this->_get('id');
			$strNav = $this->nav_mod->where(array('id'=>$id))->delete();
			$this->redirect(U('setting/navlist'));
		}
		

	}	
	public function edit() {
		$setting = $this->_post('setting', ',');
		foreach ($setting as $key => $val) {
			$val = is_array($val) ? serialize($val) : $val;
			$this->_mod->where(array('name' => $key))->save(array('data' => $val));
		}
		$type = $this->_post('type', 'trim', 'index');
		$this->success(L('operation_success'));
	}
	public function getZone() {
		return array (
				'-12' => '(GMT -12:00) Eniwetok, Kwajalein',
				'-11' => '(GMT -11:00) Midway Island, Samoa',
				'-10' => '(GMT -10:00) Hawaii',
				'-9' => '(GMT -09:00) Alaska',
				'-8' => '(GMT -08:00) Pacific Time (US & Canada), Tijuana',
				'-7' => '(GMT -07:00) Mountain Time (US & Canada), Arizona',
				'-6' => '(GMT -06:00) Central Time (US & Canada), Mexico City',
				'-5' => '(GMT -05:00) Eastern Time (US & Canada), Bogota, Lima, Quito',
				'-4' => '(GMT -04:00) Atlantic Time (Canada), Caracas, La Paz',
				'-3.5' => '(GMT -03:30) Newfoundland',
				'-3' => '(GMT -03:00) Brassila, Buenos Aires, Georgetown, Falkland Is',
				'-2' => '(GMT -02:00) Mid-Atlantic, Ascension Is., St. Helena',
				'-1' => '(GMT -01:00) Azores, Cape Verde Islands',
				'0' => '(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia',
				'1' => '(GMT +01:00) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome',
				'2' => '(GMT +02:00) Cairo, Helsinki, Kaliningrad, South Africa',
				'3' => '(GMT +03:00) Baghdad, Riyadh, Moscow, Nairobi',
				'3.5' => '(GMT +03:30) Tehran',
				'4' => '(GMT +04:00) Abu Dhabi, Baku, Muscat, Tbilisi',
				'4.5' => '(GMT +04:30) Kabul',
				'5' => '(GMT +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent',
				'5.5' => '(GMT +05:30) Bombay, Calcutta, Madras, New Delhi',
				'5.75' => '(GMT +05:45) Katmandu',
				'6' => '(GMT +06:00) Almaty, Colombo, Dhaka, Novosibirsk',
				'6.5' => '(GMT +06:30) Rangoon',
				'7' => '(GMT +07:00) Bangkok, Hanoi, Jakarta',
				'8' => '(GMT +08:00) 北京, 重庆, 香港, 乌鲁木齐',
				'9' => '(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo, Yakutsk',
				'9.5' => '(GMT +09:30) Adelaide, Darwin',
				'10' => '(GMT +10:00) Canberra, Guam, Melbourne, Sydney, Vladivostok',
				'11' => '(GMT +11:00) Magadan, New Caledonia, Solomon Islands',
				'12' => '(GMT +12:00) Auckland, Wellington, Fiji, Marshall Island' 
		);
	}
}