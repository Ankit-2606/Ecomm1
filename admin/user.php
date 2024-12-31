<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php
    $con =  mysqli_connect('localhost','root','123456','ecomm');
    $Record = mysqli_query($con, "SELECT *FROM tbluser")
    ?>
    <table>
        <thead>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Delete</th>
        </thead>
        <tbody>
<?php
while($row = mysqli_fetch_array($Record)){
    echo"
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
       </tr>
       ";
}
?>
        </tbody>
    </table>
</body>
</html>