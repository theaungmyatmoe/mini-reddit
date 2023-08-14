<?php

namespace App\Http\Controllers;

use App\Http\Requests\Community\CommunityStoreRequest;
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
        //
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

        return redirect()->route('communities.show', compact('community'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community)
    {
        return $community->id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
