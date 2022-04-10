Feature:
    As a authenticated user
    I call the different routes to create, edit or delete the pokemons

    Scenario: ERROR - Unauthorized
        Given I am not authenticated
        When I do a DELETE request to "/pokemon/Pikachu"
        Then the response status code should be 401

    Scenario: ERROR
        Given I am authenticated as "user1@example.com" with "1234567890" password
        When I do a DELETE request to "/pokemon/unknown"
        Then the response status code should be 404

    Scenario: SUCCESS
        Given I am authenticated as "user1@example.com" with "1234567890" password
        When I do a DELETE request to "/pokemon/Pikachu"
        Then the response status code should be 204
