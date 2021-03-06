<?php
namespace Team1\GiftwrapSlider\Model\ResourceModel;


class Giftwrap extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('team1_giftwrapslider_giftwrap', 'giftwrap_id');
	}
	
}