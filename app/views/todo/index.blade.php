<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do Kata 4/16/13</title>
</head>

<body>
    <div id="container">

        <h1>My To-Do List</h1>
        
        <ul id="tabs">
            <li id="todo_tab" class="selected">
                <a href="#">To-Do</a>
            </li>            
        </ul>
        
        <div id="main">
            <div id="todo">
                
            </div> <!-- #todo  -->

            <div id="addNew">
                {{ Form::open(array('url'=>'todo')) }}
                <p>
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title') }}
                </p>
                <p>
                    {{ Form::label('description', 'Description') }}
                    {{ Form::textarea('description', Null, array('cols'=>'35', 'rows'=>'8')) }}
                </p>
                <p>
                    {{ Form::submit('Add a new record') }}
                </p>
                {{ Form::close() }}
            </div> <!-- #addNew  -->        

        </div> <!-- #main  -->

    </div> <!-- #container -->

</body>
</html>