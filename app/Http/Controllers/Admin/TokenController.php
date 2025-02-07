<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GasRequest;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function showToken(GasRequest $gasRequest)
    {
        $token = $gasRequest->token;
        $user = Auth::user();
        if (!$token) {
            return redirect()->route('admin.gas-requests')->with('error', 'No token found for this request.');
        }

        $pendingGasRequests = GasRequest::where('outlet_id', $user->outlet_id)
            ->where('status', 'pending')
            ->with('user') // Load user details
            ->get();

        return view('backend.admin.gas-requests.show-token', compact('token', 'gasRequest', 'pendingGasRequests'));
    }

    public function markUsed(Token $token)
    {
        if ($token->status == 'used') {
            return redirect()->route('admin.tokens.show', $token->gas_request_id)
                ->with('error', 'Token is already marked as used.');
        }

        $token->status = 'used';
        $token->save();


        return redirect()->route('admin.tokens.show', $token->gas_request_id)
            ->with('message', 'Token marked as used.');
    }


    public function reallocate(Request $request, Token $token)
    {
        $request->validate([
            'new_gas_request_id' => 'required|exists:users,id',
        ]);


        $newGasRequest = GasRequest::where('id', $request->new_gas_request_id)
            ->where('outlet_id', Auth::user()->outlet_id)
            ->where('status', 'pending')
            ->first();


        if (!$newGasRequest) {
            return redirect()->back()->with('error', 'No valid pending gas request found.');
        }

        $token->user_id = $newGasRequest->user_id;
        $token->gas_request_id = $newGasRequest->id;
        $token->status = 'active';
        $token->save();

        $newGasRequest->status = 'accepted';
        $newGasRequest->save();

        return redirect()->route('admin.gas-requests')
            ->with('message', 'Token reallocated successfully!');
    }
}
