<?php

namespace App\Http\Controllers;

use App\Constant\BlogStatus;
use App\Models\Blog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function getBlog(Request $request)
    {
        return $request
            ->user()
            ->blogs()
            ->withCount([
                'likes as liked_count' => function ($q) {
                    return $q->where("is_like", true);
                },
                'likes as dislike_count' => function ($q) {
                    return $q->where("is_like", false);
                }
            ])
            ->paginate(10);
    }

    public function showBlog(Request $request, $id)
    {
        $blog = $request->user()->blogs()->where("id", $id)->first();
        return response()->json(['data' => $blog], 200);
    }

    public function updateBlog(Request $request, $id)
    {
        $blog = $request->user()->blogs()->where("id", $id)->first();
        $blog->title = $request->title;
        $blog->content = $request->content;
        if ($request->has('status')) {
            $blog->status = $request->status;
        }
        $blog->save();

        return response()->json(['data' => $blog], 200);
    }

    public function publishBlog(Request $request, $id)
    {
        $blog = $request->user()->blogs()->where("id", $id)->first();
        $blog->status = $request->status;
        $blog->save();

        return response()->json(['data' => $blog], 200);
    }

    public function createBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 403);
        }

        $blog = $request->user()->blogs()->create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => BlogStatus::PENDING
        ]);

        return response()->json(['data' => $blog], 200);
    }

    public function deleteBlog(Request $request, $id)
    {
        $blog = $request->user()->blogs()->where("id", $id)->first();
        $blog->delete();
        return response()->json(['message' => 'success']);
    }
}
