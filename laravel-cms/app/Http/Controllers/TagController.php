<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;

class TagController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $tags = $request->additionalTag;

        if (str_contains($tags , ',')) {
            $tags = explode(',', $tags );
        }

        if (is_array($tags)) {
            foreach ($tags as $tag) {
                Tag::create(['name' => $tag]);
            }
        } else {
            Tag::create(['name' => $tags]);
        }

        return redirect()->back()->withFlashMessage("Oznaka je uspješno dodana");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
