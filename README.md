# pokedex-artsper

A simple Pokedex API, using
* PHP 8.0.3
* Doctrine + MySql
* DDD and CQRS pattern
* JWT Authentication

## How to use
### Install
* `git clone git@github.com:EliseDuverdier/pokedex.git && cd pokedex`
* `cp .env{,local}`
* In .env.local, customize your `DATABASE_URL` on line 22
* Enter the following commands :
```shell
alias sf='php bin/console --env=dev' \
    && composer install \
    && sf doctrine:database:create \
    && sf doctrine:schema:update --force \
    && sf pokedex:load:pokemons \
    && sf pokedex:load:users
    && sf lexik:jwt:generate-keypair
    && symfony server:start
```
 * And go to `http://127.0.0.1:8000`.

<!-- * To force reload, use:
```shell
sf c:c && sf doc:da:drop --force && sf doc:da:create && sf doc:sc:up --force && sf pok:l:p && sf pok:l:u
```
-->


<!--
### Check quality
* Check code style : `vendor/bin/phpcs src/`
* Launch tests : _(Would have use behat, but did not had enough time, sorry)_
-->

### Use

First, call the `login` route, then put the token in the `Auth` tab to freely use the protected routes.

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/12e1b427a49cce57fc1f)

Or see routes below:
|                      | cURL command |
|----------------------|--------------|
| Login                | `POST /login_check -d '{"username": "user3@artsper.com", "password": "1234567890"}'` |
| List all pokemons    | `GET /pokemons ? name=abc & type=Fire & sort[generation]=desc & sort[name]=asc & page=1` |
| List all types       | `GET /types` |
| Get a pokemon        | `GET /pokemon/{name}` |
| Create a new pokemon | `POST /pokemons -d '{"name": "Coucou", "type1": "Fire", "type2": "Ice", "total": 1, "hp": 1, "attack": 1, "defense": 1, "special_attack": 1, "special_defense": 1, "speed": 1, "generation": 1, "legendary": false}'` |
| Update a pokemon     | `PUT /pokemon/{name} -d '{"name": "Coucou", "type1": "Fire", "type2": "Ice", "total": 1, "hp": 1, "attack": 1, "defense": 1, "special_attack": 1, "special_defense": 1, "speed": 1, "generation": 1, "legendary": false}'` |
| Delete a pokemon     | `DELETE /pokemon/{name}` |

## TODO
- [x] install sf and librairies
- [x] add controllers 
- [x] DB and fixtures
- [x] doctrine mapping and import command
- [x] Set controllers and api routes
- [x] implement routes with data validation
  - [x] GET one
  - [x] GET all
    - [x] validates search params
    - [x] filter recherche nom ou type
    - [x] sort name (?sort=asc|desc)
    - [x] pagination (?page)
  - [x] POST
  - [x] PUT
  - [x] DELETE
  - [ ] validates content-type === json && json_last_error() !== JSON_ERROR_NONE
- [x] Create users class (email/password)
  - [x] Fixture command
- [x] Set authentification (Token: Bearer)
- [ ] CQRS
- [x] phpcs
- [ ] phpstan
- [ ] Behat tests ?
