# Project-DAM
Project 2 Team A

## Team tasks: 
    - Paul: Back-end + servers
    - Bernardo: Back-end + servers

    - Ege: Front-end
    - Caterina: Front-end

    - Ayomide: Fullstack
    - Zsombor: Fullstack
    - Rares: Fullstack
 
    - Pull request done by: Paul and Bernardo


## Running
The website is intended to be run with Ubuntu installed. Proceed to the instruction manual to get started.
You can also choose to run it on your local machine (as per committing changes, as an example).
To run the website, you will need to have Docker installed.
Proceed to the root folder (this one) and run `docker-compose up` on cmd.
The website will be available on `localhost` and the phpmyadmin on `localhost/phpmyadmin/`.


## structure
```
README.md
docker-compose.yaml
.gitignore
nginx.conf
nginx-docker.conf
public/ - | (the website itself, files are available to everybody)
    view/ - |
        index.php
        other pages (the php files)
    css/ - |
        per_page.css (multiple of those)
        normalize.css (general css rules: margon, padding, etc)
    img/ (for images)
    js/ (for javascript)
components/ - | (this is not accessible from a browser; it contains the php files that are used within the website)
    header.php
    footer.php
    dbConnect.php
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
