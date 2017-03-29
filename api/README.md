# PHP OAuth2.0 API Testing

## Current State of Development

 - Working
   - Token requests
   - Token storage client-side without needing JavaScript or query strings
   - Basic endpoint functionality
   - Now fully on AWS for the database
   - Login functionality!
   - Endpoints
     - Announcements
     - Users (get only)
 - Not Working
   - Other endpoints (currently working users and courses)
   - Tokens refreshing when they are close to expiring, but still being used

## How to run

### Setting up the server locally:
In order to have the submodule loaded by git run:
`git submodule update --init --recursive`

Edit the server.php file:  It should contain a password variable near the top.  Modify them to match our MySQL setup. __Do not keep the password in the file when committing changes to the public repository! (Yes, I've made the mistake a couple of times too... Eventually it will be changed)__

### Starting the two servers:
Run the following from the root directory:
`php -S localhost:8080 -t api`
From a different command line run:
`php -S localost:8000 -t public`
Open a web browser of your choosing and navigate to:
`http://localhost:8000/api_index.php`

Here's an example of a correct response:
> Logged in: false  
> Admin privileges: false

The token should remain across page refreshes and tabs.

Also, using the token, the sample login endpoint should work, and it can be tested by navigating to:
`http://localhost:8000/api_login.php`

Here's an example of a correct response:
> Logged in successfully

Now that the token is marked as logged in, navigate back to the first page, the correct response should be:
> Logged in: true  
> Admin privileges: true

Navigating to `http://localhost:8000/api_logout.php` should result in:
> Logged out successfully

And the index page should look like how it started.

## Structure
Currently the test API is broken up into an API server and a web server, with both servers as a sub-directory of the root git.  That means that neither server would have the same files despite being the same repository.  Yes, I have tried to run both directories on the same server, but it runs into an issue due to a deadlock...  They must be run independently.

The client has no inherent dependencies due to the fact it is using the built in cURL library from PHP in order to communicate with the API server

The server requires this OAuth server library in order to run:
[https://github.com/bshaffer/oauth2-server-php]
It is included in the 'server' directory as a submodule through git.
