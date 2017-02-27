/* Object Tables, each of these could be an object in the api */
    CREATE DATABASE IF NOT EXISTS tutortables;
    use tutortables;

/* Stores emails, passwords for login*/
   
    CREATE TABLE IF NOT EXISTS Admin(
        id       INT          NOT NULL AUTO_INCREMENT,
         AdminID  VARCHAR(128)  NOT NULL,
         AdminPW VARCHAR(128),
        
        PRIMARY KEY(id),
     
    );


      CREATE TABLE IF NOT EXISTS Tutor(
    
        TutorID  VARCHAR(128)  NOT NULL,
        TutorPW VARCHAR(128),
        
        
     
    );


       CREATE TABLE IF NOT EXISTS User(
    
        userID  VARCHAR(128)  NOT NULL,
        name VARCHAR(128),
        type VARCHAR(128),
        
      
    );