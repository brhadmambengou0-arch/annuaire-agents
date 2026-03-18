<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Récupère l'id de l'agent depuis l'URL
        $agentId = $this->route('id');

        return [
            'nom'                 => 'sometimes|string|max:100',
            'prenom'              => 'sometimes|string|max:100',
            // unique mais ignore l'agent actuel
            'email'               => 'nullable|email|unique:agents,email,' . $agentId,
            'telephone'           => 'nullable|string|max:25',
            'telephone_interne'   => 'nullable|string|max:10',
            'entity_id'           => 'sometimes|exists:entities,id',
            'fonction_id'         => 'sometimes|exists:fonctions,id',
            'bureau'              => 'nullable|string|max:50',
            'date_prise_fonction' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.max'            => 'Le nom ne peut pas dépasser 100 caractères.',
            'prenom.max'         => 'Le prénom ne peut pas dépasser 100 caractères.',
            'email.email'        => 'L\'adresse email n\'est pas valide.',
            'email.unique'       => 'Cet email est déjà utilisé.',
            'entity_id.exists'   => 'L\'entité sélectionnée n\'existe pas.',
            'fonction_id.exists' => 'La fonction sélectionnée n\'existe pas.',
        ];
    }
}