<?php
namespace Zorille\framework;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-08-26 at 11:21:13.
 */
if (! defined ( '__DOCUMENT_ROOT__' )) {
	require_once $_SERVER ["PWD"] . '/prepare.php';
}

class slurmTest extends MockedListeOptions
{
    /**
     * @var slurm
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    	ob_start ();
    	
    	$this->object = new slurm ();
    	$this->object->setListeOptions ( $this->getListeOption () );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    	ob_end_clean ();
    }

    /**
     * @covers Zorille\framework\slurm::execute
     * @todo   Implement testexecute().
     */
    public function testexecute()
    {
    	// Remove the following lines when you implement this test.
    	$this->markTestIncomplete(
    			'This test has not been implemented yet.'
    	);
    }
    
    /**
     * @covers Zorille\framework\slurm::srun
     * @todo   Implement testSrun().
     */
    public function testSrun()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Zorille\framework\slurm::sbatch
     * @todo   Implement testSbatch().
     */
    public function testSbatch()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Zorille\framework\slurm::valide_etats_jobs
     * @todo   Implement testValide_etats_jobs().
     */
    public function testValide_etats_jobs()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Zorille\framework\slurm::attend_fin_jobs
     * @todo   Implement testAttend_fin_jobs().
     */
    public function testAttend_fin_jobs()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Zorille\framework\slurm::getRepertoire
     * @todo   Implement testGetRepertoire().
     */
    public function testGetRepertoire()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Zorille\framework\slurm::setRepertoire
     * @todo   Implement testSetRepertoire().
     */
    public function testSetRepertoire()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Zorille\framework\slurm::getListeSlurmId
     * @todo   Implement testGetListeSlurmId().
     */
    public function testGetListeSlurmId()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Zorille\framework\slurm::setListeSlurmId
     * @todo   Implement testSetListeSlurmId().
     */
    public function testSetListeSlurmId()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Zorille\framework\slurm::getListeSlurmErreur
     * @todo   Implement testGetListeSlurmErreur().
     */
    public function testGetListeSlurmErreur()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Zorille\framework\slurm::setListeSlurmErreur
     * @todo   Implement testSetListeSlurmErreur().
     */
    public function testSetListeSlurmErreur()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
