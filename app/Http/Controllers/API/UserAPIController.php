<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\User;
use Validator;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use JWTAuthException;

class UserAPIController extends APIBaseController {

   public function index() {
     $users = User::all();
     return $this->sendResponse($users->toArray(), 'Users retrived successfully');
   }

   public function store(Request $request) {
     $input = $request->all();

     $validator = Validator::make($input, [
          'name' => 'required'
       ]);

       if($validator->fails()) {
         return $this->sendError('Validation error',$validator->errors());
       }

       $user = User::create($input);

       return $this->sendResponse($user->toArray(),'User Created successfully');
   }

   public function show($id){
     Log::debug('An informational message. mmmmmm '.$id);
     $user = User::find($id);

     if(is_null($user)){
       return $this->sendError(' User not found.');
     }
     return $this->sendResponse($user->toArray(),'User retrived successfully');
   }

   public function update(Request $request,$id) {
     $input = $request->all();

     $validator = Validator::make($input,[
        'name' => 'required'
       ]);

       if($validator->fails()) {
         return $this->sendError('Validation error',$validator->erros());
       }

       $user = User::find($id);
       if(is_null($user)) {
         return $this->sendError('User not found.');
       }

       $user->name = $input['name'];
        $user->email = $input['email'];
       $user->save();

       return $this->sendResponse($user->toArray(),'User updated successfully');
   }

   public function destroy($id) {
      $user = User::find($id);

      if(is_null($user)){
        return $this->sendError(' User not found.');
      }

      $user->delete();

      return $this->sendResponse($id,' User deleted successfully');
   }

   public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
}




 ?>
