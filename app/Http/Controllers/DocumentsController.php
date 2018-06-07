<?php

namespace App\Http\Controllers;

use App\Account;
use App\Document;
use App\Movement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
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

    public function documentGet($id)
    {
        $document =  Document::findOrFail($id);
        $movement = Movement::where('document_id', $document->id)->first();

        $path = storage_path('app/documents/'.$movement->account_id.'/'.$movement->id. '.' .$document->type);
        return response()->download($path,$document->original_name);
    }

    public function documentDelete($id)
    {
        $document = Document::findOrFail($id);
        $movement = $document->document;
        $accountId = $movement->account_id;
        $account = Account::findOrFail($accountId);
        if(Auth::user()->id == $account->owner_id){
            if ($document->id != null)
            {

                $movement->document_id =null;
                $movement->update();

                $document->delete();

                Storage::disk('local')->delete('documents/' . $movement->account_id . '/' . $movement->id . '.' . $document->type);

            }

            return redirect()->route('home')
                ->with('success', 'Document deleted successfully');
        } else{
            return Response::make(view('accounts.list'), 403);
        }

    }

}
