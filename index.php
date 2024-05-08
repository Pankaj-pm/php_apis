<?php

include ("student.php");
include ("connection.php");


$connection = new Connection();
$connection->connect();

// $connection->insertRec("hello","abc@gmail.com","1223","123",123);
$res = $connection->getData();

// $data=mysqli_fetch_assoc($res);
// var_dump($data);

if (isset($_REQUEST["btn_add"])) {

  $name = $_GET["fullName"];
  $email = $_GET["email"];
  $number = $_GET["num"];
  $mark = $_GET["mark"];
  $pass = $_GET["pass"];
  $connection->insertRec($name, $email, $pass, $number, $mark);

} else {
  echo "Value is null";
}

?>

<html>

<head>
  <title>Student Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1>Student Record</h1>
    <p>please Enter All the detail.</p>
    <form method="GET" action="">
      Full Name : <input type="text" name="fullName" class="form-control"><br />
      Email : <input type="email" name="email" class="form-control"><br />
      Password : <input type="password" name="pass"class="form-control"><br />
      Number : <input type="number" name="num" class="form-control"><br />
      Image : <input type="file" name="file" class="form-control"><br />
      Mark : <input type="number" name="mark" class="form-control"><br />
      <input type="submit" value="Add" name="btn_add" class="btn btn-primary">
      <button type="button" class="btn btn-danger">Base class</button>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Full Name</th>
          <th scope="col">Email</th>
          <th scope="col">Number</th>
          <th scope="col">Image</th>
          <th scope="col">Marks</th>
        </tr>
      </thead>
      <tbody>
        <?PHP while ($data = mysqli_fetch_assoc($res)) {

          echo '<tr>
                <th scope="row">' . $data["id"] . '</th>
                <td>' . $data["fulll_name"] . '</td>
                <td>' . $data["email"] . '</td>
                <td>' . $data["number"] . '</td>
                <td>' . $data["image"] . '</td>
                <td>' . $data["marks"] . '</td>
              </tr>';

        } ?>


      </tbody>
    </table>
  </div>
</body>

</html>