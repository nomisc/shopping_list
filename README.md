## Shopping list 

Apikacija služi skupnemu beleženju enega nakupovalnega seznama. 
Več uporabnikov hkrati lahko dodajajo, urejajo in brišejo elemente na seznamu. 


### Namestitev 

```
git clone git@github.com:nomisc/shopping_list.git

composer install
 
npm install vite --save-dev

npm build

cp .env.example .env

php artisan key:generate
php artisan migrate
php artisan serve --port=xxxx
```

### Dodatne nastavitve

#### BAZA 
V .env datoteki se lahko spremeni bazo. Privzeto se uporablja sqlite bazo, privzeto ime je database.sqlite.
```
DB_CONNECTION=sqlite
DB_DATABASE=db
```

#### Export
Pri ključu EXPORT_LOCATION se definira lokaciji, kjer se bodo shranjevali izvozi seznamov. Privzeta lokacija je
```
EXPORT_LOCATION=shopping_list/
```

### DEMO uporabnik
Z ukazom `` php artisan db:seed `` se generirate dva testna uporabnika. 
1. uporabnik:
    uporabniško ime: miha.test@gmail-test.com
    geslo: aaabbbccc
2. uporabnik:
   uporabniško ime: mojca.test@gmail-test.com
   geslo: aaabbbccc

### Delo v terminalu 
Aplikacija omogoča uvoz in izvoz podatkov v terminalu. 

#### Izvoz: 
```
php artisan shopping-list:export
```
Datoteka se izvozi na privzeto mesto. Download je možen preko web vmesnika. 

#### UVOZ
```
php artisan shopping-list:import "file_location"
```

primer: 
```
php artisan shopping-list:import path_to_project/storage/app/export/20240310_223346_shopping_list.json
```
