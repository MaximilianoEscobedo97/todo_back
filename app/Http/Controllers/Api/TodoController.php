<?php

namespace App\Http\Controllers\Api;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class TodoController extends Controller
{
    //get Todos
    public function Index ()
    {
        $todos = Todo::all();
        return General::makeResponse(["todos"=>$todos],200,true);
    }

    //view
    public  function  show ($id)
    {

        $todo = Todo::findOrFail($id);

        if(!$todo)
            return General::makeResponse(["message"=>"error"],400,false);

        return General::makeResponse(["todo"=>$todo],200,true);
    }

    //create
    public  function create(Request $request)
    {
        $data = $request->all();
        $data["created"] = date("Y-m-d");
        $validator = General::validateRequest($data, Todo::$rules);
        if ($validator) return $validator;

        $todo = Todo::query()->create($data);

        if(!$todo)
            return General::makeResponse(["message"=>"error"],400,false);

        return General::makeResponse(["todo"=>$todo],200,true);

    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $todo = Todo::find($id);

        if(!$todo)
            return General::makeResponse(["message"=>"error"],400,false);

        $this->todoUpdate($todo,$data);

        return General::makeResponse(["message"=>"succes"],200,true);
    }

    public function updateCompleted($id)
    {
        $todo = Todo::find($id);

        if(!$todo)
            return General::makeResponse(["message"=>"error"],400,false);

        $todo->completed = !$todo->completed;
        $todo->save();

        return General::makeResponse(["message"=>"succes"],200,true);
    }

    private  function todoUpdate($todo,$data)
    {
        $todo->name = $data["name"];
        $todo->title = $data["title"];
        $todo->completed = $data["completed"];
        $todo->save();
    }
    // delete
    public function  destroy($id)
    {
        $todo = Todo::findOrFail($id);
        if(!$todo)
            return General::makeResponse(["message"=>"error"],400,false);

        $todo->delete();

        return General::makeResponse(["message"=>"success"],200,true);
    }
}
