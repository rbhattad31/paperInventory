<?php
class PerformanceFilter extends CFilter
{
	
	private $startTime;
	
	protected function preFilter($filterChain)
	{
		$this->startTime=time();
		// logic being applied before the action is executed
		return true; // false if the action should not be executed
	}

	protected function postFilter($filterChain)
	{
		
		$since_start = time() - $this->startTime;
		//$str = $since_start->format('s');
		Yii::log("Time taken for executing action ".strlen($since_start)." seconds", 'info');
		// logic being applied after the action is executed
	}
}