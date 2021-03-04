<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentDetail;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $code = '204';
            $msg = "No Content Avaulable.";
            $flag = false;
            $responce_data = [];

            $result=StudentDetail::get();
            $counter=count($result);
            if($counter>0){
                $code = '200';
                $msg = "{$counter} Records found";
                $flag = true;
                $responce_data = $result;
            }
        } catch (\Exception $e) {
            // $response = array();
            $code = '211';
            $msg = $e->getMessage();
            $flag = false;
            $responce_data = [];
        }

        $responce = array('code'=> $code,'msg'=> $msg, 'flag'=>$flag, 'responce_data'=> $responce_data);
        return $responce;
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
        try{
            $validatedData = $request->validate([
                'first_name' => ['required','max:255'],
                'Last_name' => ['required','max:255'],
                'Course_id' => ['required'],
                'Date_of_joining' => ['required','date']
            ]);

            $code = '502';
            $msg = "Bad Gateway";
            $flag = false;
            $received_data = $validatedData;

            $result=StudentDetail::create($validatedData);
            if($result){
                $code = '201';
                $msg = "Data insert Successfull...";
                $flag = true;
            }
        } catch (\Exception $e) {
            // $response = array();
            $code = '211';
            $msg = $e->getMessage();
            $flag = false;
            $received_data = $request->input();
        }

        $responce = array('code'=> $code,'msg'=> $msg, 'flag'=>$flag, 'received_data'=> $received_data);
        return $responce;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $code = '204';
            $msg = "No Content Avaulable.";
            $flag = true;
            $responce_data = [];

            $result=StudentDetail::find($id);
            // $counter=count($result);
            if($result){
                $code = '200';
                $msg = "Record found";
                $flag = true;
                $responce_data = $result;
            }
        } catch (\Exception $e) {
            // $response = array();
            $code = '211';
            $msg = $e->getMessage();
            $flag = false;
            $responce_data = [];
        }

        $responce = array('code'=> $code,'msg'=> $msg, 'flag'=>$flag, 'responce_data'=> $responce_data);
        return $responce;
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
        try{
            $validatedData = $request->validate([
                'first_name' => ['required','max:255'],
                'Last_name' => ['required','max:255'],
                'Course_id' => ['required'],
                'Date_of_joining' => ['required','date']
            ]);

            $code = '204';
            $msg = "No Content Avaulable.";
            $flag = false;
            $responce_data = [];

            $StudentDetailFind=StudentDetail::find($id);
            if($StudentDetailFind){
                $courseUpdate=StudentDetail::where('id',$StudentDetailFind->id)->update($validatedData);
                $code = '200';
                $msg = "Existing Record Not Updated.";
                $flag = false;

                if($courseUpdate){
                    $code = '202';
                    $msg = "Existing Record Update successfull.";
                    $flag = true;
                    $responce_data = array(
                        'old_record' => $StudentDetailFind,
                        'updated_record' => StudentDetail::find($id)
                    );
                }
            }
        } catch (\Exception $e) {
            $code = '211';
            $msg = $e->getMessage();
            $flag = false;
            $responce_data = [];
        }

        $responce = array('code'=> $code,'msg'=> $msg, 'flag'=>$flag, 'responce_data'=> $responce_data);
        return $responce;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $code = '204';
            $msg = "No Content Avaulable.";
            $flag = true;
            $responce_data = [];

            $result=StudentDetail::find($id);
            // $counter=count($result);
            if($result){
                $code = '200';
                $msg = "Record delete successfull";
                $flag = true;
                $responce_data = $result;
                $result->delete();
            }
        } catch (\Exception $e) {
            // $response = array();
            $code = '211';
            $msg = $e->getMessage();
            $flag = false;
            $responce_data = [];
        }

        $responce = array('code'=> $code,'msg'=> $msg, 'flag'=>$flag, 'responce_data'=> $responce_data);
        return $responce;
    }

    public function filfer(Request $request)
    {
        $result = StudentDetail::filfer($request);
        return $result;
    }
}
