<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu+Mono&display=swap');
body {
font-family: 'Open Sans', sans-serif;
/* font-family: 'Ubuntu Mono', monospace; */
  font-size: 16px;
  background-color: #f5f5f5;
  color: #333;
  margin: 0;
}

.login-container {
  width: 300px;
  margin: 100px auto;
  padding: 20px;
  background-color: #fff;
  text-align: center;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

input[type="text"],
input[type="password"] {
  width: 92%;
  margin-bottom: 10px;
  padding: 10px;
  background-color: #f0f0f0;
  color: #333;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #ff2054;
  color: #fff;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

.error {
  color: red;
  margin-top: 10px;
}

.dashboard-container {
  text-align: center;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

    </style>
</head>
<body>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
        
       
    
        

    <div class="dashboard-container">
        <h1>Welcome User</h1>
        <p>Lorem Ipsum dolor scheise bratwurst krankenwagen</p>
    </div>
</body>
</html>
