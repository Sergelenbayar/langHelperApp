<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Kanji;

class KanjiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kanjis =  Kanji::paginate(4);
        $categories = Category::all();
        // $kanji = Kanji::find(2);
        // dd($kanji->category == null ? "null":"0");
        return view('kanji',compact('kanjis','categories'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Kanji $kanji)
    {
        $request->validate([
            'meaningMon'=>'required',
        ]);
        $kanji->meaningMon = $request->get('meaningMon');
        $kanji->categoryId = $request->get('categoryId');
        $kanji->jlptLevel = $request->get('jlptLevel');
        $kanji->save();


        $routeParams='?'.'page='.$request->get('pageNumber');
        // if($request->get('page')){
        //     $routeParams[] = '?'.'page=13'.$request->get('page');
        // }

        return redirect()->route('kanjis.index',$routeParams);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
