<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Http\Requests\StoreFinanceRequest;
use App\Http\Requests\UpdateFinanceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;


use function PHPSTORM_META\type;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('home', [
        'title' => 'Home',
        'finances' => Finance::latest()->paginate(2),
        'revenue' => DB::table('finances')->where('type', 'pemasukan')->sum('amount'),
        'expense' => DB::table('finances')->where('type', 'pengeluaran')->sum('amount')
       
        
      ]);
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
     * @param  \App\Http\Requests\StoreFinanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinanceRequest $request)
    {
     
        $validatedData = $request->validate([

            "title" => "required|max:255",
            "amount" => "required|numeric",
            "date" => "required|date",
            "type" => "in:pengeluaran,pemasukan"
        ]);

       
        Finance::create($validatedData);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
 
    {
      
       $finance = Finance::find($id);
       return response()->json([
           'status' => 200,
           'finance' => $finance
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFinanceRequest  $request
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinanceRequest $request, $id)
    {
        $validatedData = $request->validate([

            "title" => "required|max:255",
            "amount" => "required|numeric",
            "date" => "required|date",
            "type" => "in:pengeluaran,pemasukan"
        ]);

       Finance::where('id', $id)
        ->update($validatedData);
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        Finance::destroy($id);
      return redirect('/home');
    }
}
