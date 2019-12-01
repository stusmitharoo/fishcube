<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Media\BlogTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Models\Media\Blog;
use App\Models\Card\Card;
use Validator;
use Auth;

class BlogPartsController extends Controller
{
    public function listChoice()
    {
        return view('blog.listChoice');
    }

    public function card(Request $request,Card $card )
    {
        return view('blog.createCard', compact('card'));
    }

     public function userBlog(Request $request,$styleId, $districtId )
    {
        $userId = $request->user()->id;
        $blogs = Blog::getUserBlogs($userId, $styleId, $districtId );
        $blogsCollection = $blogs->getCollection();

          return fractal()
            ->collection($blogsCollection)
            ->transformWith(new BlogTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($blogs))
            ->toArray();
    }

    public function update(Request $request, $id)
    {
      
        $this->validate($request, [
          'blog_id' => 'required|integer',
        ]);

        $cardId = $request->route('id');
        
        $blog = Card::findOrFail($cardId);

        $blog->blog_id = $request->blog_id;

        $blog->save();

       return $blog->toJson();
    }

    public function linkUpdate(Request $request, $blogId)
    {

        Card::where('blog_id', '=', $blogId)->update(['blog_id' => null]);

        return;
    }
}
