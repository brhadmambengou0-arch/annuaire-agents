@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-4">Tableau de bord Admin</h1>
    <p>Bienvenue, {{ auth()->user()->name }} ! Ici tu peux gérer l'annuaire.</p>
</div>
@endsection