# Financial-Grant-Management-System

Project Implementation Detail:

Backend: PHP <br>
Database: MYSQL <br>
Frontend: HTML, CSS <br>
Operating system: Windows <br>
Local server : Xampp <br>
_________________________________________________________________________________________
_________________________________________________________________________________________

Build Setup for Windows

To run this project you will be needing localhost, Install Xampp, Wamp or any other local server on your machine.
For Xampp installation you can refer to this link: <br> https://www.apachefriends.org/index.html

Once you are done with Xampp installation check it once by running localhost/index.php or localhost/phpmyadmin.
_________________________________________________________________________________________
_________________________________________________________________________________________

Step-1: Download the project file from github and extract the zip file, move the Financial-Grant-Management-System folder to your system's C:\xampp\htdocs and rename it as SoftwareProject.
_________________________________________________________________________________________

Step-2: In Xampp phpmyadmin create the database rbrajat, and make 2 tables - `users` and `grantdata`
users
  `id` int(50) Primary AUTO_INCREMENT,
  `userName` varchar(50) DEFAULT NONE,
  `password` varchar(50) DEFAULT NONE,
  `firstName` varchar(50) DEFAULT NONE,
  `lastName` varchar(50) DEFAULT NONE,
  `gender` varchar(10) DEFAULT NONE,
  `role` varchar(20) DEFAULT NONE,
  `presentLimit` int(50) DEFAULT NONE,
  `grantMoneyLeft` int(50) DEFAULT NONE,
  `numberOfGrantsRequested` int(50) DEFAULT NONE,
  
grantdata
  `id` int(50) Primary AUTO_INCREMENT,
  `grantId` varchar(50) DEFAULT NONE,
  `userName` varchar(50) DEFAULT NONE,
  `grantType` varchar(50) DEFAULT NONE,
  `grantMoney` int(50) DEFAULT NONE,
  `grantFileSize` int(50) DEFAULT NONE,
  `grantStatus` varchar(50) DEFAULT NONE,
  `requestTime` varchar(50) DEFAULT NONE,
  `decisionTime` varchar(50) DEFAULT NONE,
  `moneyGiven` int(10) DEFAULT 0,  
_________________________________________________________________________________________

Step-3 : You will not need to modify php.ini file because all the variables are set according to defaults of php.ini

________________________________________________________________________________________

Step-4: Check dbConnect.php file once.
_________________________________________________________________________________________

Step-5: Run http://localhost/SoftwareProject/login.php
_________________________________________________________________________________________
_________________________________________________________________________________________
