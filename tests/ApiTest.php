<?php



class ApiCheckTest extends TestCase
{

    /**
     * My test implementation
     */
    public function testApiWorks()
    {
        $this->visit('/api/check');
        $this->see('\"success\"');
    }
}