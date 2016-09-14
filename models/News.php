<?php //namespace FatecFranca\ADS8N;

require_once("classes/BaseModel.php");

class News extends BaseModel {

	protected function initAttributes() {
		$this->addAttribute('id', DataType::INTEGER, 'News ID');
		$this->addAttribute('title', DataType::STRING, 'Feature', 200);
		$this->addAttribute('created_at', DataType::DATE_TIME, 'Date/Time');
		$this->addAttribute('body', DataType::STRING, 'News body');
		$this->addAttribute('user_id', DataType::INTEGER, 'User ID');
	}

	protected function getTableName() {
		return 'news';
	}

	protected function getPkName() {
		return 'news_id';
	}
}

?>