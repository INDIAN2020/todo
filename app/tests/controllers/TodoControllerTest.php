<?php

/**
 * @group controller
 */
class TodoControllerTest extends TestCase
{
    public function testTesterWorks()
    {
        $this->assertTrue(True);
    }

    public function testTodoControllerExistsAndReturnsView()
    {
        $result = $this->action('GET', 'TodoController@index');
        $this->assertContains('Illuminate\View', get_class($result->getOriginalContent()));
        $this->assertViewHas('items');
    }

    /**
     * @group now
     */
    public function testTodoControllerCanLoadDataFromDB()
    {
        $result = $this->action('GET', 'TodoController@index');
        $data = $result->getOriginalContent()->getData();
        $this->assertEquals(1, $data['items'][0]['id']);        
    }

    /**
     * @group now
     */
    public function testTodoControllerCanLoadDataFromArray()
    {
        App::bind('TodoRepositoryInterface', 'ArrayTodoRepository');
        $result = $this->action('GET', 'TodoController@index');
        $data = $result->getOriginalContent()->getData();
        $this->assertEquals(999, $data['items'][0]['id']);        
    }

}