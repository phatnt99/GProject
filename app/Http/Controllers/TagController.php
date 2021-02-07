<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditTagRequest;
use App\Http\Requests\NewTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function index(Request $request)
    {
        $listTag = Tag::when($request->type, function ($query) use ($request) {
            return $query->where('type', 'LIKE', '%'.$request->type.'%');
        })->when($request->value, function ($query) use ($request) {
            return $query->where('value', 'LIKE', '%'.$request->value.'%');
        })->when($request->description, function ($query) use ($request) {
            return $query->where('description', 'LIKE', '%'.$request->description.'%');
        })->orderBy('updated_at', 'desc')->paginate(5);

        return view('tag', ['tags' => $listTag]);
    }

    public function create()
    {
        return view('new-tag');
    }

    public function store(NewTagRequest $request)
    {
        $newTag = Tag::create($request->all());

        return redirect()->back()->with('success', $newTag);
    }

    public function edit(Tag $tag)
    {
        return view('edit-tag', ["tag" => $tag]);
    }

    public function update(EditTagRequest $request,Tag $tag)
    {
        $tag->update($request->all());
        return redirect(route("tag.edit", $tag))->with('success', $tag);
    }

    public function delete(Tag $tag) {
        $tag->delete();

        return redirect()->back()->with('success', $tag);
    }
}
