FormMagic
============

Form generation and validation all in one [Laravel 4](http://laravel.com/) package.

When we create a form for a web page, we generally define the fields in one place and the validation rules
in another.

That's dumb.

Each field in our form has a name, possibly a value, and perhaps some validation rules.  That sure sounds like a
simple array to me.  With FormMagic, you inherit the FormMagic base class, define your fields, and ... nothing else.
You're ready to render() or validate().

That easy.

Installation
============

Add `jtgrimes\form-magic` as a requirement to composer.json:

```javascript
{
    "require": {
        "jtgrimes/form-magic": "dev-master"
    }
}
```

Update your packages with `composer update` or install with `composer install`.

FormMagic doesn't have a service provider to register, so your installation is done with that one step.

Configuration
=============

In order to work with the configuration file, you're best off publishing a copy
with Artisan:

```
$ php artisan config:publish jtgrimes/form-magic
```

The defaults are:
//TODO
All of these defaults can be changed in `/app/config/packages/jtgrimes/form-magic.php`.

Usage
=====

//TODO

Credits
=======

The generation code is largely lifted from Jeffrey Way's [FormField](https://github.com/JeffreyWay/FormField) package.
The validation code is inspired by one of his [Laracasts](https://laracasts.com/lessons/form-validation-simplified).
Basically, this project only exists because I combined two of Mr. Way's projects.

FormMagic is designed to work with [Laravel](http://laravel.com/), though I suppose it can be used as a stand-alone project.

The readme is largely boosted from Rob Crowe's readme for (the very awesome) [TwigBridge](https://github.com/rcrowe/TwigBridge).

