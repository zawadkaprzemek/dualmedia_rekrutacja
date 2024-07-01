## Instrukcja instalacji

#### Pobierz repozytorium
```shell
git clone git@github.com:zawadkaprzemek/dualmedia_rekrutacja.git .
```
#### Instalacja pakietów
```shell
composer install
```

#### Uruchom serwer lokalny
```shell
symfony serve -d
```

### Dostęp do bazy danych
W pliku .env w linii DATABASE_URL="mysql://user:pass@127.0.0.1:3306/dualmedia_pz?serverVersion=5.7&charset=utf8mb4"
zamień user i pass na dostępy do serwera mysql na swoim środowisku lokalnym

#### Stworzenie bazy danych
```shell
bin/console doctrine:schema:create
```

#### Odpalenie migracji bazodanowych
```shell
bin/console doctrine:migrations:migrate
```

#### Załadowanie listy produktów
```shell
bin/console doctrine:fixtures:load --no-interaction
```

## Końcówki API:

1. Lista produktów: /product/list - metoda GET - produktów jest 10
2. Składanie zamówienia: /order/create - metoda POST - body tablica par product_id i quantity
```json
{
    "items": [
        {
            "product_id" : 5,
            "quantity" : 1
        },
        {
            "product_id" : 7,
            "quantity" : 5
        },
        {
            "product_id": 10,
            "quantity": 3
        }
    ]
}
```
3. Szczegóły zamówienia: /order/$idZamówienia - metoda GET