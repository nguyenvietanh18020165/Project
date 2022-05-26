<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected $productService;

    public function __construct(ProductService $productServices)
    {
        $this->productService = $productServices;
    }

    public function index(){
        $pages = ['pages.category'];
        $ctgr = $this->productService->getCategory();
        return view('master_layout', [
            'title' => 'Danh mục sản phẩm',
            'pages' => $pages,
            'ctgr' => $ctgr
        ]);
    }

    public function getProductInCtgr($id){
        if($id == 'all'){
            $result = $this->productService->searchProduct('');
            return view('pages.prd_in_ctgr', [
                'product' => $result,
                'ctgr' => "Tất cả sản phẩm"
            ]);
        }
        $result = $this->productService->getPrdInCtgr($id);
        $ctgr = $this->productService->getCategory($id);
        return view('pages.prd_in_ctgr', [
                'product' => $result,
                'ctgr' => $ctgr[0]->name
            ]);
    }

}
