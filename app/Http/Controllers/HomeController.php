<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $productService;
    public function __construct(ProductService $productServices)
    {
        $this->productService = $productServices;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = $this->productService->getHotProduct();
        $productNew = $this->productService->getNewProduct();
        $countCart = $this->productService->getUserCart();
        $countCart = count($countCart);
        if(!isset($countCart)){
            $countCart = 0;
        }
        $data = [
            "title" => "RVM SeaMaf | Online & physical bead shop with the best beads and beading supplies in Zimbabwe ✓
            Over 9000 beads for jewelry making ✓ Glass beads ✓ Beading supplies and much more!",
            "pages" => [
                "blocks.slideshow_user",
                "blocks.feature_home",
                "pages.latest_product",
                "pages.banner_main_center",
                "pages.home_product_hot",
                "pages.banner_main_footer"
            ],
            'product' => $product,
            'productNew' => $productNew,
            'countCart' => $countCart
        ];
        return view('master_layout', $data);
    }

    public function admin(){
//        if(Auth::user()->is_admin != 1){
//            return $this->index();
//        }

        return view('admin');
    }
}
