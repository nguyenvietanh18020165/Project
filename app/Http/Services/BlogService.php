<?php


namespace App\Http\Services;


use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\categoris as Categoris;
use App\Models\images;
use App\Models\products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogService
{


    public function getCtgr($id = false){
        if($id == false){
            $result = BlogCategory::all();
        }else{
            $result = BlogCategory::where('id', $id)->first();
        }
        return $result;

    }

    public function addCategory($name)
    {
        $result = BlogCategory::where('name', $name)->get();
        if (count($result) >= 1) {
            return false;
        } else {
            BlogCategory::create([
                "name" => $name,
                "slug" => Str::slug($name, "-")
            ]);
            return true;
        }
    }

    public function deleteCategory($id)
    {
        $result = BlogCategory::where('id', $id)->get();
        if (count($result) >= 1) {
            BlogCategory::where("id", $id)->delete();
            return true;
        }
        return false;
    }

    public function create($request)
    {
        $slugCtgrblog = $this->getCtgr($request->input("listCtgrBlog"))->slug;
        $code = strtoupper($slugCtgrblog) . time();
        $file = $request->file("BlogImage");
        $ext = $file->extension();
        $fileName = 'blog-' . time() . '.' . $ext;
        $file->move(public_path("upload/images/blogs"), $fileName);

        $Blog = Blog::create([
            "name" => (string)$request->input("BlogName"),
            "news" => (string)$request->input("BlogNews"),
            "desc" => (string)$request->input("BlogDesc"),
            "category" => (int)$request->input("listCtgr"),
            "blog_category" => (int)$request->input("listCtgrBlog"),
            "user_id" => Auth::id(),
            "image" => 'upload/images/blogs/' . $fileName,
            "slug" => Str::slug($request->input("BlogName"), "-")."-".$code
        ]);

        return true;
    }

    public function allBlog(){
        $result = Blog::orderBy('id', 'desc')->paginate(5);
        for ($i = 0; $i < count($result); $i++){
            $result[$i]->blog_category = $this->nameCtgrBlog($result[$i]->blog_category);
            $result[$i]->category = $this->nameCtgr($result[$i]->category);
            $result[$i]->user_name = $this->nameUser($result[$i]->user_id);
        }
        return $result;
    }

    public function nameCtgrBlog($id){
        $result = BlogCategory::where('id', $id)->first();
        return $result->name;
    }

    public function nameCtgr($id){
        $result = Categoris::where('id', $id)->first();
        return $result->name;
    }

    public function nameUser($id){
        $result = User::where('id', $id)->first();
        return $result->name;
    }

    public function deleteBlog($id){
        $result = Blog::where('id', $id)->get();
        if(count($result) > 0){
            Blog::where('id', $id)->delete();
            return true;
        }

        return false;
    }

    public function getBlog($id){
        $result = Blog::where('id', $id)->first();
        return $result;
    }

    public function updateBlog($request, $id){
        $slugCtgrblog = $this->getCtgr($request->input("listCtgrBlog"))->slug;
        $code = strtoupper($slugCtgrblog) . time();
        if($request->hasfile('productImages')){
            $file = $request->file("BlogImage");
            $ext = $file->extension();
            $fileName = 'blog-' . time() . '.' . $ext;
            $file->move(public_path("upload/images/blogs"), $fileName);
            $Blog = Blog::where('id', $id)->update([
                "name" => (string)$request->input("BlogName"),
                "news" => (string)$request->input("BlogNews"),
                "desc" => (string)$request->input("BlogDesc"),
                "category" => (int)$request->input("listCtgr"),
                "blog_category" => (int)$request->input("listCtgrBlog"),
                "user_id" => Auth::id(),
                "image" => 'upload/images/blogs/' . $fileName,
                "slug" => Str::slug($request->input("BlogName"), "-")."-".$code
            ]);
        }else{
            $Blog = Blog::where('id', $id)->update([
                "name" => (string)$request->input("BlogName"),
                "news" => (string)$request->input("BlogNews"),
                "desc" => (string)$request->input("BlogDesc"),
                "category" => (int)$request->input("listCtgr"),
                "blog_category" => (int)$request->input("listCtgrBlog"),
                "user_id" => Auth::id(),
                "slug" => Str::slug($request->input("BlogName"), "-")."-".$code
            ]);
        }
        return true;
    }

    public function blogNew(){
        $result = Blog::orderBy('id', 'desc')->limit(5)->get();
        for ($i = 0; $i < count($result); $i++){
            $result[$i]->blog_category = $this->nameCtgrBlog($result[$i]->blog_category);
            $result[$i]->category = $this->nameCtgr($result[$i]->category);
            $result[$i]->user_name = $this->nameUser($result[$i]->user_id);
        }
        return $result;
    }

    public function BlogInCtgr($id){
        $ctgr_id = $this->getCtgrInSlug($id);
        $result = Blog::where('blog_category', $ctgr_id->id)->orderBy('id', 'desc')->paginate(5);
        for ($i = 0; $i < count($result); $i++){
            $result[$i]->blog_category = $this->nameCtgrBlog($result[$i]->blog_category);
            $result[$i]->category = $this->nameCtgr($result[$i]->category);
            $result[$i]->user_name = $this->nameUser($result[$i]->user_id);
        }
//        dd($result);
        return $result;
    }

    public function getCtgrInSlug($slug){
        $result = BlogCategory::where('slug', $slug)->first();
        return $result;
    }

    public function blogDetail($slug){
        $result = Blog::where('slug', $slug)->first();
        $result->blog_category = $this->nameCtgrBlog($result->blog_category);
        $result->category = $this->nameCtgr($result->category);
        $result->user_name = $this->nameUser($result->user_id);
        return $result;
    }
}
