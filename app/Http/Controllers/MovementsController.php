<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\StoreMovementRequest;
use App\Http\Requests\UpdateMovementRequest;
use App\Movement;
use App\Document;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MovementsController extends Controller
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
    public function movementsAccount()
    {
        $id = request()->route('account');
        $account = Account::findOrFail($id);
        $user = User::findOrFail($account->owner_id);
       // if (Auth::id() == $account->owner_id) {
            $movements = Movement::where('account_id', '=', $id)->orderby('date', 'desc')->get();
            $pagetitle = "List of Movements";
            return view('movements.list', compact('movements', 'account', 'pagetitle'));
//        } else {
//            return Response::make(view('home'), 403);
//        }

    }

    public function movementCreate()
    {
        $account = Account::where('owner_id', '=', auth()->user()->id)->value('id');
        $movement = new Movement();
        $pagetitle = "Create Movement";
        return view('movements.add', compact('movement', 'account', 'pagetitle'));
    }

    public function edit($id)
    {
        $account = Account::where('owner_id', '=', auth()->user()->id)->value('id');
        $movement = Movement::findOrFail($id);
        $pagetitle = "Edit Movement";
        return view('movements.edit', compact('movement', 'account', 'pagetitle'));
    }

    public function movementDelete($id)
    {
        $movement = Movement::findOrFail($id);
        $movement->forceDelete();

        return redirect()
            ->route('movements.account', auth()->user()->id)
            ->with('success', 'Movement deleted successfully');
    }

    public function movementStore(Account $account)
    {
        $request = request();
        $data = $request->validate([
            'movement_category_id' => 'required|integer|between:1,18',
            'date' => 'date_format:"Y/m/d"|required',
            'value' => 'required|numeric|between:-99999.99,999999.99',
            'description' => 'string|nullable',
            'document_file' => 'file|mimes:pdf,jpeg,png',
            'documentDescription' => 'string|nullable'
        ]);
        $movement = new Movement($data);
        $movement->account_id = $account->id;

        $aux =$account->movements()->where('date','>', $data['date'])->first();
        if (isset($aux)) {
           $movement->start_balance = $aux['end_balance'];
            $movement->value = $data['value'];
            if ($movement->movement_category_id < '12') {
                $movement->type = 'expense';
                $movement->end_balance = $movement->start_balance - $movement->value;
            } else {
                $movement->type = 'revenue';
                $movement->end_balance = $movement->start_balance + $movement->value;
            }

        }else{
            $movement->start_balance = $account->start_balance;
            if ($movement->movement_category_id < '12') {
                $movement->type = 'expense';
                $movement->end_balance = $movement->start_balance - $movement->value;
            } else {
                $movement->type = 'revenue';
                $movement->end_balance = $movement->start_balance + $movement->value;
            }
        }


////        $movement->start_balance = '0';
//        $movement->end_balance = '0';
        $movement->movement_category_id = $request->input('movement_category_id');
        $movement->description = $data['description'];
        $movement->created_at = Carbon::now();

        //$movements_atualizar = where(['date' <= $movement->date],['created_at' < $movement->created_at])->get();


        $movement->save();

        if (request()->hasfile('document_file') && request()->file('document_file')->isValid()) {
            $document = new Document;
            $document->type = $request->file('document_file')->getClientOriginalExtension();
            $document->original_name = $request->file('document_file')->getClientOriginalName();
            $document->description = $data['documentDescription'];
            $document->created_at = Carbon::now();


            $document->save();
            $movement->document_id = $document->id;
            $movement->save();
            Storage::putFileAs('documents/' . $movement->account_id, $request->file('document_file'), $movement->id . '.' . $document['type']);
        }

        return redirect()
            ->route('movements.account', $account)
            ->with('success', 'Movement added successfully');
    }

    public function update(UpdateMovementRequest $request, $id)
    {
        if ($request->has('cancel')) {
            return redirect()->action('MovementsController@movementsAccount');
        }

        $movementModel = $request->validate([
        ], [
            //
        ]);
        $movement = Movement::findOrFail($id);
        $movement->fill($movementModel);
        $movement->save();

        return redirect()
            ->route('movements.account')
            ->with('success', 'Movement saved successfully');
    }

    public function showFormDocument()
    {
        $id = request()->route('movement');
        $movement = Movement::findOrFail($id);

        return view('movements.add-documents', compact('movement'));
    }

}
