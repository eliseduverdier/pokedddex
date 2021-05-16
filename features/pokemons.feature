Feature:
    In order to prove that the Pokemons are correctly retreived from the API
    As a user
    I call the differents public routes to read the pokemons

    Scenario: SUCCESS
        When I send a request to "/pokemon/pikachu"
        Then the response should be received
        Then the response content type should be "application/json"
        Then validates the Schema for "Pokemon"

    Scenario: SUCCESS
        When I send a request to "/pokemons"
        Then the response should be received
        Then the response content type should be "application/json"
        Then validates the Schema for "Pokemons"

    Scenario: ERROR
        When I send a request to "/pokemon/blop"
        Then the response should be received
        Then the response content type should be "application/json"
        Then the response status code should be 404
