<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap Link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/44d3cca51b.js" crossorigin="anonymous"></script>
  <title>Laravel Crud</title>
</head>


<body class="container justify-content-center bg-light d-flex flex-column  vh-100">
  <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="studentmodal" tabindex="-1" role="dialog" aria-labelledby="studentmodal" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" >Add New Student</h5>
 </div>


 <div class="modal-body">
    <form id="submitForm">
    <div class="form-group">
      <label for="fname" class="my-2">First Name:</label>
      <input type="text" name="fname" class="form-control" id="fname" aria-describedby="fname" placeholder="Enter first name">
      
    </div>
    <div class="form-group">
      <input type="hidden" name="id" id="id">

      <label for="lname" class="my-2">Last Name:</label>
      <input type="text" name="lname" class="form-control" id="lname" aria-describedby="lname" placeholder="Enter last name">
      
    </div>

    <div class="form-group">

      <label for="username" class="my-2">Username:</label>
      <input type="text" name='username' class="form-control" id="username" aria-describedby="username" placeholder="Enter username">
    </div>

    <div class="form-group  my-2">

      <label class=" my-2">Course: </label>
      <select class="form-select" name="course" aria-label="course">
  <option selected>Choose your course:</option>
  <option value="BSIT">Bachelor of Science in Information Technology (BSIT)</option>
  <option value="BSIS">Bachelor of Science in Information System (BSIS)</option>
  <option value="ACT">Associate in Computer Technology (ACT)</option>
  <option value="BSCS">Bachelor of Science in Computer Science (BSIS)</option>
</select>
    </div>

    <div class="form-group">

      <label for="email" class="my-2">Email:</label>
      <input type="email" name="email" class="form-control" id="email" aria-describedby="email" placeholder="Enter email">
      
    </div>
  
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Save changes</button>
  </div>

   </form>

    </div>
  </div>
</div>


<h1 class="text-center">Laravel Simple Crud System With Ajax</h1>
  <div class="row gap-4  justify-content-end">

  <button type="button" id="modal-btn"  class="btn btn-primary fw-bold w-auto ml-auto bg-primary text-white border-0 p-2 px-4 rounded" data-toggle="modal" data-target="#studentmodal">
  <span><i class="fa-solid fa-plus"></i></span> Add student
</button>

  <table class="table">
  <thead >
    <tr>
      <th scope="col" class="p-3">List Student #:</th>
      <th scope="col" class="p-3">First Name:</th>
      <th scope="col" class="p-3">Last Name:</th>
      <th scope="col" class="p-3">Username:</th>
      <th scope="col" class="p-3">Course:</th>
      <th scope="col" class="p-3">Email:</th>
      <th scope="col" colspan="6" class="text-center p-3">Actions:</th>
    </tr>
 
  </thead>
  <tbody id="student-data" data-status='true'>

  </tbody>
  <tr class="default-row"><td colspan="7" id="respanel" class="bg-secondary-subtle p-4">No data available..</td></tr>;
</table>


</div>

<!-- Ajax comes here and you need to target the form since you will get data on that form-->
<script>
  // inserting the data
  $(document).ready(function() {
    

    $('#modal-btn').on('click', function () {
      $('#submitForm')[0].reset(); // reset the data
      $('#id').val(''); // new data 
      
  });


    $('#submitForm').on('submit', function (e) {
      e.preventDefault();

      const data = $('#submitForm').serialize(); // you need to serialize to grab data at once

      $.ajax({
        url: "adddata", // this is the function from controller
        type: "POST",
        data: {
          "_token": "{{csrf_token()}}",
            data: data
        },

        success: function(res) {
          $('#respanel').html(res);
          $('#submitForm')[0].reset(); // reset the data
          $('#studentmodal').modal('hide'); // hide the modal
          fetchrecords();  // displaying data without refresh
        }

      });


    })



  });

  //  Editing the data
  $(document).on('click','.bg-primary', function (e) {
    e.preventDefault();
    const id = $(this).val();
    $.ajax({
      url: 'editdata',
      type: 'POST',
      data: {
        "_token": "{{csrf_token()}}",
        id: id
      },

      success: function (res) {
        $('#submitForm')[0].reset(); // reset the data
        $('#id').val(res.id);
        $('#fname').val(res.fname);
        $('#lname').val(res.lname);
        $('#username').val(res.username);
        $('#course').val(res.course);
        $('#email').val(res.email);

        $('#studentmodal').modal('show');

 
      }
      
    })

  });


  //  Deleting the data
  $(document).on('click','.bg-danger', function (e) {
    e.preventDefault();
    const id = $(this).val();
    $.ajax({
      url: 'deletedata',
      type: 'POST',
      data: {
        "_token": "{{csrf_token()}}",
        id: id
      },

      success: function (res) {
      
        $('#respanel').html(res);
        fetchrecords() // so the new data will show
 
      }
      
    })

  });



  // getting the data or display it into table

  function fetchrecords() {


  $.ajax({
     url: 'getdata',
     type: 'GET',
     success: function (res) {

      //  Using foreach
  let html = "";
      res.forEach(data => {
      html += `
      
      <tr>
<th scope="row" class="p-3">${data.id}</th>
      <td class="p-3">${data.fname}</td>
      <td class="p-3">${data.lname}</td>
      <td class="p-3">${data.username}</td>
      <td class="p-3">${data.course}</td>
      <td class="p-3">${data.email}</td>
      <td class="d-flex gap-2">
        <button class="bg-primary text-white rounded border-0 p-2 w-50" value="${data.id}"><span><i class="fa-solid fa-pencil"></i></span> Edit</button>
        <button class="bg-danger border-0 text-white rounded p-2 w-50 " value="${data.id}"><span><i class="fa-solid fa-trash"></i></span> Delete</button>
    </td> 
    </tr>`;


      })

    $('#student-data').html(html);
    }
   });


  }
    
  fetchrecords(); 

</script>


  </body>
</body>
</html>

