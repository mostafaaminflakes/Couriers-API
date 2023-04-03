## System Requirements

-   PHP 8.1
-   Required PHP extensions:

    > soap

-   Composer 2.5.\*
-   Laravel Framework 10

## Usage

```
git clone https://github.com/mostafaaminflakes/Couriers-API.git
cd Couriers-API
cp .env.example .env
composer install
php artisan key:generate
```

API and web service are in the same application for simplicity. They are not separated. To use it correctly, you should do the following:

-   First, run the web service: `php artisan serve --port=9000`
-   Second, run the web interface: `php artisan serve --port=8000`

### Postman

Make sure to add the params as:

```
courier_name -> any supported courier [smsa, dhl, aramex, shipbox, ups]
shipment_number -> any number
```

```
http://127.0.0.1:9000/courier_metadata
http://127.0.0.1:9000/create
http://127.0.0.1:9000/void
http://127.0.0.1:9000/status
http://127.0.0.1:9000/track
```

### Browser

```
http://127.0.0.1:8000
```

## Architecture

-   Repository pattern is used to separate the couriers logic. But a problem arises which is how to use the correct courier in the controller.
    I came up with a little tweak that adds a singleton wrapper class that acts as a gateway to register couriers and inject them into the service provider. Making them available everywhere in the application.

    i.e. Instead of injecting the interface in the controller construst, the gateway class is injected instead. Allowing the controller to freely load the correct courier upon user input.

    Affected files::

    ```
    [\app\Interfaces\CourierInterface.php]
    [\app\Providers\RepositoriesProvider.php]
    [\app\Repositories\CourierGateway.php]
    [\app\Repositories\AramexRepository.php]
    [\app\Repositories\DhlRepository.php]
    [\app\Repositories\ShipboxRepository.php]
    [\app\Repositories\SmsaRepository.php]
    [\app\Repositories\UpsRepository.php]
    [\app\Repositories\UpsRepository.php]
    [\config\app.php] -> providers array
    ```

-   Multiple generic courier operations have been implemented to work with any courier. Tested with Postman.

    Affected files::

    ```
    [\app\Controllers\ApiCourierController.php]
    [\routes\api.php]
    ```

-   Exposed the API as a web service using Laravel HTTP client, providing HTTP calls and retries.

    Affected files::

    ```
    [\app\Controllers\WebCourierController.php]
    [\routes\web.php]
    ```

-   Implemented the real SMSA courier as a proof of concept.

    Affected files:

    ```
    [\app\Repositories\SmsaRepository.php]
    ```

    I used [alhoqbani smsa-webservice](https://github.com/alhoqbani/smsa-webservice) package to implement SMSA functionalities.

## Issues

-   During the SMSA testing, it was required to add a `Passkey` to authenticate. I couldn't get that `Passkey`. But the return values from SMSA were descriptive, meaning I'm a kind of on the right track.

`Creating this project was so much fun!`
