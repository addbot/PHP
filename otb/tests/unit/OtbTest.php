<?php
/***************************************************************************
 * Filename  : OtbTest.php
 * Purpose   : This is the main class for the Unit test suite of my code
 * This code is part of the request from otb company. c/0 Abi Hart
 * Author(s) : marvin
 * Date      : Date(July 1, 2019)
 ****************************************************************************/
require 'Otb.php';
use PHPUnit\Framework\TestCase;

class OtbTest extends TestCase {

    public function testBlankAndSingleJob() {

        $otb = new Otb();
        $blankParam = "";
        $this->assertEquals(
            "",$otb->getJobs($blankParam),
            "When passing blank string should be equals to blank sequence"
        );

        $singleJob = '{"a":""}';
        $this->assertEquals(
            'a',$otb->getJobs($singleJob),
            "When passing single string should be equals to single job sequence"
        );

    }

    public function  testUnorderSequence() {

        $otb = new Otb();
        $unorderdSequence = '{"a":"","b":"","c":""}';
        $this->assertEquals(
            'abc',$otb->getJobs($unorderdSequence),
            "When passing 3 job sequence should be equals to 3 job sequence with no significant order"
        );
       
    }

    public function testPositionOfC() {

        $otb = new Otb();
        $positionOfC = '{"a":"","b":"c","c":""}';
        $this->assertEquals(
            array("a"=>"","c"=>"abc","b"=>""),$otb->getJobs($positionOfC),
            "The result should be a sequence that positions c before b, containing all three jobs abc"
        );


    } 

    public function testPositionOfF(){
        $otb = new Otb();
        $positionOfF = '{"a":"","b":"c","c":"f","d":"a","e":"b","f":""}';
        $this->assertEquals(
            array('f'=>'abcdef','c'=>'','b'=>'','e'=>'','a'=>'','d'=>''),$otb->getJobs($positionOfF),
            "The result should be a sequence that positions f before c, c before b, b before e and a before d containing all six jobs abcdef."
        );       
    }

    public function testNoSelfDependency() {
        $otb = new Otb();
        $selfDependencyParam = '{"a":"","b":"","c":"c"}';
        $this->assertEquals(
            "Jobs can't depend on themselves",$otb->getJobs($selfDependencyParam),
            "The result should be an error stating that jobs can’t depend on themselves."
        );         
    }


    public function testCyclicRedundancy() {
        $otb = new Otb();
        $cyclicRedanduncyParam = '{"a":"","b":"c","c":"f","d":"a","e":"","f":"b"}';
        $this->assertEquals(
            "Jobs can't have circular dependencies",$otb->getJobs($cyclicRedanduncyParam),
            "The result should be an error stating that jobs can’t have circular dependencies."
        );         
    }
    
}

?>