<?php
/**
 * GearmanWorker
*/
$worker = new GearmanWorker();
$worker->addServer('192.168.8.180','4730');
$worker->addFunction('client_func','echo_function');
while ($worker->work());
function echo_function($job)
{
	//return $job->returnCode();
	return strrev($job->workload()).'----';
}
