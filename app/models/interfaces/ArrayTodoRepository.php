<?php

class ArrayTodoRepository implements TodoRepositoryInterface
{

    protected $guarded = array();
    public static $rules = array();

    public static $items = array(
        array(
            'id'            => 999,
            'title'         => 'foo',
            'description'   => 'bar',
        ),
        array(
            'id'            => 42,
            'title'         => 'testDelete',
            'description'   => 'this is a test item. Delete it!',
        ),
    );

    public function all()     
    {
        return self::$items;
    }

    public function create($data = array())
    {
        if( !isset($data['id'])) {
            $data['id'] = $this->getNextID();
        } else {
            $data['id'] = (int) $data['id'];
            $id = $data['id'];
            if($this->find($id))
                throw new Exception('Id '.$id.' already exists');
        }

        self::$items[] = $data;
        return json_encode(end(self::$items));
    }

    public function find($id)
    {
        foreach(self::$items as $item)
            if($item['id'] == $id)
                return $item;
    }

    public function destroy($id)
    {
        $count = count(self::$items);
        for ($i=0; $i < $count; $i++) { 
            if (isset(self::$items[$i]) && self::$items[$i]['id'] == $id) {
                unset(self::$items[$i]);
                return;
            }
        }
    }

    private function getNextID()
    {
        $max = -1;

        foreach(self::$items as $item)
            if($item['id'] > $max)
                $max = $item['id'];

        return $max+1;
    }



        // foreach ($attributes as $key => $value)
        // {
        //     $key = $this->removeTableFromKey($key);

        //     // The developers may choose to place some attributes in the "fillable"
        //     // array, which means only those attributes may be set through mass
        //     // assignment to the model, and all others will just be ignored.
        //     if ($this->isFillable($key))
        //     {
        //         $this->setAttribute($key, $value);
        //     }
        //     elseif ($this->totallyGuarded())
        //     {
        //         throw new MassAssignmentException($key);
        //     }
        // }

}