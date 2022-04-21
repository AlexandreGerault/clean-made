<?php

use function Pest\Laravel\get;

it('shows the login page', function () {
    get(route('security.login'))->assertSuccessful()->assertSee("Me connecter");
});
