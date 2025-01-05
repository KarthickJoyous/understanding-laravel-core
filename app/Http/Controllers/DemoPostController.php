<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoPostController extends Controller
{
    public function post(Request $request)
    {
        /*
            Dependency Injection (DI) in Laravel:

            - DI is automatically handled by Laravel's service container in certain contexts:
                1. Constructor Injection
                2. Route/Controller Method Calls
                3. When explicitly using `app()`, `resolve()`, or similar helpers.
            - DI will NOT happen automatically for internal method calls within the same class.

            Examples of where DI won't happen:
                $this->publish(); // No DI, as `publish()` is called directly.
                $this->publish(new Publish); // Still incomplete, as `Publish` has dependencies.
                $this->publish(new Publish(new EmailService)); // Still incomplete, as `EmailService` has dependencies.

            Solutions:
                1. Manually resolve all dependencies.
                2. Use Laravel's service container helpers to resolve dependencies.
        */

        // Manually set-up all dependencies 

        //return $this->publish(new Publish(new EmailService(rand() . '@app.com')));

        // Involving servicer container & asking it to resolve.
        // All of the below solutions will do the same execution. Own Preference.

        //return app()->call([$this, 'publish']);
        //return $this->publish(app(Publish::class));
        //return $this->publish(app()->make(Publish::class));
        return $this->publish(resolve(Publish::class));
    }

    public function publish(Publish $publish)
    {
        return $publish->publish();
    }
}

class EmailService
{
    public function __construct(private $email) {}
    public function send()
    {
        info("Sending Email to {$this->email}");
    }
}

class Publish
{
    public function __construct(private EmailService $emailService) {}
    public function publish()
    {
        $this->emailService->send();

        return 'Published';
    }
}
