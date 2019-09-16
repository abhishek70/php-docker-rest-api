<?php

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Luracast\Restler\RestException;
use Illuminate\Support\Facades\Config;
use Models\Review;

/**
 * Class Reviews
 * @package Controllers
 *
 */
class Reviews
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return LengthAwarePaginator
	 */
    public function index()
    {
    	return Review::paginate(Config::get('app.paginate'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id Id {@min 1}
     *
     * @return Review
	 *
	 * @throws 404
     */
     public function get($id)
     {
		 if(!$review = Review::find($id))
		 {
			 throw new RestException(404, 'review not found');
		 }
		 return $review;
     }

	/**
	 * Creating a new resource.
	 *
	 * @param Review $review
	 *
	 * @return Review
	 *
	 * @throws 400
	 */
    public function post(Review $review)
    {
		if(!$review->save())
		{
			throw new RestException(400, 'review not saved');
		}

		return $review;
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id Id {@min 1}
	 *
	 * @return array
	 *
	 * @throws 404
	 */
    public function delete($id)
    {
		if(!$review = Review::find($id)){
			throw new RestException(404, 'review not found');
		}
		$review->delete();
		return ['success'=>true];
    }
}
