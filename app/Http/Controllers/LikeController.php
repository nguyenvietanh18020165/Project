<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    protected $productService;

    public function __construct(ProductService $productServices)
    {
        $this->productService = $productServices;
    }

    public function index(){
        $productNew = $this->productService->getNewProduct();
        $countCart = $this->productService->getUserCart();
        $countCart = count($countCart);
        $data = [
            "title" => "Các sản phẩm yêu thích",
            "pages" => [
                'pages.like_detail',
                "pages.latest_product",
            ],
            'productNew' => $productNew,
            'countCart' => $countCart,
            'product' => $this->likePrdUser()
        ];
        return view('master_layout', $data);
    }

    public function likePrd($id){
        $result = $this->productService->LikePrd($id);
        return $result;
    }

    public function likePrdUser(){
        return $this->productService->getLikeUser();
    }
}
