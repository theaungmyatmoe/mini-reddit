<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use App\Models\PostVote;

class CommunityPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Community $community)
    {
        return view('posts.create', compact('community'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Community $community)
    {
        $post = $community->posts()->create($request->validated() + [
                'user_id' => auth()->id()
            ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/posts', "{$post->id}/{$image->getClientOriginalName()}");
            $post->update([
                "image" => "posts/{$post->id}/{$image->getClientOriginalName()}"
            ]);
        }

        return redirect()->route('communities.show', $community)->with('message', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community, Post $post)
    {
        if ($post->community_id !== $community->id) {
            abort(404);
        }
        return view('posts.show', compact('post', 'community'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Community $community, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }
        return view('posts.edit', compact('post', 'community'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Community $community, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $oldPost = $post->replicate();
        $post->update($request->validated());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/posts', "{$post->id}/{$image->getClientOriginalName()}");

            if ($post->image !== "") {
                unlink(storage_path("app/public/$oldPost->image"));
            }

            $post->update([
                'image' => "posts/{$post->id}/{$image->getClientOriginalName()}"
            ]);
        }


        return redirect()->route('communities.posts.show', [$community, $post])->with('message', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community, Post $post)
    {
        $post->delete();

        return redirect()->route('communities.show', $post->community)->with('message', 'Post deleted successfully');
    }

    public function vote(Post $post, int $vote)
    {

        if (
            !PostVote::where('user_id', auth()->id())
                ->where('post_id', $post->id)
                ->exists()
            && collect([-1, 1])->contains($vote)
            && $post->user_id !== auth()->id()
        ) {
            PostVote::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id,
                'vote' => $vote
            ]);

            $post->increment('votes', $vote);

        }


        return redirect()->route('communities.show', [$post->community]);
    }
}
