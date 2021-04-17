# pokedex-artsper

## Install
```
alias sf='php bin/console --env=dev' \
&& composer install \
&& sf doctrine:database:create \
&& sf doctrine:schema:update --force \
&& sf pokedex:load:pokemons \
&& sf pokedex:load:users
```
* Recreate DB `sf c:c && sf doc:da:drop --force && sf doc:da:create && sf doc:sc:up --force && sf pok:l:p && sf pok:l:u`


## TODO
[x] install sf and librairies
[x] add controllers 
[x] DB and fixtures
[x] doctrine mapping and import command
[x] set controllers and api routes
[x] validates input (POST, PUT, DELETE, GET)
   [x] POST --> DB
   [x] PUT --> DB
   [x] DELETE --> DB
   [ ] validates content-type === json && json_last_error() !== JSON_ERROR_NONE
[x] GET one
[ ] GET all
    [x] validates search params
    [x] filter recherche nom ou type
        (?name=)
        (/pokemons?type=ice|...)
    [x] sort name (?sort=asc|desc)
    [x] pagination (?page)
    [ ] ? use Search service
[x] creates users (email/password)
[x] set authentification (Token: Bearer)
[ ] CQRS

## Available routes
See https://www.getpostman.com/collections/12e1b427a49cce57fc1f

```
POST /login_check -d { "username": "user3@artsper.com", "password": "1234567890" }
```
Send authentication data: `{ "username": "user1@artsper.com", "password": "1234567890" }` (user1, user2, or user3)


```
GET /pokemons
    ?name=abc
    ?type=fire
    ?sort[name]=asc & sort[blob]=ytuj
    ?page=1

GET /pokemon/{name}
POST /pokemons
PUT /pokemon/{name}
DELETE /pokemon/{name}
```