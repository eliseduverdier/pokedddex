Feature:
    As a authenticated user
    I call the different routes to create, edit or delete the pokemons

    Scenario:
        Given I am authenticated as "user1@example.com" with "1234567890" password
        When I do a POST request to "/pokemons" with data:
        # TODO clean database to delete element after each test // or generate new name each time
        """
        {
            "name": "Abcdefg",
            "type1": "Electric",
            "type2": "Ice",
            "total": 1,
            "hp": 1,
            "attack": 1,
            "defense": 1,
            "special_attack": 1,
            "special_defense": 1,
            "speed": 1,
            "generation": 1,
            "legendary": false
        }
        """
        Then the response status code should be 202
