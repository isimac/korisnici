<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biljeska;

class BiljeskaController extends Controller
{
    public function index()
    {
        $biljeske=auth()->user()->biljeske;
        //select * from biljeske where user_id=1;
        return view('biljeske', ['biljeske' =>$biljeske]);
    }

    public function store(Request $request)
    {
        $podaci=$request->validate([
            'naslov'=>'required|string|max:255',
            'sadrzaj' => 'required|string'
        ]);
        $request->user()->biljeske()->create($podaci);
        return redirect('/biljeske');
    }

    public function update(Request $request, Biljeska $biljeska)
    {
        abort_unless($biljeska->user_id==$request->user()->id, 403);
        //if ($biljeska->user_id!=$request->user()->id)
        //{abort(403);}

        $podaci=$request->validate([
            'naslov'=>'required|string|max:255',
            'sadrzaj' => 'required|string'
        ]);

        $biljeska->update($podaci);
        return redirect('/biljeske');
    }

    public function destroy(Request $request, Biljeska $biljeska)
    {
        abort_unless($biljeska->user_id==$request->user()->id, 403);
        $biljeska->delete();
        return redirect('/biljeske');
    }
}
