<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgentRequest extends FormRequest
{
    /**
     * Qui peut faire cette requête ?
     * true = tout le monde (on gère les droits ailleurs)
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Les règles de validation
     */
    public function rules(): array
    {
        return [
            'matricule'                 => 'required|string|max:20|unique:agents,matricule',
            'nom'                       => 'required|string|max:100',
            'prenom'                    => 'required|string|max:100',
            'email'                     => 'required|email|unique:agents,email',
            'password'                  => 'nullable|string|min:8',
            'telephone_professionnel'   => 'nullable|string|max:25',
            'telephone_prive'           => 'nullable|string|max:10',
            'entity_id'                 => 'required|exists:entities,id',
            'fonction_id'               => 'required|exists:fonctions,id',
            'bureau'                    => 'nullable|string|max:50',
            'date_prise_fonction'       => 'nullable|date',
        ];
    }

    /**
     * Messages d'erreur en français
     */
    public function messages(): array
    {
        return [
            'matricule.required'   => 'Le matricule est obligatoire.',
            'matricule.unique'     => 'Ce matricule existe déjà.',
            'matricule.max'        => 'Le matricule ne peut pas dépasser 20 caractères.',
            'nom.required'         => 'Le nom est obligatoire.',
            'prenom.required'      => 'Le prénom est obligatoire.',
            'email.required'       => 'L\'email est obligatoire pour envoyer les identifiants de connexion.',
            'email.email'          => 'L\'adresse email n\'est pas valide.',
            'email.unique'         => 'Cet email est déjà utilisé.',
            'entity_id.required'   => 'L\'entité est obligatoire.',
            'entity_id.exists'     => 'L\'entité sélectionnée n\'existe pas.',
            'fonction_id.required' => 'La fonction est obligatoire.',
            'fonction_id.exists'   => 'La fonction sélectionnée n\'existe pas.',
        ];
    }
}