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

    public function testTodoControllerCanLoadDataFromDB()
    {
        $result = $this->action('GET', 'TodoController@index');
        $data = $result->getOriginalContent()->getData();
        $this->assertEquals(1, $data['items'][0]['id']);        
    }

    public function testTodoControllerCanLoadDataFromArray()
    {
        App::bind('TodoRepositoryInterface', 'ArrayTodoRepository');
        $result = $this->action('GET', 'TodoController@index');
        $data = $result->getOriginalContent()->getData();
        $this->assertEquals(999, $data['items'][0]['id']);        
    }

    public function testTodoControllerCanCreateItem()
    {
        App::bind('TodoRepositoryInterface', 'ArrayTodoRepository');
        $data = $this->action('GET', 'TodoController@index')->getOriginalContent()->getData();
        $count = count($data['items']);
        $result = $this->action('POST', 'TodoController@store', array('title'=>'test'));
        $data = $this->action('GET', 'TodoController@index')->getOriginalContent()->getData();
        $this->assertEquals($count+1, count($data['items']), 'should have added test object');
    }

    public function testTodoControllerDoesNotCreateItemIfValidationFails()
    {
        // TODO: write this function for validation
    }

    public function testTodoControllerCanDeleteItem()
    {
        App::bind('TodoRepositoryInterface', 'ArrayTodoRepository');
        $data = $this->action('GET', 'TodoController@index')->getOriginalContent()->getData();
        $count = count($data['items']);
        $data = $this->action('DELETE', 'TodoController@destroy', array(42));
        $data = $this->action('GET', 'TodoController@index')->getOriginalContent()->getData();
        $this->assertEquals($count-1, count($data['items']), 'should have deleted test object');
    }

    // public function testTodoControllerCanUpdateItem()
    // {
    //     App::bind('TodoRepositoryInterface', 'ArrayTodoRepository');
    //     $data = $this->action('PUT', 'TodoController@update', array('999'), array('title'=>'something new'));
    //     $result = $this->action('GET', 'TodoController@index')->getOriginalContent()->getData();
    //     $this->assertEquals('something new', $result['items'][0]['title']);
    // }



}