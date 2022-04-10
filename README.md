# 🐛 Poke*ddd*ex

A simple Pokedex API, using

-   DDD & CQRS pattern
-   PHP 8.0
-   Symfony 6.0
-   Doctrine + Postgre
-   JWT Authentication
-   Behat + SQLite

### 🏗️ Install

```shell
git clone git@github.com:eliseduverdier/pokedddex.git && cd pokedddex
make start
make vendor
make db-pokemons
make jwt
```

-   And go to `http://127.0.0.1:80/pokemons`.

### 👾 Try it

[**Check documentation on postman**](https://documenter.getpostman.com/view/15405036/TzJuAHo5)

First, call the `login` route, then put the token in the `Auth` tab to freely use the protected routes.

Or see routes below:
| | cURL command |
|----------------------|--------------|
| Login | `POST /login_check -d '{"username": "user1@example.com", "password": "1234567890"}'` |
| List all pokemons | `GET /pokemons ? name=abc & type=Fire & sort[generation]=desc & sort[name]=asc & page=1` |
| List all types | `GET /types` |
| Get a pokemon | `GET /pokemon/{name}` |
| Create a new pokemon | `POST /pokemons -d '{"name": "Coucou", "type1": "Fire", "type2": "Ice", "total": 1, "hp": 1, "attack": 1, "defense": 1, "special_attack": 1, "special_defense": 1, "speed": 1, "generation": 1, "legendary": false}'` |
| Update a pokemon | `PUT /pokemon/{name} -d '{"name": "Coucou", "type1": "Fire", "type2": "Ice", "total": 1, "hp": 1, "attack": 1, "defense": 1, "special_attack": 1, "special_defense": 1, "speed": 1, "generation": 1, "legendary": false}'` |
| Delete a pokemon | `DELETE /pokemon/{name}` |

### Quality

#### Code style

-   Check code style : `make php-cs-fixer`
-   Analyse code :`make psalm`

#### Tests

-   Launch tests : `make behat`
