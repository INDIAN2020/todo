<?php

class TodosTableSeeder extends Seeder {

    public function run()
    {
        DB::table('todos')->delete();

        $todos = array(
            array(
                'id'            => 1,
                'title'         => 'Learn Laravel',
                'description'   => 'It\'s really important',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'id'            => 2,
                'title'         => 'Get lunch',
                'description'   => 'I\'m hungry',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'id'            => 3,
                'title'         => 'Practice',
                'description'   => 'Again and again',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
        );

        // Uncomment the below to run the seeder
        DB::table('todos')->insert($todos);
    }

}