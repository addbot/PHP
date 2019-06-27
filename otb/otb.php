<?php
/***************************************************************************
 * Filename  : otb.php
 * Purpose   : This is the main class file which contains the main functions
 * of all the job related processes in the system.
 * This code is part of the request from otb company. c/0 Abi Hart
 * Author(s) : marvin
 * Date      : Date(June 27 2019)
 ****************************************************************************/

class Otb {

	/**
	 * constructor to execute commands for 
     * jobs objects
	 * @return type
	 */
	public function __construct() {
		$this->getjobs();
	}

    public function getJobs($job = null): string {

        $sequence = 'a';
        if (!is_null($job)) {
            if (is_array($job)) {
                if (count($job) == 1) {
                    $jobStr = implode(',',$job);
                    $sequence = $jobStr;
                } else if (count($job) > 1) {
                    echo 'here';exit;
                    if (in_array('c', $job)) {

                    } else {
                        $sequence = 'abc';
                    }

                }
                
            } else if (is_string($job)) {
                $jobArr = explode(",",$job);
            }

        } 
        s($sequence);
        return $sequence;

    }

}



?>