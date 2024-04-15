CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
);

users should be only 1 row

username: Mentor
password: admin

1, Mentor, admin
account for mentors to use to see list of help tickets and be able to mark them as completed 

CREATE TABLE HelpTickets (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    firstName VARCHAR(255) DEFAULT NULL,
    lastName VARCHAR(255) DEFAULT NULL,
    email VARCHAR(255) DEFAULT NULL,
    teamName VARCHAR(255) DEFAULT NULL,
    room VARCHAR(255) DEFAULT NULL,
    question VARCHAR(500) DEFAULT NULL,
    completedYN BOOLEAN DEFAULT 0,
    completedBy VARCHAR(255) DEFAULT NULL
);