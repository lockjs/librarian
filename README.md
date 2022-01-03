Librarian
===

Librarian publishes new book recommendations via email. 

Setup
---
`docker build -t librarian .`

Run
---
```
docker run --rm -it -v `pwd`:/opt/"${PWD##*/}" -w /opt/"${PWD##*/}" librarian {comand}
```
Creates a temporary container from the `librarian` image in order to execute scripts in the current directory

```
// Install project dependancies
composer install

// Setup database
phinx migrate -c database/phinx.json
phinx seed:run  -c database/phinx.json

// Start the web server
// - Remember to map the ports with the `docker run` command
php -S 0.0.0.0:8080 -t web/public_html/
```