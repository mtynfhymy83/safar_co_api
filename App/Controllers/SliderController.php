<?php

namespace App\Controllers;
use App\Controllers\Controller;

class SliderController extends Controller
{
    protected $roles;

    public function __construct()
    {
        parent::__construct();
    }

    public function index($request){
        $path = getUploadPath();

        $sliderPath = $path . "slider/";

        $sliders = $this->queryBuilder->table('sliders')
            ->select(['sliders.*', "IF(sliders.image IS NOT NULL AND TRIM(sliders.image) != '', CONCAT('$sliderPath', sliders.image), NULL) as image_path"])
            ->getAll()->execute();

        return $this->sendResponse(data: $sliders, message: "لیست اسلایدر ها با موفقیت دریافت شد");
    }

    public function store($request){
        $this->validate([
            'image||required',
            'status||enum:enable,disable',
        ],$request);

        // check slider image
        if($request->image){
            $request->image = uploadBase64($request->image, 'uploads/slider');
        } else return $this->sendResponse(data: null, message: "ابتدا تصویر رو آپلود کنید", status: HTTP_BadREQUEST);

        $newSlider = $this->queryBuilder->table('sliders')
            ->insert([
                'image' => $request->image ?? NULL,
                'status' => $request->status,
                'created_at' => time(),
                'updated_at' => time()
            ])->execute();

        return $this->sendResponse(data: $newSlider, message: "اسلایدر شما با موفقیت اضافه شد");
    }
}