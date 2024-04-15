# Ashton Putnam
## 2024 UVM Hackathon Help Ticket Website

https://go.uvm.edu/hackhelp

This website is a simple way to handle help tickets for the 2024 UVM Hackathon. 

Hackathon participants can access the page by visiting the url and can submit help ticket requests via the specified page. All tickets are recorded within MySQL tables and can be easily accessed on the site by the mentors of the event. Mentors simply need to go to the mentor page, enter the secret username and password, then they can see a list of all current help tickets, past help tickers, and can mark tickets as solved. 

PHP code taking care of everything. 

### Note:
connect-DB.php is not included in this repo for security purposes. If you plan on remaking this project: make a file and include the following code, filling in the Xs for database name, usename and password.

...
  '''php

    connect-DB.php
  
    <?php
    $databaseName = 'XXXXXXXXXXX';
    $dsn = 'mysql:host=[start of website URL];dbname=' . $databaseName;
    $username = 'XXXXXXXXXXX';
    $password = 'XXXXXXXXXXX';
    $pdo = new PDO($dsn, $username, $password);
    ?>
    
  '''
...
