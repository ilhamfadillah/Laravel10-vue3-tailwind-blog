<?php

namespace App\Http\Controllers;

use App\Constant\BlogStatus;
use App\Models\Blog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::where("status", BlogStatus::PUBLISHED)
            ->with('user')
            ->withCount(['likes as liked_count' => function ($query) {
                return $query->where("is_like", true);
            }])->orderByDesc("liked_count")
            ->paginate(10);
    }

    public function show(Request $request, $id)
    {
        try {
            return Blog::where("id", $id)
                ->where("status", BlogStatus::PUBLISHED)
                ->with('user')->withCount(['likes as liked_count' => function ($query) {
                    return $query->where("is_like", true);
                }])->firstOrFail();
        } catch (ModelNotFoundException) {
            return response()->json([
                "error" => "data not found."
            ], 404);
        }
    }

    public function search(Request $request) 
    {
        return Blog::where("title", "like", "%" . $request->search . "%")
            ->where("status", BlogStatus::PUBLISHED)
            ->with('user')
            ->withCount(['likes as liked_count' => function ($query) {
                return $query->where("is_like", true);
            }])->orderByDesc("liked_count")
            ->paginate(10);
    }
}
