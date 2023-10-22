<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDoListRequest;
use App\ToDoList;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $todolist;
    public function __construct(ToDoList $todolist)
    {
        $this->todolist = $todolist;
    }
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
     * @return \Illuminate\Http\Response
     */
    public function store(ToDoListRequest $request)
    {
        $list = $this->todolist;
        $list->date = $request->date;
        $list->description = $request->description;
        $list->amount = $request->amount;
        $list->category = $request->category;

        $list->save();

        // $list = ToDoList::get();

        return redirect()->route("showlist");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $list = ToDoList::orderBy('created_at', 'desc')->paginate(6);

        $prices = ToDoList::select('amount')->get();

        $totalPrice = 0;
        foreach ($prices as $price) {
            $calprice = $price->amount;
            $totalPrice += $calprice;

        }

        // dd($totalPrice);

        return view('todolist', ['list' => $list, 'totalprice' => $totalPrice]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $updateitem = ToDoList::find($id);
        $list = ToDoList::orderBy('created_at', 'desc')->paginate(6);


        // dd($updateitem);
        
        $prices = ToDoList::select('amount')->get();

        $totalPrice = 0;
        foreach ($prices as $price) {
            $calprice = $price->amount;
            $totalPrice += $calprice;

        }

        return view('update', ['updateitem' => $updateitem, 'list' => $list,  'totalprice' => $totalPrice]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateitem = ToDoList::find($id);
        $updateitem->date = $request->date;
        $updateitem->description = $request->description;
        $updateitem->amount = $request->amount;
        $updateitem->category = $request->category;
        $updateitem->update();

        return redirect()->route("showlist");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = ToDoList::find($id);
        $list->delete();

        return redirect()->route("showlist");

    }
}
