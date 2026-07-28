<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(StoreContactRequest $request): JsonResponse
    {
        $contact = Contact::create($request->validated());

        return response()->json($contact, 201);
    }

    public function getContact(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);

        return response()->json($contact);
    }

    public function invalidate(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['valid_unitil' => today()->toDateString()]);

        return response()->json($contact);
    }

    public function updateContact(Request $request)
    {
        $id = Request()->id;
        $contact = Contact::find($id);
        if (! $contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        // Update only specific fields
        $contact->update($request->only(['name', 'email', 'phone']));

        return response()->json($contact);
    }

    public function searchContacts(Request $request)
    {
        $query = Contact::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%'.$request->input('name').'%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%'.$request->input('email').'%');
        }

        if ($request->has('phone')) {
            $query->where('phone', 'like', '%'.$request->input('phone').'%');
        }

        $contacts = $query->get();

        return response()->json($contacts);
    }

    public function getAllContacts()
    {
        $contacts = Contact::all();

        return response()->json($contacts);
    }
}
