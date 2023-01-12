# Project-DAM
Project 2 Team A

## Team tasks: 
	- Paul : Backend
	- Bernardo: Backend
	- Ege: Frontend
	- Caterina: Frontend
	- Zsombor: Fullstack
	- Rares: Backend
	- Ayomide: Frontend
	- Pull request done by: Paul and Bernardo

## Running
To run our project, you will need either a XAMP-, WAMP- or Docker-type setup.
To run it with Docker-type setup, proceed to this folder and run `docker-compose up` on cmd.
To run it with XAMP you will to put it in the `htdoc` direcotry. To run it with WAMP you need to put our files 
in the `WWW` direcotry
The web-app is accessible via the browser on http://localhost:80.
Then you will need a database that should run on phpMyAdmin. There you will need to insert the sql.

## structure
```
README.md
docker-compose.yaml
.gitignore
nginx.conf
src/ - | (the website itself, files are available to everybody)
    index.php
    other pages (the php files)
    css/ - |
        global.css (including colour scheme with vars, 0 margin padding, base grid, header and footer style, ...)
        per_page.css (multiple of those)
    img/
    fonts/
    favicon.ico
components/ - | (this is not accessible from a browser)
    header.php
    footer.php
```


## Built With
Our page has been build with
* JQUERY
* PHP
* HTML
* CSS
* NGINX
* JavaScript

## Copyright
Copyright to E3T and PECZARB
