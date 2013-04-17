<?php

class ArrayTodoRepository implements TodoRepositoryInterface
{

    protected $guarded = array();
    public static $rules = array();

    public function all()     
    {
        return array(
            array(
                'id'            => 999,
                'title'         => 'foo',
                'description'   => 'bar',
            ),
        );
    }
}