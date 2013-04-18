<?php

class EloquentTodoRepository implements TodoRepositoryInterface
{
    public static $rules = array();

    public function all()                       { return Todo::all(); }
    public function create($data = array())     { return Todo::create($data); }
    public function destroy($id)                { return Todo::destroy($id); }
    public function find($id)                   { return Todo::find($id); }
}