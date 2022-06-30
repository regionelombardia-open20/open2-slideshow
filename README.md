Amos Slideshow
------------
Plugin per rappresentare mediante modali delle informazioni sulla base della rotta e del ruolo dell'utente

### Installation
The only things you need is to require thhis package and enable the module in your config

***bash***
```bash
composer require "open20/amos-slideshow:^1.4"
```

***[PLATFORM]/backend/config/main.php***
```php
return [
  ...
  'modules' => array_merge(require(__DIR__ . '/modules.php'), [
    ...
    'slideshow' => [
      'class' => 'open20\amos\slideshow\AmosSlideshow'
    ]
    ...
```

***[PLATFORM]/console/config/main.php***
```php
return [
    ...
    'controllerMap' => [
        'migrate' => [
            ...
            'migrationLookup' => array_merge(require(__DIR__ . '/migrations.php'), [                       
                ...
                '@vendor/open20/amos-slideshow/src/migrations',
                ...
            ])
        ]
        ...
    ],
]
```

***[PLATFORM]/backend/config/params-local.php***
```php
return [
    ...
    'slideshow' => true
]
```