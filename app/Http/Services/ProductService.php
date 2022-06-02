<?php


namespace App\Http\Services;

use App\Models\carts;
use App\Models\categoris as Categoris;
use App\Models\images;
use App\Models\ProductLike;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductService
{
    public function create($request)
    {
        $slugCtgr = $this->getCategory($request->input("listCtgr"))[0]->slug;
        $code = strtoupper($slugCtgr) . time();
        $productA = Products::create([
            "code" => $code,
            "name" => (string)$request->input("productName"),
            "description" => (string)$request->input("productDesc"),
            "category_id" => (int)$request->input("listCtgr"),
            "price" => (int)$request->input("productPrice"),
            "count" => (int)$request->input("productCount"),
            "is_top" => 0,
            "slug" => Str::slug($request->input("productName"), "-")."-".$code
        ]);
        $prdId = $productA->id;
        // kiểm tra xem có tải ảnh lên hay k
        if ($request->hasfile('productImages')) {
            $files = $request->file("productImages");
            // lặp chuỗi ảnh được tải lên
            foreach ($files as $key => $file) {
                // xửa lý từng ảnh được tải lên
                $ext = $file->extension();
                $fileName = 'product-' . time() . $key . '.' . $ext;
                $file->move(public_path("upload/images/products"), $fileName);
                images::create([
                    "product_id" => $prdId,
                    "path" => 'upload/images/products/' . $fileName
                ]);
            }
            return true;
        }
        return false;
    }

    public function getProduct($id = false)
    {
        if (!$id) {
            $product = Products::join('categoris', 'products.category_id', "=", "categoris.id")
                ->select("products.*", "categoris.name as ctgr_name")
                ->orderBy("id", "desc")
                ->get();
            for($i = 0; $i < count($product); $i++){
                $product[$i]->images = $this->getFirstImage($product[$i]->id);
            }
        } else {
            $product = Products::where("id", $id)->first();
            $product->images = $this->getFirstImage($product->id);
        }
        return $product;
    }

    public function getNewProduct(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dates = date('Y-m-d H:i:s');
        $newdate = strtotime ( '-7 day' , strtotime ( $dates ) ) ;
        $newdate = date ( 'Y-m-d H:i:s' , $newdate );
        $product = Products::where('created_at', '>', $newdate)->orderBy('id', 'desc')->get();
        for($i = 0; $i < count($product); $i++){
            $product[$i]->images = $this->getFirstImage($product[$i]->id);
        }
        return json_decode($product);
    }

    public function getHotProduct(){
        $product = Products::where("is_top", 1)->orderBy('id', 'desc')->get();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dates = date('Y-m-d H:i:s');
        $newdate = strtotime ( '-7 day' , strtotime ( $dates ) ) ;
        $newdate = date ( 'Y-m-d H:i:s' , $newdate );
        for($i = 0; $i < count($product); $i++){
            if(strtotime($product[$i]->created_at) > strtotime($newdate)){
                $product[$i]->new = true;
            }else{
                $product[$i]->new = false;
            }

            $product[$i]->images = $this->getFirstImage($product[$i]->id);
        }
        return $product;
    }
    public function getFirstImage($id){
        $result = images::where("product_id", $id)->select('path')->first();
        return $result->path;
    }
    public function delProduct($id)
    {
        $product = Products::where("id", $id)->delete();
        return $product;
    }

    public function editProductView($id)
    {
        $result = Products::where("id", $id)->first();
        return $result;
    }

    public function editProductCreate($request)
    {
        $slugCtgr = $this->getCategory($request->input("listCtgr"))[0]->slug;
        $code = strtoupper($slugCtgr) . time();
        Products::where("id", (int)$request->input("productId"))->update([
            "code" => $code,
            "name" => (string)$request->input("productName"),
            "description" => (string)$request->input("productDesc"),
            "category_id" => (int)$request->input("listCtgr"),
            "price" => (int)$request->input("productPrice"),
            "count" => (int)$request->input("productCount"),
            "slug" => Str::slug($request->input("productName"), "-")."-".$code
        ]);
        if ($request->hasfile('productImages')) {
            $files = $request->file("productImages");
            foreach ($files as $key => $file) {
                $ext = $file->extension();
                $fileName = 'product-' . time() . $key . '.' . $ext;
                $file->move(public_path("upload/images/products"), $fileName);
                images::create([
                    "product_id" => (int)$request->input("productId"),
                    "path" => 'upload/images/products/' . $fileName
                ]);
            }
            return true;
        }
        return false;
    }

    public function deleteImages($id)
    {
        $result = images::where("id", $id)->delete();
        return $result;
    }

    public function getCategory($id = false)
    {
        if (!$id) {
            return Categoris::orderBy('id', 'desc')->get();
        } else {
            return Categoris::where('id', $id)->get();
        }
    }

    public function addCategory($name)
    {
        $result = Categoris::where('name', $name)->get();
        if (count($result) >= 1) {
            return false;
        } else {
            Categoris::create([
                "name" => $name,
                "slug" => Str::slug($name, "-")
            ]);
            return true;
        }
    }

    public function deleteCategory($id)
    {
        $result = Categoris::where('id', $id)->get();
        if (count($result) >= 1) {
            Categoris::where("id", $id)->delete();
            return true;
        }
        return false;
    }

    public function getImages($id)
    {
        $result = images::where("product_id", $id)->get();
        return $result;
    }

    public function checkCart($id){
        $result = carts::where("product_id", $id)
            ->where("user_id", Auth::id())->get();
        if(count($result) >= 1){
            return $result[0];
        }
        return false;
    }

    public function checkCartApi($id, $user_id){
        $result = carts::where("product_id", $id)
            ->where("user_id", $user_id)->get();
        if(count($result) >= 1){
            return $result[0];
        }
        return false;
    }

    public function getUserCart(){
        return carts::where("user_id", Auth::id())->get();
    }
    public function getUserCartApi($id){
        return carts::where("user_id", $id)->get();
    }
    public function addCart($quality = null, $id){
        if(!$this->checkCart($id)){
            if($quality != null){
                carts::create([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'quality' => $quality,
                    'status' => 1
                ]);
            }else{
                carts::create([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'quality' => 1,
                    'status' => 1
                ]);
            }

            return count($this->getUserCart());
        }
        if($quality != null){
            $count = $this->checkCart($id)->quality + $quality;
        }else{
            $count = $this->checkCart($id)->quality + 1;
        }

        carts::where('id', $this->checkCart($id)->id)->update([
            'quality' => $count
        ]);
        return count($this->getUserCart());
    }

    public function productDetail($slug){
        $product = Products::where('slug', $slug)->first();
        $product->images = $this->getImages($product->id);
        return $product;
    }

    public function productRelated($id){
        $product = Products::where('category_id', $id)->orderBy('id', 'desc')->get();
        for($i = 0; $i < count($product); $i++){
            $product[$i]->images = $this->getFirstImage($product[$i]->id);
        }
        return $product;
    }

    public function getCartUser(){
        $result = Products::join('carts', 'carts.product_id', "=", "products.id")
            ->where("carts.user_id", Auth::id())
            ->select('products.*', 'carts.quality', 'carts.status', 'carts.id as carts_id')->get();
        for($i = 0; $i < count($result); $i++){
            $result[$i]->images = $this->getFirstImage($result[$i]->id);
        }
        return $result;
    }

    public function getQuality($id, $quality)
    {
        carts::where("id", $id)->update([
           'quality' => $quality
        ]);
        $result = carts::where("id", $id)->first();
        if(strlen($result) > 0){
            $data = [
                'quality' => $result->quality,
                'money' => $this->getSumPrice()
            ];
             $data = json_encode($data);
            return $data;
        }
        return false;
    }

    public function getSumPrice(){
        $result = carts::where('user_id', Auth::id())
            ->join("products", "products.id", "=", "carts.product_id")
            ->select("products.price as price", "carts.quality as quality")->get();
        $sum = 0;
        foreach ($result as $val){
            $sum += $val->price*$val->quality;
        }
        return $sum;
    }

    public function deleteCart($id){
        $result = carts::where("id", $id)->delete();
        if(strlen($result) > 0){
            return $this->getSumPrice();
        }
        return false;
    }

    public function getAllUserCart(){
        $result = User::join("carts", "users.id", "=", "carts.user_id")->distinct('user.*')->select("users.*")->get();
        for($i = 0; $i < count($result); $i++){
            $cart = carts::where("user_id", $result[$i]->id)->get();
            for($j = 0; $j < count($cart); $j++){
                $product = products::where("id", $cart[$j]->product_id)->first();
                $product->image = $this->getFirstImage($product['id']);
                $cart[$j]->product = $product;
            }
            $result[$i]->carts = $cart;
        }
        return $result;
    }

    public function getCartOfUser($id){
        $result = Products::join('carts', 'carts.product_id', "=", "products.id")
            ->where("carts.user_id", $id)
            ->select('products.*', 'carts.quality', 'carts.status', 'carts.id as carts_id')->get();
        for($i = 0; $i < count($result); $i++){
            $result[$i]->images = $this->getFirstImage($result[$i]->id);
        }
        return $result;
    }

    public function searchProduct($keyW = " ", $prdCount = 0){
        $product = Products::where("name", "like", "%$keyW%")->orwhere("code", "like", "%$keyW%")->offset($prdCount)->limit(12)->orderBy("id", 'desc')->get();
        for($i = 0; $i < count($product); $i++){
            $product[$i]->images = $this->getFirstImage($product[$i]->id);
        }
        return $product;
    }

    public function getNameProduct($keyW){
        $product = Products::where("name", "like", "%$keyW%")
            ->orwhere("code", "like", "%$keyW%")
            ->select("name", 'slug')
            ->limit(12)->orderBy("id", 'desc')
            ->get();
        return $product;
    }
    public function ProductIsTop($id, $action){
        if($action == 1){
            $result = Products::where('id', $id)->update(['is_top' => 1]);
        }else{
            $result = Products::where('id', $id)->update(['is_top' => 0]);
        }

        return $result;
    }

    public function getPrdInCtgr($id){
        $result = Products::where('category_id', $id)->get();
        for($i = 0; $i < count($result); $i++){
            $result[$i]->images = $this->getFirstImage($result[$i]->id);
        }
        return $result;
    }
    public function LikePrd($id){
        $check = ProductLike::where('user_id', Auth::id())->where('product_id', $id)->get();
        if(count($check) > 0){
            ProductLike::where('user_id', Auth::id())->where('product_id', $id)->delete();
            return 0;
        }
        $result = ProductLike::insert([
           'user_id' => Auth::user()->id,
           'product_id' => $id
        ]);
        return $result;
    }

    public function getLikeUser(){
        $like = Products::join('product_likes', 'product_likes.product_id', '=', 'products.id')->select('products.*')->where('user_id', Auth::id())->get();
        for($i = 0; $i < count($like); $i++){
            $like[$i]->images = $this->getFirstImage($like[$i]->id);
        }
        return $like;
    }
}
