Feature:
    As a anonymous user
    I call the different public routes to read the pokemons

    Scenario: SUCCESS
        When I go to "/pokemons"
        Then the response should be received
        Then the response content type should be "application/json"
        Then validates the Schema for "Pokemons"

    Scenario: SUCCESS
        When I go to "/pokemon/Pikachu"
        Then the response should be received
        Then the response content type should be "application/json"
        Then validates the Schema for "Pokemon"

    Scenario: ERROR
        When I go to "/pokemon/blop"
        Then the response should be received
        Then the response content type should be "application/json"
        Then the response status code should be 404
