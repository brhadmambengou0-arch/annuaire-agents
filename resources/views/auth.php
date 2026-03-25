@section('content')
<div class="container">
    <h2>Connexion</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
        <a href="{{ route('register') }}">Pas encore inscrit ?</a>
    </form>
</div>
@endsection
