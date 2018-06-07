<?php
  include("./session.php");
  include("./utils/check-login.php");
  include("./utils/check-login.php");
  include("./templates/header.php");
  
  
  $id        = $_REQUEST['id'];
  $firstname = $_REQUEST['firstname'];
  $lastname  = $_REQUEST['lastname'];
  $email     = $_REQUEST['email'];
  $address   = $_REQUEST['address'];
  
  $hasValues = isset($id) && isset($firstname) && isset($lastname) && isset($email) && isset($address);
  
  if ($hasValues) {
      $path = dirname(__FILE__) . '/xml/students.xml';
      
      $xml = simplexml_load_file($path);
      
      $child = $xml->addChild("student");
      
      $child->addChild("student_id", $id);
      $child->addChild("firstname", $firstname);
      $child->addChild("lastname", $lastname);
      $child->addChild("address", $address);
      
      $child->student_id->addAttribute("email", $email);
      
      $xml->asXML($path);
      
  }
?>


<div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            <div class="bg-white p-3 rounded">
                <?php include("./templates/logged_nav.php"); ?>
            </div>
        </div>

        <div class="col-md-9">
            <div class="bg-white p-3 rounded">
                <h1>Add Student</h1>
                <form action="add-student.php" method="POST">
                    <div class="form-group">
                        <label for="id">Student ID</label>
                        <input type="number" class="form-control" id="id" name="id" placeholder="Enter ID">
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter lastname">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
