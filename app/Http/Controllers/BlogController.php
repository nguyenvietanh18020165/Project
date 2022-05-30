<?php

namespace App\Http\Controllers;

use App\Http\Services\BlogService;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    protected $BlogService;
    protected $productService;

    public function __construct(BlogService $BlogService, ProductService $productService)
    {
        $this->BlogService = $BlogService;
        $this->productService = $productService;
    }

    public function index()
    {
        $countCart = $this->productService->getUserCart();
        $countCart = count($countCart);
        $blog = $this->BlogService->allBlog();
        $ctgrBlog = $this->BlogService->getCtgr();
        $blogNew = $this->BlogService->blogNew();
        if (!isset($countCart)) {
            $countCart = 0;
        }
        $data = [
            "title" => "Tin tức mới",
            "pages" => [
                "pages.blog"
            ],
            'countCart' => $countCart,
            'blog' => $blog,
            'ctgr_blog' =>$ctgrBlog,
            'blognew' =>$blogNew
        ];
        return view('master_layout', $data);
    }

    public function create()
    {
        $ctgr = $this->productService->getCategory();
        $ctgr_blog = $this->BlogService->getCtgr();
        return view("admin",
            [
                'ctgr' => $ctgr,
                'ctgr_blog' => $ctgr_blog,
                'page' => "pages.add_blog",
                'sidebar' => 'blog'
            ]);
    }

    public function store(Request $request)
    {
        $result = $this->BlogService->create($request);
        return redirect()->back();
    }

    public function CategoryDetail()
    {
        $ctgr = $this->BlogService->getCtgr();
        $data = [
            'ctgr' => $ctgr
        ];
        return view('pages.category_blog', $data);
    }

    public function addCtgr(Request $request)
    {
        $name = $request->name;
        $stt = $this->BlogService->addCategory($name);
        if ($stt) {
            return 1;
        }
    }

    public function deleteCtgr(Request $request)
    {
        $id = $request->id;
        $stt = $this->BlogService->deleteCategory($id);
        if ($stt) {
            return 1;
        }
    }

    public function showBlogAdmin(){
        $blog = $this->BlogService->allBlogAdmin();
//        $category = $this->productService->getCategory();
        return view("pages.admin_all_blog", ["blog" => $blog]);
    }

    public function deleteBlog(Request $request){
        $id = $request->id;
        return $this->BlogService->deleteBlog($id);
    }

    public function editBlog($id){
        $blog = $this->BlogService->getBlog($id);
        $ctgr = $this->productService->getCategory();
        $ctgr_blog = $this->BlogService->getCtgr();
        return view("admin",
            [
                'ctgr' => $ctgr,
                'ctgr_blog' => $ctgr_blog,
                'page' => "pages.edit_blog",
                'blog' => $blog,
                'sidebar' => 'blog'
            ]);
    }

    public function updateBlog(Request $request, $id){
        $result = $this->BlogService->updateBlog($request, $id);
        return redirect()->back();
    }

    public function CtgrDetail($slug){
        $countCart = $this->productService->getUserCart();
        $countCart = count($countCart);
        $blog = $this->BlogService->BlogInCtgr($slug);
        $ctgrBlog = $this->BlogService->getCtgr();
        $blogNew = $this->BlogService->blogNew();
        if (!isset($countCart)) {
            $countCart = 0;
        }
        $data = [
            "title" => "Tin tức mới",
            "pages" => [
                "pages.blog"
            ],
            'countCart' => $countCart,
            'blog' => $blog,
            'ctgr_blog' =>$ctgrBlog,
            'blognew' =>$blogNew
        ];
        return view('master_layout', $data);
    }
    public function blogDetail($slug){
        $countCart = $this->productService->getUserCart();
        $countCart = count($countCart);
        $blog = $this->BlogService->blogDetail($slug);
        $ctgrBlog = $this->BlogService->getCtgr();
        if (!isset($countCart)) {
            $countCart = 0;
        }
        $data = [
            "title" => $blog->name,
            "pages" => [
                "pages.blog_detail"
            ],
            'countCart' => $countCart,
            'blog' => $blog,
            'ctgr_blog' =>$ctgrBlog
        ];
        return view('master_layout', $data);
    }
    public function getBlogApi(){
        $result = $this->BlogService->allBlog();
        return json_encode($result);
    }
}
