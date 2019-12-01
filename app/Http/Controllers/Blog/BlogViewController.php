<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Transformers\card\CardTransformer;
use App\Transformers\media\BlogTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Http\Controllers\Controller;
use App\Models\Card\Card;
use App\Models\Media\Blog;
use App\Models\Profile\Style;
use App\User;

class BlogViewController extends Controller
{
    public function choice()
    {
        return view('blog.choice');
    }

    public function viewChoice()
    {
        return view('blog.view.choice');
    }

    public function index(Style $style)
    {
        return view('blog.view.index', compact('style'));
    }

    public function list(Request $request, $styleId, $districtId )
    {
        $blogs = Blog::getBlogs($styleId, $districtId);
      
        $blogsCollection = $blogs->getCollection();

        return fractal()
           ->collection($blogsCollection)
           ->parseIncludes(['user'])
           ->transformWith(new BlogTransformer)
           ->paginateWith(new IlluminatePaginatorAdapter($blogs))
           ->toArray();
    }

    public function cards(Request $request, $userId, $blogId)
    {
        
        $blogCards = Card::getBlogCards($userId, $blogId);

        $blogCardsCollection = $blogCards->getCollection();

        return fractal()
            ->collection($blogCardsCollection)
            ->parseIncludes([''])
            ->transformWith(new CardTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($blogCards))
            ->toArray();
    }

    public function show(Request $request, Blog $blog)
    {
        $userId = $blog->user_id;
        $view = User::viewable($userId)->get();

        if(!$view->isEmpty()){
            return view('blog.show', compact('blog'));
        }

        return back()->withInfo('This video is private try searching for another.');
        
    }
}
