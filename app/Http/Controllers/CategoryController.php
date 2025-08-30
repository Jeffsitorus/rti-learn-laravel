<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        // transaction
        try {
            // DB::beginTransaction();

            // DB::commit();
        } catch (\Exception $e) {
            // DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        //
    }

    public function all()
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
