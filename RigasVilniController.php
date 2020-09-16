<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RigasVilniController extends Controller
{
	private $color = [
		'#F53005',
		'#F59A05',
		'#F5E605',
		'#29F505',
		'#05F5C9',
		'#0531F5',
		'#9605F5',
		'#F505E6',
		'#AE0F49'
	];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('test/rigasvilni/index');
    }

    public function getData($status = null) {
    	$result = DB::table('rigasvilni')
    		->select(
    			'number',
    			'height'
    		)
    	;
    	if ($status == 'portrait') {
    		$result = $result
    			->orderBy('created_at')
    			->orderBy('number')
	    		->limit(20)
    		;
    	}
    	if ($status == 'landscape') {
    		$result = $result
	    		->orderBy('created_at', 'desc')
	    		->orderBy('number', 'desc')
	    		->limit(30)
    		;
    	}
    	$result = $result->get();
    	$colors = [];
    	$checkColors = [];
    	if (Session::has('rigas_vilni_color')) {
    		$checkColors = Session::get('rigas_vilni_color');
    	}

    	foreach ($result as $key => $row) {
    		if (!empty($checkColors)) {
    			$row->color = $checkColors[$key];
    		} else {
	    		$color = $this->color[array_rand($this->color)];
	    		$row->color = $color;
	    		$colors[] = $color;
    		}
    	}

    	if (!Session::has('rigas_vilni_color')) {
    		Session::put('rigas_vilni_color', $colors);
    	}

    	return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {
    	try {
			DB::table('rigasvilni')
				->insert([
					'number' => rand(1, 5000),
					'height' => rand(100, 200),
					'created_at' => Carbon::now()
				])
			;
		} catch(\Exception $e) {
			Log::error("RigasVilniController store error", ['error' => "{$e}"]);
			Session::flash("message_error", "Error DB");
		}

		return redirect()->back();
    }
}
