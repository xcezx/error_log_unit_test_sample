<?php
use org\bovigo\vfs\vfsStream;

class ErrorLogTest extends PHPUnit_Framework_TestCase
{
    protected $vfsRoot;
    protected $logFile;

    public function setUp()
    {
        $this->vfsRoot = vfsStream::setup();
        $this->logFile = vfsStream::newFile('error.log');
        $this->vfsRoot->addChild($this->logFile);
    }

    public function test001()
    {
        error_log('Lorem ipsum', 3, vfsStream::url($this->logFile->getName()));
        $this->assertStringEqualsFile(vfsStream::url($this->logFile->getName()), 'Lorem ipsum');
    }

    public function test002()
    {
        error_log('foo bar baz', 3, vfsStream::url($this->logFile->getName()));
        $this->assertStringEqualsFile(vfsStream::url($this->logFile->getName()), 'foo bar baz');
    }
}