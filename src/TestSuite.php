<?php
/**
 * slince mechanic library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Mechanic;

use Cake\Utility\Text;
use Slince\Mechanic\Report\TestSuiteReport;
use slince\Mechanic\TestCase\TestCase;

class TestSuite
{
    /**
     * 测试套件名称
     * @var string
     */
    protected $name;

    /**
     * @var TestCase[]
     */
    protected $testCases;

    /**
     * @var TestSuiteReport
     */
    protected $testSuiteReport;

    /**
     * @var Mechanic
     */
    protected $mechanic;

    function __construct($name = null, array $testCases = [])
    {
        $this->name = $name;
        $this->setTestCases($testCases);
        $this->testSuiteReport = new TestSuiteReport($this);
    }

    /**
     * 测试套件声明
     * @return mixed
     */
    function suite()
    {}

    /**
     * @param Mechanic $mechanic
     */
    public function setMechanic($mechanic)
    {
        $this->mechanic = $mechanic;
    }

    /**
     * @return Mechanic
     */
    public function getMechanic()
    {
        return $this->mechanic;
    }
    
    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        if (empty($this->name)) {
            $this->name = Text::uuid();
        }
        return $this->name;
    }

    /**
     * @param TestCase $testCase
     */
    function addTestCase(TestCase $testCase)
    {
        $testCase->setTestSuite($this);
        $this->testCases[] = $testCase;
    }

    /**
     * @param TestCase\TestCase[] $testCases
     */
    public function setTestCases($testCases)
    {
        $this->testCases = [];
        foreach ($testCases as $testCase) {
            $this->addTestCase($testCase);
        }
    }

    /**
     * @return TestCase[]
     */
    public function getTestCases()
    {
        return $this->testCases;
    }

    /**
     * @return TestSuiteReport
     */
    public function getTestSuiteReport()
    {
        return $this->testSuiteReport;
    }
}