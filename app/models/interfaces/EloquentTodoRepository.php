<?php

class EloquentTodoRepository implements TodoRepositoryInterface
{
    public function all()     { return Todo::all(); }
}