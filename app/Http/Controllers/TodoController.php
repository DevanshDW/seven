<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $todos = auth()->user()->todos->sortBy('completed');
        // dd(auth()->user()->todos);
        // $todos = Todo::orderBy('completed')->get();
        return view('todos.index', compact('todos'));
    }
    public function create()
    {
        return view('todos.create');
    }
    public function store(TodoCreateRequest $request)
    {
        // dd($request->all());
        // $todo = auth()->user()->todos()->create($request->all());
        // if($request->step){
        //     foreach ($request->step as $step) {
        //         $todo->steps()->create(['name' => $step]);
        //     }
        // }
        $userId = auth()->id();
        $request['user_id'] = $userId;
        // if(!$request->title){
        //     return redirect()->back()->with('error', 'Please give title');
        // }
        // $request->validate([
        //     'title' => 'required',
        // ]);
        Todo::create($request->all());
        return redirect(route('todo.index'))->with('message', 'Todo created successfully');
    }
    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('todos.edit', compact('todo'));
    }
    public function update(Request $request, Todo $todo)
    {
        $todo->update(['title' => $request->title]);
        return redirect(route('todo.index'))->with('message', 'updated!');
    }
    public function complete(Todo $id)
    {
        $id->update(['completed' => true]);
        return redirect()->back()->with('message', 'Task marked as completed!');
    }
    public function incomplete(Todo $id)
    {
        $id->update(['completed' => false]);
        return redirect()->back()->with('message', 'Task marked as Incompleted!');
    }
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('message', 'Task Deleted!');
    }
    public function show(Todo $todo)
    {
        return $todo->steps->count();
       return view('todos.show', compact('todo'));
    }
}
