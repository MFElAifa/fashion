Feature: Management Looks
    Scenario: Call a not found route
        Given the "Content-Type" request header is "application/json"
        Given the "Accept" request header is "application/ld+json"
        When I request "/api/v1/not-found-route" using HTTP "GET"
        Then the response code is 404

    Scenario: Get list of Looks
        Given the "Content-Type" request header is "application/json"
        Given the "Accept" request header is "application/ld+json"
        When I request "/api/looks" using HTTP "GET"
        Then the response code is 200

    Scenario: Search a looks by Tag "black"
        Given the "Content-Type" request header is "application/json"
        Given the "Accept" request header is "application/ld+json"
        Given the following query parameters are set:
            | key | value |
            | tags | black |
        When I request "/api/looks" using HTTP "GET"
        Then the response code is 200
        And the response body is JSON
        And the response body matches:
        """
            /"tags":"black;hoodie;bag"/i
        """

    Scenario: Search a looks by Tag "noisette" and we should empty result
        Given the "Content-Type" request header is "application/json"
        Given the "Accept" request header is "application/ld+json"
        Given the following query parameters are set:
            | key | value |
            | tags | noisette |
        When I request "/api/looks" using HTTP "GET"
        Then the response code is 200
        And the response body is JSON
        And the response body matches:
        """
            /"hydra:member":\[\]/i
        """

    Scenario: Send a post post request to Api Looks
        Given the "Content-Type" request header is "application/json"
        Given the "Accept" request header is "application/ld+json"
        When I request "/api/looks" using HTTP "POST"
        Then the response code is 405

    Scenario: Success Authenticate by username and password
        Given the "Content-Type" request header is "application/json"
        Given the "Accept" request header is "application/ld+json"
        Given the request body is:
        """
        {
            "username": "will_smith",
            "password": "tagwalk123#"
        }
        """
        When I request "/api/login_check" using HTTP "POST"
        Then the response code is 200
        And the response body is JSON
    
    Scenario: Failed Authenticate by username and password (ROLE NOT EMPLOYE)
        Given the "Content-Type" request header is "application/json"
        Given the "Accept" request header is "application/ld+json"
        Given the request body is:
        """
        {
            "username": "jenny_rowling",
            "password": "tagwalk123#"
        }
        """
        When I request "/api/login_check" using HTTP "POST"
        Then the response code is 401
        And the response body contains JSON:
        """
        {
            "code":401,"message":"Invalid credentials."
        }
        """
    
    Scenario: Get User By id "1"
        Given the "Content-Type" request header is "application/json"
        Given the "Accept" request header is "application/ld+json"
        When I request "/api/users/1" using HTTP "GET"
        Then the response code is 200
        And the response body is JSON
        And the response body matches:
        """
            /"username":"antoine_gury"/i
        """