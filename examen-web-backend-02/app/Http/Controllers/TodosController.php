<?php namespace App\Http\Controllers;


use App\Todo;
use App\Http\Requests;
use App\Http\Requests\CreateTodoRequest;
use Illuminate\HttpResponse;
use App\Http\Controllers\Controller;
use Auth;

class TodosController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show al the todos.
	 * 
	 * @return [type] [description]
	 */
	public function todos()
	{
		$todosTodo = Auth::user()->todos()->where('done', 0)->latest()->get();

		$todosDone = Auth::user()->todos()->where('done', 1)->latest()->get();

		return view('pages.todos', compact('todosTodo', 'todosDone'));
	}

	/**
	 * Show the form for adding a todo.
	 * 
	 */
	public function add()
	{
		return view('pages.add');
	}

	/**
	 * Store a new todo of the logged in user in the database.
	 * 
	 * @param  CreateTodoRequest $request [description]
	 * @return [type]                     [description]
	 */
	public function store(CreateTodoRequest $request)
	{
		Auth::user()->todos()->create($request->all());

		flash()->success('Uw todo "' . $request['item'] . '" is toegevoegd');

		return redirect('todos');
	}

	/**
	 * Toggle a todo from "todo" to "done" or from "done" to "todo".
	 * 
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function toggle($id)
	{	
		$todo = Auth::user()->todos()->find($id);

		if (count($todo))
		{
			if($todo['done'] == 0)
			{
				$todo['done'] = 1;
				flash()->success('Uw todo "' . $todo['item'] . '" is geschrapt');
			}
			else
			{
				$todo['done'] = 0;
				flash()->success('Oeps, uw todo "' . $todo['item'] . '" moest nog gedaan worden');
			}

			$todo->update();
		}
		else
		{
			flash()->error('U probeert een todo te toggelen die niet bestaat');
		}

		return redirect('todos');

		
	}


	public function delete($id)
	{
		$todo = Auth::user()->todos()->find($id);

		if (count($todo))
		{
			$todo->delete();
			flash()->success('Uw todo "' . $todo['item'] . '" is verwijderd');
		}
		else
		{
			flash()->error('U probeert een todo te verwijderen die niet bestaat');
		}

		return redirect('todos');
	}


}
