<?php

interface TodoRepositoryInterface
{
    public function all();
    public function create($data = array());
    public function find($id);
    public function destroy($id);
}