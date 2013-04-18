<?php

class TodoController extends BaseController 
{

    protected $todo;

    public function __construct(TodoRepositoryInterface $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() 
    {
        return View::make('todo/index')
            ->with('items', $this->todo->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // $validation = $this->todo->validate(Input::all());
        $new = $this->todo->create(Input::all());
        return($new);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        var_dump($id);
        var_dump(Input::all());

        $item = $this->todo->find($id);
        $item->title = Input::get('title');
        $item->description = Input::get('description');
        $item->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = $this->todo->find($id);
        if(!$item)
            return 'item '.$id.' not found';
        return $this->todo->destroy($id);
    }

}