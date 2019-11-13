<?php

namespace App\Http\Controllers\Inside;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
	public function __construct(){}

	public function getUser() {
		$aData = array();
		$users = User::paginate(10);
		if($users){
			$aData['users'] = $users;
		}
		return view('cpanel.user.index', $aData);
	}

	public function getAdd() {
		return view('cpanel.user.add');
	}

	public function getEdit($id){
		$aData = array(); 
        $aUser = User::find($id);
        if($aUser){
            $aData['user'] = $aUser; 
        }else{
            return redirect()->route('user')->with('status_error', 'Có lỗi xảy ra');
        }
    	return view('cpanel.user.edit' , $aData);
	}

	public function postEdit(Request $req , $id) {
		try {
            $aUser = User::find($id);
            if($req->name){
                $data['name'] = $req->name;
            }
            if($req->position){
                $data['position'] = $req->position;
            } 

             // Feature image
            $avatar = $req->file('avatar');
            if($avatar){
                $avatar_path = $avatar->store('uploads/avatar');
                if($avatar_path){ 
                    // Set feature_image_id
                    $data['avatar'] = $avatar_path;
                }
            }
            $aUser->update($data);
            return back()->with('status_success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return redirect()->route('user')->with('status_error', 'Có lỗi xảy ra');
        }
	}

	public function deleteUser($id) {
		$aUser = User::find($id);
        if($aUser){
            $aUser->delete();
            return back()->with('status_success', 'Xóa user thành công');
        }else{
            return back()->with('status_error', 'Có lỗi xảy ra');
        }
	}

}
