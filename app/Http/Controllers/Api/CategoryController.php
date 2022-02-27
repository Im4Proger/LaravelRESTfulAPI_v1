<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            '*.name' => 'required|max:255',
            '*.url' => 'required|max:100',
        ]);
        foreach($request->all() as $item) {
            Category::create($item);
        }
        var_dump($request->all());
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            '*.id' => 'required|numeric',
        ]);
        $categories_errors = '';
        foreach($request->all() as $item) {
           if (Category::has('goods')->get()->contains($item['id']) == false) {
                Category::where('id', $item['id'])->delete();
            }
            else
            {
                $categories_errors .= $item['id'].', ';
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully. errors: can\'t delete non-empty categories '.$categories_errors
        ], 200);
    }
}
