Let's say, in our system we have two models "client" and "shipping address". Let's assume that we already have some existing (registered) clients in our storage. Let's do this simple and assume that our clients have only three properties ID, firstname and lastname.

Client can have several different shipping addresses, but max number is 3. One of them is a default address, so when client adds the first address, it becomes default. Client can change a default address any time.

Client can add a new address, modify an existing address or remove an existing address. Client can not remove a default address, thus there should be at least one address (default) if it was added earlier.

Shipping address includes country, city, zipcode, street.

Implement a console application to be able to add, update, delete and get shipping addresses for a specific client. Also to get a client information by ID.

Requirements: 
- 	Use PHP 7.*
- 	Use DDD ([Domain-Driven Design](https://www.amazon.com/exec/obidos/ASIN/0321125215/domainlanguag-20 "Domain-Driven Design"), [Domain-Driven Design in PHP](https://leanpub.com/ddd-in-php "Domain-Driven Design in PHP"))
- 	Use any storage you want for storing data, e.g. JSON files. ACID is not important here.
- 	Cover an application service layer by unit tests. There is no need to cover all methods, just a couple to show the principle.
- 	If you need you can use any PHP framework or just plain PHP.

Fork your own copy of eglobal-it/f4u-test-assignment and share the result with us.


# Submission: Lumen framework setup steps
It is cosnole app for managing client's addresses.

Framework - Lumen (https://lumen.laravel.com/docs/6.2)
1) Setup local dev environment taking reference of above link (PHP >= 7.1.3)
2) Copy .env.example to .env file & use your configuration (Create database & provide required details)
3) Execute "composer update" in terminal to download project specific dependencies (vendor folder, Reach to you poject folder for executing this cmd)
4) Execute "php artisan migrate:fresh" in terminal to setup tables (Reach to you poject folder for executing this cmd)
5) Execute "php artisan db:seed" in terminal to populate dependant data (like offers, recipients)
6) Created console app with below list of commands to perform given tasks:
- php artisan <method_type>:<action_to_be_performed>
- php artisan get:clients
- php artisan get:client_by_id
- php artisan get:get_client_address_by_client_id
- php artisan add:client_address
- php artisan update:client_address
- php artisan update:set_default_client_address
- php artisan delete:client_address

- Appendix:

- get
  - get:clients                          Get all clients
  - get:client_by_id                     Get client by id
  - get:get_client_address_by_client_id  Get client address by client id

- add
  - add:client_address                   Add client address

- update
  - update:client_address                Update client address
  - update:set_default_client_address    Set default client address

- delete
  - delete:client_address                Delete client address

7) Created few test cases to be verified against created web end points. You can execute them .vendor/bin/phpunit cmd.
8) Technical implementation details:
- Created Domains consists of
  - Models
  - Interfaces
  - Repositories
- Created Controllers (Injected Repositories for communication with DB - Decoupled database layer from Controller)
- Created Console Commands for preparing console applications