<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use Auth;
use App\Models\Pet;
use App\Http\Resources\Pet as PetResource;

class PetController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pets = Pet::all(); //without pet belonging to user
        $pets = Pet::whereUserId(Auth::id())->get();
        return $this->sendResponse(PetResource::collection($pets), 'Pets fetched.');
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'age' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $input['user_id'] = $request->user()['id'];
        $pet = Pet::create($input);
        return $this->sendResponse(new PetResource($pet), 'Pet created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $pet = Pet::find($id); //without pet belonging to user
        $pet = Pet::whereUserId(Auth::id())->where('id', $id)->first();
        if (is_null($pet)) {
            return $this->sendError('Pet not found.');
        }
        return $this->sendResponse(new PetResource($pet), 'Pet fetched.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        if (is_null(Pet::whereUserId(Auth::id())->where('id', $pet->id)->first())) {
            return $this->sendError('Pet not found.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'age' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $pet->name = $input['name'];
        $pet->age = $input['age'];
        $pet->save();
        
        return $this->sendResponse(new PetResource($pet), 'Pet updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        if (is_null(Pet::whereUserId(Auth::id())->where('id', $pet->id)->first())) {
            return $this->sendError('Pet not found.');
        }

        $pet->delete();
        return $this->sendResponse([], 'Pet deleted.');
    }
}
