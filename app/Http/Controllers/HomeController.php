<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public $data = [];
    public function index(Request $request)
    {
        $id = $request['id'];
        $title = '<h3 style="color:red;">hoc lap trinh tai Unicode</h3>';
        $content = 'PHP - Laravel Framework';
        $dataArr = [
            'item1',
            'item2',
            'item3',
        ];
        $contentView = view('clients.home', compact('id', 'title', 'dataArr'));
        return $contentView;
    }
    public function product()
    {
        $contentView = view('clients.products');
        return $contentView;
    }
    public function getAdd()
    {
        $contentView = view('clients.add', $this->data);
        return $contentView;
    }
    public function postAdd(Request $request)
    {
        dd($request);
        return;
    }
    public function putAdd(Request $request)
    {
        echo 1;
        dd($request);
        return;
    }
    public function getProductByID($id)
    {

        return view('clients.products.details', compact('id'));
    }
    public function download()
    {
        $image = trim(request()->image);
        $header = ['Content-Type' => 'application/pdf'];
        return (response())->download($image, "image" . time() . '.pdf', $header);
        if (!empty($image)) {
            return response()->streamDownload(function() use ($image) {
                $image_content = file_get_contents($image);
                echo $image_content;
            }, "image_123.jpg");
        }
    }
}
