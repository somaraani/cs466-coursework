CREATE TABLE Users (
    username VARCHAR(30) PRIMARY KEY NOT NULL,
    password VARCHAR(30) NOT NULL
);

CREATE TABLE Bookmarks (
    id INT(6) unsigned AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    url VARCHAR(256) NOT NULL, 
    username VARCHAR(30) NOT NULL,
    FOREIGN KEY (username) REFERENCES Users(username) ON DELETE CASCADE 
);
