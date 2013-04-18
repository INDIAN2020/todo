<?php

class TodoRepositoryTest extends TestCase
{
    public function testGetArrayTodoRepositoryResult()
    {
        $a = new ArrayTodoRepository;
        $this->assertCount(2, $a->all());           // We have 2 items in the initial array
    }

    public function testIdAddedToNewObject()
    {
        $a = new ArrayTodoRepository;
        $new = $a->create(array('title'=>'foo'));
        $this->assertContains('id', $new);        
    }

    public function testIdCanBeSpecifiedForNewObject()
    {
        $a = new ArrayTodoRepository;
        $new = $a->create(array('title'=>'love', 'id'=>'800'));
        $this->assertEquals(800, $this->_getID($new));

    }

    public function testSpecificItemCanBeSelected()
    {
        $a = new ArrayTodoRepository;
        $this->assertEquals('foo', $a->find('999')['title']);
        $this->assertEquals('love', $a->find('800')['title']);
    }

    public function testNewObjectsAreAutonumbered()
    {
        $a = new ArrayTodoRepository;
        $new1 = $a->create(array('title'=>'first'));
        $id1 = $this->_getID($new1); 
        $new2 = $a->create(array('title'=>'second'));
        $id2 = $this->_getID($new2);
        $this->assertEquals($id1+1, $id2);
    }

    /**
     * @expectedException Exception
     */
    public function testNewArrayObjectThrowsErrorIfDuplicated()
    {
        $a = new ArrayTodoRepository;
        $new = $a->create(array('title'=>'foo', 'id'=>'999'));
    }

    public function testDeleteExistingItem()
    {
        $a = new ArrayTodoRepository;
        $count = count($a->all());
        $a->destroy('1001');
        $this->assertEquals($count-1, count($a->all()));
    }

    public function testDeleteNonExistingItem()
    {
        $a = new ArrayTodoRepository;
        $count = count($a->all());
        $msg = $a->destroy('500');
        $this->assertEquals($count, count($a->all()));
    }



// Tests on an Eloquent repository (so I can see what happens) --------------------------

    public function testGetEloquentTodoRepositoryResult()
    {
        $a = new EloquentTodoRepository;
        $new = (string) $a->create(array('title'=>'foo'));
        $this->assertContains('id', $new);        
    }

    /**
     * @expectedException Exception
     */
    public function testNewEloquentObjectThrowsErrorIfDuplicated()
    {
        $a = new EloquentTodoRepository;
        $new = (string) $a->create(array('title'=>'foo', 'id'=>1));
    }


// Private helper functions ------------------------------------------------

    private function _getID($json)
    {
        $object = json_decode($json);
        return $object->id;
    }


}