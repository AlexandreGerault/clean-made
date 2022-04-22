<form action="{{ route('security.register.post') }}" method="post">
    @csrf
    <label>
        Adresse mail
        <input type="email" name="email" />
    </label>
    @foreach($errors->get('email') as $error)
        <p>{{ $error }}</p>
    @endforeach

    <label>
        Mot de passe
        <input type="password" name="password" />
    </label>
    @foreach($errors->get('password') as $error)
        <p>{{ $error }}</p>
    @endforeach

    <label>
        Confirmer le mot de passe
        <input type="password" name="password_confirmation" />
    </label>

    <button type="submit">M'inscrire</button>
</form>
