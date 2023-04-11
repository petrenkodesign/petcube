# Petcube - test APP # v.1.0.2

web application that consists of two pages: a main landing page and a dashboard page.

*(landing page design in Figma [Petcube Landing](https://www.figma.com/file/MzvPht5mycZ5Tr1P0gwIEV/Petcube-App-Test))*

---

## Requirements

PHP 7.4.x\
Symfony 4.4.x\
Docker 18.03.x\
Docker-compose 1.20.x\
---

## Installation

### Step 1:

download an unzip repository or use git clone command:

``git clone https://github.com/petrenkodesign/petcube.git``

navigate to project directory 

``cd petcube ``

### Step 2: 

run docker-compose builder in project directory:

``docker-compose up -d --build``

or use bash script 

``./buld_project.sh``

### Step 3:

#### For building project manually use next commands:

run the console on the container that has php installed

``docker-compose exec php /bin/bash``

resolves the project dependencies, and installs them

``composer install``

run the following command to create a database

``php bin/console doctrine:database:create``

database migration, create table from entity

``php bin/console doctrine:schema:update --force``

create user with administrator privileges

``php bin/console app:create-admin --username=admin --email=admin@admin --password=admin --no-interaction``


### Step 4: Change variables in .env file:

the project must be opened in the browser at the address:

``http://localhost:8080``

you may need to do docker [port forwarding](https://docs.docker.com/config/containers/container-networking/)

for link to dashboard use link below

``http://localhost:8080/profile``

or click to qr code in navigation menu on start landing page


#### Additional ####

Default administrator credential

username: ``admin@admin``\
password: ``admin``

you can change your password on dashboard, link /password 

To clear Symfony cache, run the following command:

``php bin/console cache:clear``

Regenerate the list of all classes in the app

``composer dump-autoload``

Application structure

``http://localhost:8080/``              - home landing page

``http://localhost:8080/profile``       - user profile

``http://localhost:8080/password``      - password change page

``http://localhost:8080/login``         - authorization page

``http://localhost:8080/registration``  - registration page

``http://localhost:8080/admin``         - admin control panel page