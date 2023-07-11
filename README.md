# Marketplace
  - PHP Technical Challenge Marketplace
  - Product registration system
  - Value calculation and tax
# Requirement
  - PHP
  - PostgreSQL
# Instructions
  - download the project zip file
  - in the php directory in php.ini uncomment the pgsql extension line
  - run the postgres command to create the database:
``` 
  createdb -U postgres base
  pg_restore -U postgres -d postgres -d base base.dump
```  
  - start the php server in the terminal with the command:
 ```
php -S localhost:8000
```
  - access localhost on port 8000
