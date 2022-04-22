<form action="{{ route('security.login.post') }}" method="post">
    @csrf
    <label>
        Adresse mail
        <input type="email" name="email"/>
    </label>
    @foreach($errors->get('email') as $error)
        <p>{{$error}}</p>
    @endforeach

    <label>
        Mot de passe
        <input type="password" name="password"/>
    </label>

    <button type="submit">Me connecter</button>
</form>
