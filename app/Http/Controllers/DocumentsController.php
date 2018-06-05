<?php

namespace App\Http\Controllers;

use App\Document;
use App\Movement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('/me/profile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function documentStore(Request $request, $id)
    {
        $movement = Movement::findOrFail($id);

        $data =$request-> validate([
            'document_file'=> 'file|mimes:pdf,jpeg, PNG',
            'documentDescription'=> 'string|nullable'
        ]);
        if (request()->hasfile('document_file') && request()->file('document_file')->isValid()) {
            $document= new Document;
            $document->type = $request->file('document_file')->getClientOriginalExtension();
            $document->original_name = $request->file('document_file')->getClientOriginalName();
            $document->description = $data['documentDescription'];
            $document->created_at = Carbon::now();


            $document->save();
            $movement->document_id = $document->id;
            $movement->save();
            Storage::putFileAs('documents/' . $movement->account_id, $request->file('document_file'), $movement->id . '.' . $document['type']);
        }
        return redirect()->route('movements.account', $movement->account_id)
            ->with('success', 'Document add successfully');

    }

    public function documentGet($document)
    {

        $movement = Movement::where('document_id', $document->id)->get();

        $path = storage_path('app/documents/'.$movement->account_id.'/'.$movement->id. '.' .$document->type);
        return response()->download($path,$document->original_name);
    }

}
