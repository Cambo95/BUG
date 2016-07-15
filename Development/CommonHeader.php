<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<head>
    <style>
        input[type=text]{
            width: 130px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: white;
            background-image: url('https://cdn1.iconfinder.com/data/icons/hawcons/32/698627-icon-111-search-128.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 12px 20px 12px 40px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }
        input[type=text]:focus{
            width:100%;
        }
    </style>
</head>
<body>
    <header class="w3-container w3-teal">
        <H1> SPLAT! Bug Catcher</H1>
    </header>
<ul>
    <li><a href="http://1301070cameronbug.azurewebsites.net/production/useralbugs.php">Test Link 1</a></li>
</ul>

<form>
    Username:<br>
    <input type ="text" name="username">
    <br>
    Password:<br>
    <input type="password" name="password">
    <br>
    <input type ="submit" value ="Login">
</form>
<p>Search for Bugs:</p>
<form>
    <input type="text" name="search" placeholder="Search...">
</form>
</body>
</html>