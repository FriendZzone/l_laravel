<?php

namespace App\Http\Controllers;

// use App\Repositories\Product\ProductRepositoryInterface;

use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    protected $productRepo;
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function index()
    {
        return $this->productRepo->getAll();
    }
}
