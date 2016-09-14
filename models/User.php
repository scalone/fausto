<?php //namespace FatecFranca\ADS8N;

require_once("../classes/BaseModel.php");

class User extends BaseModel {

	protected function initAttributes() {
		$this->addAttribute('id'        , DataType::INTEGER , 'User ID');
		$this->addAttribute('name'      , DataType::STRING  , 'Name'          , 30);
		$this->addAttribute('last_name' , DataType::STRING  , 'Last Name'     , 30);
		$this->addAttribute('username'  , DataType::STRING  , 'User Name'     , 20);
		$this->addAttribute('password'  , DataType::STRING  , 'Password Hash' , 32);
	}

	protected function getTableName() {
		return 'users';
	}

	protected function getPkName() {
		return 'id';
	}
}
?>
