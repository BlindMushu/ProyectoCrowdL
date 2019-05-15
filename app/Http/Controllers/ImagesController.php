<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        $images->each(function($images){
                $images->article;
        });
        return view('admin.images.index')->with('images', $images);
    }

    public function __construct()
    {
        $this->middleware(['auth']);
    }
}
