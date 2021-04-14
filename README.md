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
[] set controllers and api routes
[] validates input (POST, PUT)
[] validates input (GET, DELETE)
[] GET search (filter, pagination, validates search params)
[] set authentification (Token: Bearer ?)