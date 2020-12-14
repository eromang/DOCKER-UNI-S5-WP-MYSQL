<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DB Access with mysqli</title>
</head>
<body>
<?php
$database = "webprog";
$user = $password = "webprog";
$host = "mysql";
$connection = new mysqli($host, $user, $password, $database);
$result = $connection->query("SELECT * FROM `Accounts`");

print ("<h1>Found the following account information</h1>");
print("<table border='1' cellpadding='10' style='padding:1mm'>");
print("<tr><th>Account name</th><th>Password</th><th>Email</th></tr>");
foreach ($result as $row) {
    print("<tr><td>" . $row["account"] . " </td><td>"
        . $row["pwd"] . "</td><td>" . $row["email"] . "</td></tr>");
}
print("</table>");

/* Now running an update query, as illustration */
$connection->query("UPDATE `Accounts` set account = concat('tester_', round(10*rand())) where email like 'tester%'");
?>
</body>
</html>