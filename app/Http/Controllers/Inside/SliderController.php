<?php

namespace App\Http\Controllers\Inside;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
class SliderController extends Controller
{
	public function __construct(){}

	public function index() {
		$aData = array();
		$aSlider = Slider::paginate(10);
		if($aSlider){
			$aData['sliders'] = $aSlider;
		}
		return view('cpanel.slider.index',$aData);
	}

	public function getAdd() {
		return view('cpanel.slider.add');
	}

	public function postAdd(Request $req) {
		$slider_obj = new Slider();
		$slider = $req->file('slider');
		if($slider){
			$path = $slider->store('uploads/slider');
			$slider_obj->slider = $path;
			$slider_obj->link = $req->link;
			$slider_obj->position = $req->position;
			$slider_obj->save();
			return back()->with('status_success','Thêm Slider thành công');
		}else{
			return back()->with('status_error','Có lỗi xảy ra');
		}
	}

	public function getEdit($id) {
		$aData = array(); 
		$aSlider = Slider::find($id);
		if($aSlider){
			$aData['slider'] = $aSlider;
		}else{
			return redirect()->route('slider')->with('status_error', 'Có lỗi xảy ra');
		}
		return view('cpanel.slider.edit' , $aData);
	}

	public function postEdit(Request $req , $id) {
		try {
			$aSlider = Slider::find($id);
			if($req->link){
				$data['link'] = $req->link;
			}
			if($req->position){
				$data['position'] = $req->position;
			}
			$slider = $req->file('slider');
			if($slider){
				$path = $slider->store('uploads/slider');
				$data['slider'] = $path;
			}
			$aSlider->update($data);
			return back()->with('status_success', 'Cập nhật thành công');
		} catch (Exception $e) {
			return redirect()->route('product')->with('status_error', 'Có lỗi xảy ra');
		}
	}

	public function delete($id){
		$aSlider = Slider::find($id);
        if($aSlider){
           	$aSlider->delete();
            return back()->with('status_success', 'Slider Delelted');
        }else{
            return back()->with('status_error', 'Có lỗi xảy ra');
        }
	}
}
