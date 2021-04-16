# pokedex-artsper

## Install
```
alias sf='php bin/console --env=dev' \
&& composer install \
&& sf doctrine:database:create \
&& sf doctrine:schema:update --force \
&& sf pokedex:load-fixtures
```

* Recreate DB `sf c:c && sf doc:da:drop --force && sf doc:da:create && sf doc:sc:up --force && sf pok:load`


## TODO
[x] install sf and librairies
[x] add controllers 
[x] DB and fixtures
[x] doctrine mapping and import command
[x] set controllers and api routes
[x] validates input (POST, PUT, DELETE, GET)
   [x] POST --> DB
   [x] PUT --> DB
   [ ] DELETE --> DB
[x] GET one
[ ] GET all
    [x] validates search params
    [x] filter recherche nom ou type
        (?name=)
        (/pokemons?type=ice|...)
    [x] sort name (?sort=asc|desc)
    [x] pagination (?page)
    [] ? use Search service
[] set authentification (Token: Bearer ?)
[] CQRS



/pokemons
    ?name=123
    ?type=fire
    ?sort[name]=asc & sort[blob]=ytuj
    ?page=1