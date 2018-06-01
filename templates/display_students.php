<form action="index.php" method="POST" >

  <div class="form-row align-items-center bg-dark p-2">
    <div class="form-group col-auto">
      <label for="lastname" class="text-white" >Search Lastname</label>
      <input type="text" name="lastname" class="form-control"  placeholder="Search Lastname" >
    </div>
    <div class="form-group col-auto">
      <label for="firstname"  class="text-white"  >Search Firstname</label>
      <input type="text" name="firstname" class="form-control"  placeholder="Search Firstname" >
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </div>
  </div>
</form>

<div class="modal fade" tabindex="-1" role="dialog" id="map-modal" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="map" style="width:100%; height: 500px" >
        </div>
      </div>
    </div>
  </div>
</div>


<table class="table">
<tr>
  <th>Student ID</th>
  <th>LastName</th>
  <th>FirstName</th>
  <th>Address</th>
</tr>

<?php
  
  include(dirname(__FILE__) . "./../utils/contains.php");
  
  $searchLastName  = $_REQUEST["lastname"];
  $searchFirstName = $_REQUEST["firstname"];
  
  $hasSearch = isset($searchFirstName) || isset($searchLastName);
  
  $path = dirname(__FILE__) . '/../xml/students.xml';
  
  if (file_exists($path)) {
      $xml = simplexml_load_file($path);
      
      foreach ($xml->children() as $student) {
          
          $lastname  = $student->lastname;
          $firstname = $student->firstname;
          
          if ($hasSearch) {
              
              $doesNotContainLastName  = notContains($searchLastName, $lastname);
              $doesNotContainFirstName = notContains($searchFirstName, $firstname);
              
              if ($doesNotContainLastName && $doesNotContainFirstName) {
                  continue;
              }
          }
          
          echo "<tr>";
          
          echo "<td>" . $student->student_id . "  " . $student->student_id['email'] . "</td>";
          echo "<td>" . $lastname . "</td>";
          echo "<td>" . $firstname . "</td>";
          echo "<td> <button class='btn btn-link' type='button' data-toggle='modal' data-target='#map-modal'>" . $student->address . "</button></td>";
          echo "</tr>";
      }
      
      
  } else {
      exit('Failed to open xml.');
  }
?>
</table>