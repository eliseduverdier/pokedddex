# pokedex

A simple Pokedex API, using
* PHP 8.0.3
* Doctrine + MySql
* DDD and CQRS pattern
* JWT Authentication
* Behat and JSON schema validation

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
    && sf pokedex:load:users \
    && sf lexik:jwt:generate-keypair \
    && APP_ENV=dev symfony server:start
```
 * And go to `http://127.0.0.1:8000/pokemons`.

<!-- * To force reload, use:
```shell
sf c:c && sf doc:da:drop --force && sf doc:da:create && sf doc:sc:up --force && sf pok:l:p && sf pok:l:u
```
-->

### Try it

<!--[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/12e1b427a49cce57fc1f)-->
[▶️ Check documentation on postman](https://documenter.getpostman.com/view/15405036/TzJuAHo5)

First, call the `login` route, then put the token in the `Auth` tab to freely use the protected routes.

Or see routes below:
|                      | cURL command |
|----------------------|--------------|
| Login                | `POST /login_check -d '{"username": "user3@example.com", "password": "1234567890"}'` |
| List all pokemons    | `GET /pokemons ? name=abc & type=Fire & sort[generation]=desc & sort[name]=asc & page=1` |
| List all types       | `GET /types` |
| Get a pokemon        | `GET /pokemon/{name}` |
| Create a new pokemon | `POST /pokemons -d '{"name": "Coucou", "type1": "Fire", "type2": "Ice", "total": 1, "hp": 1, "attack": 1, "defense": 1, "special_attack": 1, "special_defense": 1, "speed": 1, "generation": 1, "legendary": false}'` |
| Update a pokemon     | `PUT /pokemon/{name} -d '{"name": "Coucou", "type1": "Fire", "type2": "Ice", "total": 1, "hp": 1, "attack": 1, "defense": 1, "special_attack": 1, "special_defense": 1, "speed": 1, "generation": 1, "legendary": false}'` |
| Delete a pokemon     | `DELETE /pokemon/{name}` |


### Quality
#### Code style
* Check code style : `vendor/bin/phpcs src/`
* Analyse code :
  * `vendor/bin/phpstan analyse -c phpstan.neon`  (level 5)
  * `vendor/bin/psalm`

#### Tests
* Launch tests : `vendor/bin/behat`

### TODO
- [ ] Functional tests
  - [x] GET
  - [ ] Fixtures and separate database
  - [ ] POST
  - [ ] PUT
  - [ ] DELETE
- [ ] Add docker
- [x] Remove JMS serializer to use symfony's
- [ ] Request parameterss validation service