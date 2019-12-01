<?php

namespace App\Http\Controllers\Blog;

use App\Models\Media\Blog;
use App\Models\Profile\Style;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Purifier;
use Image;
Use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Style $style)
    {
        return view('blog.index', compact('style'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Style $style)
    {
        return view('blog.create', compact('style'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'style_id' => 'required|integer',
        'district_id' => 'required|integer',
        'title' => 'required|string|max:40',
        'excerpt' => 'required|string|max:50',
        'content' => 'required',
    ]);

        $message = $request->content;

        $dom = new \DOMDocument();
        $dom->loadHtml($message, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        // for each img in content
        foreach($images as $img) {
            $src = $img->getAttribute('src');

            // if img src is 'data url'
            if(preg_match('/data:image/', $src)){

                // get mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];

                $filename = uniqid();
                $filepath = public_path('images/blogs/' . $filename . '.' . $mimetype);

                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save($filepath);

                // TODO may need to tinker with $new_src on production.
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);  
            } 
        }

        $blog = new Blog;

        $blog->style_id = $request->style_id;
        $blog->district_id = $request->district_id;
        $blog->title = $request->title;
        $blog->excerpt = $request->excerpt;
        $blog->content = Purifier::clean($dom->saveHtml());
        $blog->user_id = Auth::user()->id;

        $blog->save();

        return $blog->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $this->authorize('touch', $blog);

        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->authorize('touch', $blog);

        $this->validate($request, [
              'title' => 'required|string|max:30',
              'excerpt' => 'required|string|max:50',
              'content' => 'required|max:5000',
        ]);

      $blog->title = $request->title;
      $blog->excerpt = $request->excerpt;
      $blog->content = Purifier::clean($request->content);

      $blog->save();

      return $blog->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {

        $this->authorize('touch', $blog);

        $blog->delete();

        return $blog->toJson();
    }
}
