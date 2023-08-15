<?php

namespace App\Http\Controllers;

use App\Http\Requests\Community\CommunityStoreRequest;
use App\Http\Requests\Community\CommunityUpdateRequest;
use App\Models\Community;
use App\Models\Topic;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $communities = auth()->user()->communities()->get();
        return view('communities.index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $topics = Topic::all();
        return view('communities.create', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityStoreRequest $request)
    {
        $community = Community::create($request->validated() + ['user_id' => auth()->id()]);
        $community->topics()->attach($request->topics);

        return redirect()->route('communities.index')->with('message', 'Community created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community)
    {
        if ($community->user_id != auth()->id()) {
            return redirect()->route('communities.index')->with('message', 'You are not authorized to edit this community');
        }

        $posts = $community->posts()->latest('id')->paginate(5);

        return view('communities.show', compact('community', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Community $community)
    {
        if ($community->user_id != auth()->id()) {
            return redirect()->route('communities.index')->with('message', 'You are not authorized to edit this community');
        }

        $community->load('topics');
        $topics = Topic::all();
        return view('communities.edit', compact('community', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommunityUpdateRequest $request, Community $community)
    {
        if ($community->user_id != auth()->id()) {
            return redirect()->route('communities.index')->with('message', 'You are not authorized to edit this community');
        }

        $community->update($request->validated());
        $community->topics()->sync($request->topics);

        return redirect()->route('communities.index')->with('message', 'Community updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        if ($community->user_id != auth()->id()) {
            return redirect()->route('communities.index')->with('message', 'You are not authorized to edit this community');
        }

        $community->delete();
        return redirect()->route('communities.index')->with('message', 'Community deleted successfully');
    }
}
