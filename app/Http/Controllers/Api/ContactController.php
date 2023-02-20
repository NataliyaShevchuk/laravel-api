<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ContactController extends Controller
{
    public function store(Request $request){

        $secureData = $request->validate([
            'title' => 'required|string|max:255',
            'email' =>'required|string',
            'message' => 'required|string',
            'file' => 'nullable|file|max:5000'
        ]);
        
        if( $request->has('file')){
            $secureData['file'] = Storage::put('/contacts', $secureData['file']);
        }

        $newContact = Contact::create($secureData);

        return response()->json($newContact);
    }
}
