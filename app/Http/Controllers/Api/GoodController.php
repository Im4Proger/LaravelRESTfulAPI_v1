<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Good;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Null_;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
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
            '*.text' => 'required|max:255',
            '*.price' => 'required|numeric',
            '*.url' => 'required|max:100',
            '*.is_public' => 'required|digits_between:0,1',
        ]);
        foreach($request->all() as $item) {
            if ((count($item['categories'])>=2) && (count($item['categories'])<=10)) {
                $good = Good::create($item);
                $good->categories()->attach($item['categories']);
            }
        }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            '*.id' => 'required|numeric',
            '*.name' => 'required|max:255',
            '*.text' => 'required|max:255',
            '*.price' => 'required|numeric',
            '*.url' => 'required|max:100',
            '*.is_public' => 'required|digits_between:0,1',
        ]);
        foreach($request->all() as $item) {
            Good::where('id', $item['id'])
            ->update($item);
        }
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
        ], 200);
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
        foreach($request->all() as $item) {
            Good::where('id', $item['id'])->delete();
        }
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
        ], 200);
    }

    /**
     * Display a listing of the resource by complete coincidence name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function goodNameLike(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            '*.value' => 'required|string',
        ]);
        $items = $request->all();
        $item = $items[0];
        $goods = Good::where('name', 'like', $item['value'])
            ->orderBy('id')
            ->take(10)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
            'results' => $goods,
        ], 200);
    }

    /**
     * Display a listing of the resource by partial coincidence name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function goodNameLikePartial(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            '*.value' => 'required|string',
        ]);
        $items = $request->all();
        $item = $items[0];
        $goods = Good::where('name', 'like', '%'.$item['value'].'%')
            ->orderBy('id')
            ->take(10)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
            'results' => $goods,
        ], 200);
    }

    /**
     * Display a listing of the resource by category_id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryId(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            '*.value' => 'required|numeric',
        ]);
        $items = $request->all();
        $item = $items[0];
        $goods = Good::whereHas('categories', function (Builder $query) use ($item) {
            $query->where('category_id', '=', $item['value']);
        })
            ->orderBy('id')
            ->take(10)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
            'results' => $goods,
        ], 200);
    }

    /**
     * Display a listing of the resource by complete coincidence category name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryNameLike(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            '*.value' => 'required|string',
        ]);
        $items = $request->all();
        $item = $items[0];
        $goods = Good::whereHas('categories', function (Builder $query) use ($item) {
            $query->where('name', 'like', $item['value']);
        })
            ->orderBy('id')
            ->take(10)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
            'results' => $goods,
        ], 200);
    }

    /**
     * Display a listing of the resource by partial coincidence category name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryNameLikePartial(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            '*.value' => 'required|string',
        ]);
        $items = $request->all();
        $item = $items[0];
        $goods = Good::whereHas('categories', function (Builder $query) use ($item) {
            $query->where('name', 'like', '%'.$item['value'].'%');
        })
            ->orderBy('id')
            ->take(10)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
            'results' => $goods,
        ], 200);
    }

    /**
     * Display a listing of the resource by price
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function price(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            '*.value_min' => 'required|numeric',
            '*.value_max' => 'required|numeric',
        ]);
        $items = $request->all();
        $item = $items[0];
        $goods = Good::where([
            ['price', '>=', $item['value_min']],
            ['price', '<=', $item['value_max']],
        ])
            ->orderBy('id')
            ->take(10)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
            'results' => $goods,
        ], 200);
    }

    /**
     * Display a listing of the resource by is_public
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function isPublic(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            '*.value' => 'required|string',
        ]);
        $items = $request->all();
        $item = $items[0];
        $goods = Good::where('is_public', '=', $item['value'])
            ->orderBy('id')
            ->take(10)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
            'results' => $goods,
        ], 200);
    }

    /**
     * Display a listing of the resource by deleted
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleted(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            '*.value' => 'required|string',
        ]);
        $items = $request->all();
        $item = $items[0];
        $goods = Good::where('id', '>', 0)
            ->orderBy('id')
            ->take(10)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'action completed successfully',
            'results' => $goods,
        ], 200);
    }
}
