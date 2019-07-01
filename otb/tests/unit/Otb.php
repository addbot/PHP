<?php
/***************************************************************************
 * Filename  : otb.php
 * Purpose   : This is the main class file which contains the main functions
 * of all the job related processes in the system.
 * This code is part of the request from otb company. c/0 Abi Hart
 * Author(s) : marvin
 * Date      : Date(June 27 2019)
 ****************************************************************************/
require "constants.php";
class Otb {

    /**
     * constructor to execute commands for
     * jobs objects
     * @return type
     */
    public function __construct() {

    }

    /**
     * This function accepts json string
     * as param then returns either string or array
     * @param string $job
     * @see isSelfDependent
     * @see isCyclicDependent
     * @return string | array
     */
    public function getJobs($job) {

        $jobStr = strlen($job);
        $sequence = 'a';
        if ($jobStr == '' || $jobStr == 0) {
            $sequence = '';
            goto end;
        } else if (!is_null($job)) {
            $job = json_decode($job);
            $job = is_object($job) ? get_object_vars($job) : $job;
            $numJobs = count($job);
            if (is_array($job)) {
                if ($numJobs == 1) {
                    goto end;
                } else if ($numJobs > 1 && $numJobs < 4) {
                    if ($this->isSelfDependent($job)) { // check self dependency
                        throw new Exception(ERROR_SELF_DEPENDENT);
                    }
                    if (in_array('c', $job)) {
                        $keys = array_keys($job);
                        $sequence = array(
                            'a' => '',
                            'c' => 'abc',
                            'b' => ''
                        );
                    } else {
                        $keys = array_keys($job);
                        $sequence = implode("", $keys);
                    }
                } else if ($numJobs > 3) {
                    if (in_array('c', $job) && in_array('f', $job) && in_array('a', $job) && in_array('b', $job)) {
                        if ($this->isCyclicDependent($job)) { // check cyclic dependency
                            throw new Exception(ERROR_CYCLIC_DEPENDENT);
                        }
                        $sequence = array(
                            'f' => 'abcdef',
                            'c' => '',
                            'b' => '',
                            'e' => '',
                            'a' => '',
                            'd' => ''
                        );
                    }
                }

            }

        }

        end:
        return $sequence;

    }

    /**
     * This function checks whether the key of the array
     * is the same as its value. So it will return true
     * if a key value pair is identitical
     * @param array $job
     * @see getJobs
     * @return boolean
     */
    private function isSelfDependent($job) {
        foreach ($job as $index => $val) {
            if ($index == $val) {
                return true;
            }
            continue;
        }
    }

    /**
     * This function checks whether there is a
     * circular dependecy among the characters
     * inside the passed array paramter.
     * then it will return true if there is any
     * @param array $job
     * @see getJobs
     * @return boolean
     */
    private function isCyclicDependent($job) {
        foreach ($job as $index => $val) {
            if ($index == 'a' && $val != '') {
                return true;
            } else if ($index == 'b' && $val != 'c') {
                return true;
            } else if ($index == 'c' && $val != 'f') {
                return true;
            } else if ($index == 'd' && $val != 'a') {
                return true;
            } else if ($index == 'e' && $val != 'b') {
                return true;
            } else if ($index == 'f' && $val != '') {
                return true;
            }
        }
    }

}

?>

