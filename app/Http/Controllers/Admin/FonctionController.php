<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use App\Models\Fonction;

class FonctionController extends Controller
{
    public function index()
    {
        // Logique pour lister les fonctions
        // Ex. : return response()->json(Fonction::all());
    }

    public function show($id)
    {
        // Logique pour afficher une fonction spécifique
        // Ex. : return response()->json(Fonction::findOrFail($id));
    }

    public function store(Request $request)
    {
        // Logique pour créer une nouvelle fonction
        // Ex. : $fonction = Fonction::create($request->validated());
        // return response()->json($fonction, 201);
    }

    public function update(Request $request, $id)
    {
        // Logique pour mettre à jour une fonction
        // Ex. : $fonction = Fonction::findOrFail($id);
        // $fonction->update($request->validated());
        // return response()->json($fonction);
    }

    public function destroy($id)
    {
        // Logique pour supprimer une fonction
        // Ex. : Fonction::findOrFail($id)->delete();
        // return response()->json(['message' => 'Deleted']);
    }
}