# PHP OAuth2.0 API Testing

## Current State of Development

 - Working
   - Token requests
 - Not Working
   - Login functionality (Will work on that tomorrow 3/14/17)
   - Other endpoints (Will work on that after login works...)

## How to run

### Setting up the server locally:
Make sure sql is installed properly and locally and run the OAuth.sql file from the server directory.  If unsure on how to execute, the command that worked for me in PowerShell was:
`mysql -u root -p -e ' source .\OAuth.sql'`
Obviously change the username to match your respective setup.  Also, don't attempt to run this on the AWS server.  It won't break anything, but it won't work either.  It doesn't recognize the type TIMESLOT...  Need to look into that later.

Edit the API.php file inside that same folder.  It should contain a username and password variable near the top.  Modify them to match your MySQL setup. __Do not keep these settings in the file when committing changes to the public repository!__

### Starting the two servers:
Run the following from the api/ folder:
`php -S localhost:8080 -t server`
From a different command line run:
`php -S localost:8000 -t web `
Open a web browser of your choosing and navigate to:
`http://localhost:8000`
JSON should appear showing a newly generated access code of type Bearer.

Here's an example of a correct response:
> {"access_token":"db74c136ad8e446c8d2c48904716e60eb358ba4a","expires_in":3600,"token_type":"Bearer","scope":null}


## Structure
Currently the test API is broken up into an API server and a web server, each in their own directories.  Yes, I have tried to run both directories on the same server, but it runs into an issue due to a deadlock...

The client has no inherent dependencies due to the fact it is using the built in cURL library from PHP in order to communicate with the API server

The server requires this OAuth server library in order to run:
[https://github.com/bshaffer/oauth2-server-php]
It is included in the 'server' directory as a submodule through git.
