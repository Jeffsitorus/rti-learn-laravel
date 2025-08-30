<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    public function index(Request $request)
    {
        try {
            $q = $request->q ?? null;
            $limit = $request->limit ?? 10;

            $tags = Tag::select(
                'id',
                'name',
                'slug',
                'created_at'
            )
                ->when($q, function ($query, $q) {
                    return $query->where('name', 'LIKE', "%{$q}%");
                })
                ->paginate($limit);

            return response()->json([
                'data'      => $tags,
                'error'     => false,
                'status'    => 'success',
                'message'   => 'Successfully fetched tags'
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'data'      => null,
                'error'     => true,
                'status'    => 'success',
                'message'   => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'  => 'required|string|max:50|unique:tags,name'
            ]);

            $tag = Tag::create([
                'name'  => $request->name,
                'slug'  => Str::slug($request->name)
            ]);

            return response()->json([
                'data'      => $tag,
                'error'     => false,
                'status'    => 'success',
                'message'   => 'Successfully created tag'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data'      => null,
                'error'     => true,
                'status'    => 'success',
                'message'   => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    public function all()
    {
        try {
            $tags = Tag::select('id', 'name')->get();

            return response()->json([
                'data'      => $tags,
                'error'     => false,
                'status'    => 'success',
                'message'   => 'Successfully fetched tag'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data'      => null,
                'error'     => true,
                'status'    => 'success',
                'message'   => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    public function show($id)
    {
        try {
            $tag = Tag::select(
                'id',
                'name',
                'slug'
            )->findOrFail($id);

            return response()->json([
                'data'      => $tag,
                'error'     => false,
                'status'    => 'success',
                'message'   => 'Successfully created tag'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data'      => null,
                'error'     => true,
                'status'    => 'success',
                'message'   => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name'  => 'required|string|max:50|unique:tags,name,' . $id
            ]);

            $tag = Tag::where('id', $id)->first();

            if (!$tag) {
                throw new \Exception('Tag not found', 404);
            }

            $tag->name = $request->name;
            $tag->slug = Str::slug($request->name);
            $tag->save();

            return response()->json([
                'data'      => $tag,
                'error'     => false,
                'status'    => 'success',
                'message'   => 'Successfully updated tag'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data'      => null,
                'error'     => true,
                'status'    => 'success',
                'message'   => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
