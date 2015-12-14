# keylists

Yeah yeah, you know the drill. Your application needs to have all of these key/value tables.
A list of states of the USA. A list of currencies. A table for timezones. A table for staff
rotation types. A table for the names of the seven dwarfs (NAME THEM! NOW! QUICK!) (*).  A key/value
list for each of the 101 dropdowns that you have on the far-too-many forms on your site.

Keylists is a set of database tables and model classes to handle key/value lists in an application
in a standard way

So you can now store all of these key/value lists into a single set of tables and cache the whole
lot and never have to panic about where to store these things ever again.

## Installation

Add these lines to your composer.json file:

```
    "require": {
        "delatbabel/keylists": "~1.0"
    },
```

Once that is done, run the composer update command:

```
    composer update
```

### Register Service Provider

After composer update completes, add this line to your config/app.php file in the 'providers' array:

```
    Delatbabel\Keylists\KeylistsServiceProvider::class,
```

### Incorporate and Run the Migrations

Finally, incorporate and run the migration scripts to create the database tables as follows:

```php
php artisan vendor:publish --tag=migrations --force
php artisan migrate
```

## Sample Data

To load some of the sample data, try adding this line to the $commands array in your app/Console/Kernel.php
file:

```
    Delatbabel\Keylists\Console\Commands\LoadISO3166Countries
```

Then run this command:

```
    php artisan keylists:loadiso3166countries
```

This should create entries in the keylists / keyvalues table for the ISO 3166 country codes and names.

## Example

I'll get to that. Quit bugging me, K? Just go read the code.

## Notes

(*) Happy, Dumpy, Sleepy, Gropey ... umm, hang on, was Gropey one of them?? ... Flopsy, Mopsy and Cottontail.
