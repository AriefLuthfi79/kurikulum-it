1. Rancanglah sistem yang berisi beberapa _class_ yang menangani kasus pendaftaran santri baru
2. Rancangan harus mempunyai constructor method dan static method

## Clue

```php

class Register
{
    private $student = [
      [
        'name' => "Arief",
        'nik'  => "TOO1"
      ]
    ];
    
    public static function insertStudent(array $santri): void
    {
        // your code goes here
    }
}

Register::insertStudent(['name' => $name, 'nik' => $nik])
```
