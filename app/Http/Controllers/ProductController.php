<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $userService;
    public function __construct(ProductService $productServices, UserService $userService)
    {
        $this->productService = $productServices;
        $this->userService = $userService;
    }

    public function create()
    {
        $ctgr = $this->productService->getCategory();
        return view("admin",
            [
                'category' => $ctgr,
                'page' => "pages.createprd_admin",
                'sidebar' => 'product'
            ]);
    }

    public function store(Request $request){
        $result = $this->productService->create($request);
        return redirect()->back();
    }

    public function getAllCtgr()
    {
        $category = $this->productService->getCategory();
        return view("pages.category_admin", ["category" => $category]);
    }

    public function addCtgr(Request $request)
    {
        $name = $request->name;
        $stt = $this->productService->addCategory($name);
        if ($stt) {
            return 1;
        }
    }

    public function deleteCtgr(Request $request)
    {
        $id = $request->id;
        $stt = $this->productService->deleteCategory($id);
        if ($stt) {
            return 1;
        }
    }

    public function getProduct()
    {
        $product = $this->productService->getProduct();
        return view("pages.showprd_admin", ['product' => $product]);
    }

    public function ProductDetail($slug){
        $product = $this->productService->productDetail($slug);
        $countCart = $this->productService->getUserCart();
        $countCart = count($countCart);
        $cart = $this->productService->checkCart($product->id);
        $productRelated = $this->productService->productRelated($product->category_id);
        // dd($product);
        if(!isset($countCart)){
            $countCart = 0;
        }
        $images = $this->productService->getImages($product->id);
        $data = [
            "title" => "Fruit & Health",
            "pages" => [
                'pages.product_detail',
                'pages.related_product'
            ],
            'breadcrumb' => "product_detail",
            'breadcrumbData' => $product,
            'product' => $product,
            'countCart' => $countCart,
            'images' => $images,
            'cart' => $cart,
            'productRelated' => $productRelated
        ];
        return view('master_layout', $data);
    }
    public function delProduct(Request $request){
        $id = $request->id;
        $result = $this->productService->delProduct($id);
        if(isset($result)){
            return true;
        }
        return false;
    }

    public function editProductCreate($id){
        $product = $this->productService->editProductView($id);
        $category = $this->productService->getCategory();
        $image = $this->productService->getImages($id);
        return view("admin",
            [
                'category' => $category,
                'product' => $product,
                'page' => "pages.editprd_admin",
                'sidebar' => 'product',
                'images' => $image
            ]);
    }
    public function editProductStore(Request $request){
        $result = $this->productService->editProductCreate($request);
        return redirect()->back();
    }

    public function deleteImages(Request $request){
        $id = $request->id;
        $result = $this->productService->deleteImages($id);
        if (isset($result)){
            return true;
        }
        return false;
    }

    public function addCart(Request $request){
        $id = $request->id;
        $quality = $request->quality;
        $result = $this->productService->addCart($quality, $id);
        return $result;
    }

    public function cartDetail(){
        $product = $this->productService->getCartUser();
        $productNew = $this->productService->getNewProduct();
        $countCart = $this->productService->getUserCart();
        $countCart = count($countCart);
        $user_info = $this->userService->infor();
        $user_payment = $this->userService->getPayment();
        if(!isset($countCart)){
            $countCart = 0;
        }
        $data = [
            "title" => "Fruit & Health",
            "pages" => [
                'pages.cart_detail',
                'pages.latest_product'
            ],
            'product' => $product,
            'countCart' => $countCart,
            'productNew' => $productNew,
            'user_info' => $user_info,
            'user_payment' => $user_payment
        ];
        return view('master_layout', $data);
    }
    public function getQuality(Request $request){
        $id = $request->id;
        $quality = $request->quality;
        $result = $this->productService->getQuality($id, $quality);
        return $result;
    }

    public function deleteCart(Request $request){
        $id = $request->id;
        $result = $this->productService->deleteCart($id);
        return $result;
    }

    public function viewCartAdmin(){
        $result = $this->productService->getAllUserCart();
        return view("pages.cart_admin", ['user' => $result]);
    }

    public function detailCardOfUser(Request $request){
        $id = $request->id;
        $result = $this->productService->getCartOfUser($id);
        $countCart = $this->productService->getUserCart();
        $countCart = count($countCart);
        return view('pages.cart_detail_user', [
            'product' => $result,
            'countCart'=>$countCart
            ]);
    }
    public function searchProduct(Request $request){
        $keyW = $request->key;
        $product = $this->productService->searchProduct($keyW);
        $countCart = $this->productService->getUserCart();
        $countCart = count($countCart);
        if(!isset($countCart)){
            $countCart = 0;
        }
        $data = [
            "title" => "Fruit & Health",
            "pages" => [
                "pages.search_product"
            ],
            'product' => $product,
            'countCart' => $countCart,
            'keyW' => $keyW
        ];
        return view('master_layout', $data);
    }

    public function getDataSearch(Request $request){
        $keyW = $request->key;
        $offset = $request->offset;
        $product = $this->productService->searchProduct($keyW, $offset);
        return view('pages.more_search', ['product' => $product]);
    }

    public function getNameProduct(Request $request){
        $keyW = $request->keyW;
        if($keyW == ""){
            $name =[];
        }else{
            $name = $this->productService->getNameProduct($keyW);
        }
        $name = json_encode($name);
        return $name;
    }

    public function ProductIsTop(Request $request){
        $id = $request->id;
        $action = $request->action;
        $result = $this->productService->ProductIsTop($id, $action);
        if($result){
            return true;
        }
    }

    public function getCategory(){
        return json_encode($this->productService->getCategory());
    }

}

