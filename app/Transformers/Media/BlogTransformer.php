<?php  

namespace App\Transformers\Media;

use App\Models\Media\Blog;
use App\Models\Card\Card;
use App\Transformers\UserTransformer;


class BlogTransformer extends \League\Fractal\TransformerAbstract
{
	protected $availableIncludes = [
					'user'
				];

		
	public function transform(Blog $blog)
	{
		return [
			'id' => $blog->id,
			'user_id' => $blog->user_id,
			'style_id' => $blog->style_id,
			'district_id' => $blog->district_id,
			'date' => $blog->date,
			'title' => $blog->title,
			'excerpt' => $blog->excerpt,
			'content' => $blog->content,
			'thumbnail' => $blog->getBlogThumbnail($blog),
		];
	}

	public function includeUser(Blog $blog)
	{
		return $this->item($blog->user, new UserTransformer);
	}
}