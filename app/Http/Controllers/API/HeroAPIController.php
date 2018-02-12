<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\Hero;
use Validator;

class HeroAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Hero::all();
        return $this->sendResponse($posts->toArray(), 'Heroes retrieved successfully.');
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
            'name' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $post = Hero::create($input);


        return $this->sendResponse($post->toArray(), 'Hero created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hero = Hero::find($id);

        if (is_null($hero)) {
            return $this->sendError('Hero not found.');
        }
        return $this->sendResponse($hero->toArray(), 'Hero retrieved successfully.');
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
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $hero = Hero::find($id);
        if (is_null($hero)) {
            return $this->sendError('Hero not found.');
        }


        $hero->name = $input['name'];
        $hero->alter_ego = $input['alter_ego'];
        $hero->save();


        return $this->sendResponse($hero->toArray(), 'Hero updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hero = Hero::find($id);


        if (is_null($hero)) {
            return $this->sendError('Hero not found.');
        }


        $hero->delete();


        return $this->sendResponse($id, 'Hero deleted successfully.');
    }
}
