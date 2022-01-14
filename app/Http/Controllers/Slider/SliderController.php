<?php
namespace App\Http\Controllers\Slider;

use App\Services\Images\Upload;
use App\Http\Controllers\Controller;

use App\Http\Requests\slider\SaveSlider;
use App\Repositories\Slider\SliderRepository;


class SliderController extends Controller
{

    public function __construct(SliderRepository $sliderRepositories){
        $this->sliderRepositories = $sliderRepositories;
    }

    public function store(SaveSlider $request,Upload $upload){

        $slider = $this->sliderRepositories->save($request,$upload);

        return $slider;
       
    }
}
