<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\SessionBatch;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Carbon\Carbon;

class SessionBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionOrBatch = SessionBatch::orderBy('id','ASC')->get();
        return view('admin.session_batch.view',compact('sessionOrBatch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $sessionOrBatch = new SessionBatch();
        $sessionOrBatch->title = $request->title;
        $sessionOrBatch->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $sessionOrBatch->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $sessionOrBatch->status = isset($request->status)  ? 1 : 0;
        $sessionOrBatch->save();
        Session::flash('success', trans('flash.AddedSuccessfully'));
        return redirect ('batch-setting');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sessionBatch = SessionBatch::find($id);
        $sessionBatch->startDate = Carbon::parse($sessionBatch->start_date)->format('m/d/Y');
        $sessionBatch->endDate = Carbon::parse($sessionBatch->end_date)->format('m/d/Y');
        return view('admin.session_batch.update',compact('sessionBatch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $sessionBatch = SessionBatch::findOrFail($id);
        $sessionBatch->title = $request->title;
        $sessionBatch->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $sessionBatch->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $sessionBatch->status = isset($request->status)  ? 1 : 0;
        $sessionBatch->save();
        Session::flash('success',trans('flash.UpdatedSuccessfully'));
        return redirect ('batch-setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(Auth::User()->role == "admin"){

            $sessionBatch = SessionBatch::where('id', $id)->get();

            if(isset($sessionBatch))
            {
                DB::table('session_batches')->where('id',$id)->delete();

                return back()->with('delete',trans('flash.DeletedSuccessfully'));
            }
        }

        return redirect('batch-setting');
    }
    public function reposition(Request $request)
    {

        $data= $request->all();

        $posts = SessionBatch::all();
        $pos = $data['id'];

        $position =json_encode($data);

        foreach ($posts as $key => $item) {

            SessionBatch::where('id', $item->id)->update(array('position' => $pos[$key]));
        }

        return response()->json(['msg'=>'Updated Successfully', 'success'=>true]);


    }
}
