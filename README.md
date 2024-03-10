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
