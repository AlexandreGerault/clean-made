<form action="{{ route('security.authenticate') }}" method="post">
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

    @dump($errors)
    <button type="submit">Me connecter</button>
</form>
