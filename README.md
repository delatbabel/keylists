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

## Example

I'll get to that. Quit bugging me, K? Just go write some code.

## Notes

(*) Happy, Dumpy, Sleepy, Gropey ... umm, hang on, was Gropey one of them?? ... Flopsy, Mopsy and Cottontail.
