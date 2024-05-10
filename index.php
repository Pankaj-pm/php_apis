<?php

include ("student.php");
include ("connection.php");


$connection = new Connection();
$connection->connect();

// $connection->insertRec("hello","abc@gmail.com","1223","123",123);
$res = $connection->getData();

// $data=mysqli_fetch_assoc($res);
// var_dump($data);

if (isset($_REQUEST["btn_add_new"])) {
  echo "btn_add_new click";
  header("Location: success.php");
}


if (isset($_REQUEST["btn-delete"])) {
  $id = $_GET["id"];
  $connection->deleteRec($id);
  header("Location: index.php");
}

$studentRecord = null;
if (isset($_REQUEST["btn-edit"])) {
  $id = $_GET["id"];
  
  // $name = $_GET["fullName"];
  // $email = $_GET["email"];
  // $number = $_GET["num"];
  // $mark = $_GET["mark"];
  // $pass = $_GET["pass"];
  $studentRes = $connection->getStudentData($id);
  $studentRecord=mysqli_fetch_array($studentRes);
  // $connection->insertRec($name, $email, $pass, $number, $mark);
}

if (isset($_REQUEST["btn_add"])) {

  $name = $_GET["fullName"];
  $email = $_GET["email"];
  $number = $_GET["num"];
  $mark = $_GET["mark"];
  $pass = $_GET["pass"];
  echo $studentRecord==null? "Add  123 ":"Update ";

  // $connection->insertRec($name, $email, $pass, $number, $mark);
  // header("Location: index.php");

} 


if (isset($_REQUEST["btn_update_record"])) {

  $s_id = $_GET["s_id"];
  $name = $_GET["fullName"];
  $email = $_GET["email"];
  $number = $_GET["num"];
  $mark = $_GET["mark"];
  $pass = $_GET["pass"];
  

  $connection->updtaeRec($s_id,$name, $email, $pass, $number, $mark);
  header("Location: index.php");

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
      <input type="hidden" name="s_id" value="<?php  echo $studentRecord["id"] ?>" class="form-control"><br />
      Full Name : <input type="text" name="fullName" value="<?php  echo $studentRecord["fulll_name"] ?>" class="form-control"><br />
      Email : <input type="email" name="email" value="<?php  echo $studentRecord["email"] ?>" class="form-control"><br />
      Password : <input type="password" name="pass" value="<?php  echo $studentRecord["password"] ?>" class="form-control"><br />
      Number : <input type="number" name="num" value="<?php  echo $studentRecord["number"] ?>" class="form-control"><br />
      Image : <input type="file" name="file" class="form-control"><br />
      Mark : <input type="number" name="mark" value="<?php  echo $studentRecord["marks"] ?>"class="form-control"><br />
      <input type="submit" value="<?php echo $studentRecord==null? "Add":"Update";  ?>" name="<?php echo $studentRecord==null? "btn_add":"btn_update_record";  ?>" class="btn btn-primary">
      <button type="submit" name="btn_add_new" class="btn btn-danger">Base class</button>
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
          <form method="GET" action="">
                <th scope="row">' . $data["id"] . '</th>
                <td>' . $data["fulll_name"] . '</td>
                <td>' . $data["email"] . '</td>
                <td>' . $data["number"] . '</td>
                <td>' . $data["image"] . '</td>
                <td>' . $data["marks"] . '</td>
                <td><input type="hidden" name="id" value=' . $data["id"] . ' class="form-control"><br /></td>
                <td><button type="submit" name="btn-edit" class="btn">Edit</button></td>
                <td><button type="submit" name="btn-delete" class="btn btn-danger">Delete</button></td>
                </form>
              </tr>';

        } ?>


      </tbody>
    </table>

  </div>
</body>

</html>