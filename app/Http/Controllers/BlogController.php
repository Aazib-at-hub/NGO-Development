<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // List all blogs
    public function index()
    {
        return Blog::with('user')->get();
    }

    // Show single blog
    public function show($id)
    {
        $blog = Blog::with('user')->find($id);
        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }
        return $blog;
    }

    // Create new blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'Blog created', 'blog' => $blog], 201);
    }

    // Update blog
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        if ($blog->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $blog->update($request->only('title', 'content'));

        return response()->json(['message' => 'Blog updated', 'blog' => $blog]);
    }

    // Delete blog
    public function destroy(Request $request, $id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        if ($blog->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog deleted']);
    }
}
