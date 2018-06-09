<?php

namespace App\Http\Controllers;

use App\Account;
use App\Document;
use App\Movement;
use App\User;
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

    public function documentStore(Request $request, $idMovement)
    {
        $movement = Movement::findOrFail($idMovement);
        $account = Account::findOrFail($movement->account_id);

        if ($account->owner_id == Auth::id()) {

            if ($request->has('document_file') || $request->has('document_description')) {
                $data = $request->validate([
                    'document_file' => 'required|mimes:png,jpeg,pdf',
                    'document_description' => 'nullable|string',
                ]);

                $document = Document::create([
                    'type' => $data['document_file']->getClientOriginalExtension(),
                    'original_name' => $data['document_file']->getClientOriginalName(),
                    'description' => $data['document_description'] ?? null,
                    'created_at' => Carbon::now(),
                ]);

                if (is_null($movement->document_id)) {
                    $data['document_file']->storeAs('documents/' . $movement->account_id, $movement->id . "." . $data['document_file']->getClientOriginalExtension());
                    $document->save();
                    $movement->document_id = $document->id;
                    $movement->save();
                } else {
                    $documentDeleted = Document::findOrFail($movement->document_id);
                    $movement->document_id = null;
                    $movement->update();
                    $documentDeleted->forceDelete();
                    Storage::disk('local')->delete('documents/' . $movement->account_id . "/" . $movement->id . "." . $documentDeleted->type);
                    $data['document_file']->storeAs('documents/' . $movement->account_id, $movement->id . "." . $data['document_file']->getClientOriginalExtension());
                    $document->save();
                    $movement->document_id = $document->id;
                    $movement->save();
                }
                return redirect()->route('movements.account', $movement->account_id);
            }
        } else {
            return Response::make(view('accounts.list'), 403);
        }
    }


    public function documentGet(Document $document)
    {
        $movement = Movement::where('document_id', $document->id)->first();
        $account = Account::findOrFail($movement->account_id);
        $user = User::findOrFail($account->owner_id);

        if (Auth::id() == $account->owner_id || $user->associate->pluck('id')->contains(Auth::id())) {
            if ($movement->document_id != null) {
                $path = 'documents/' . $account->id . '/' . $movement->id . '.' . $document->type;
                return Storage::download($path, $document->original_name);
            } else {
                return redirect()->route('movements.account', $movement->account_id);
            }
        } else {
            return Response::make(view('accounts.list'), 403);
        }
    }

    public function documentDelete($id)
    {
        $document = Document::findOrFail($id);
        $movement = $document->document;
        $accountId = $movement->account_id;
        $account = Account::findOrFail($accountId);

        if (Auth::id() == $account->owner_id) {
            $movement->document_id = null;
            $movement->update();
            $document->forceDelete();
            Storage::disk('local')->delete('documents/' . $accountId . "/" . $movement->id . "." . $document->type);
            return redirect()->route('movements.account', $movement->account_id);
        } else {
            return Response::make(view('accounts.list'), 403);
        }
    }

    public function documentView($idDocument)
    {
        $document = Document::findOrFail($idDocument);
        $account = Account::findOrFail($document->document->account_id);
        $movement = $document->document;
        $user = User::findOrFail($account->owner_id);

        if (Auth::id() == $account->owner_id || $user->associate->pluck('id')->contains(Auth::id())) {
            if ($movement->document_id != null) {
                $path = storage_path('app/documents/' . $account->id . '/' . $movement->id . '.' . $document->type);
                return response()->file($path);
            } else {
                return redirect()->route('movements.account', $movement->account_id);
            }
        } else {
            return Response::make(view('accounts.list'), 403);
        }
    }


}
