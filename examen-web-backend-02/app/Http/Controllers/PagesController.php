<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['except' => 'index']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('pages.home');
	}

	/**
	 * Display the dashboard.
	 * 
	 * @return [type] [description]
	 */
	public function dashboard()
	{		
		return view('pages.dashboard');
	}

}
