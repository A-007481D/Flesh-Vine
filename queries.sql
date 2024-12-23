CREATE DATABASE MagiCuisine;
USE MagiCuisine;

CREATE TABLE Roles (
    RoleID INT AUTO_INCREMENT PRIMARY KEY,
    RoleName VARCHAR(50) NOT NULL
);

CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(100) NOT NULL,
    LastName VARCHAR(100) NOT NULL,
    Email VARCHAR(150) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    RoleID INT NOT NULL,
    FOREIGN KEY (RoleID) REFERENCES Roles(RoleID) ON DELETE CASCADE
);

CREATE TABLE Menus (
    MenuID INT AUTO_INCREMENT PRIMARY KEY,
    MenuName VARCHAR(100) NOT NULL,
    MenuDesc TEXT,
    CreatedBy INT NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (CreatedBy) REFERENCES Users(UserID) ON DELETE CASCADE
);

CREATE TABLE Dishes (
    DishID INT AUTO_INCREMENT PRIMARY KEY,
    DishName VARCHAR(100) NOT NULL,
    DishDesc TEXT,
    Price DECIMAL(10, 2) NOT NULL,
    MenuID INT NOT NULL,
    FOREIGN KEY (MenuID) REFERENCES Menus(MenuID) ON DELETE CASCADE
);

CREATE TABLE Bookings (
    BookingID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT NOT NULL,
    MenuID INT NULL,  
    BookingDate DATE NOT NULL,
    NumberOfPeople INT NOT NULL CHECK (NumberOfPeople > 0),
    Status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
    FOREIGN KEY (DishID) REFERENCES Dishes(DishID) ON DELETE SET NULL,
    FOREIGN KEY (MenuID) REFERENCES Menus(MenuID) ON DELETE SET NULL
);
