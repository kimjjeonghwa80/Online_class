<?php
require('../fun.php');
if(sessioncheck() == false)
    //redirect to login if session isn't set
    header('Location: ../login.php');
else{
    $user = $_SESSION['user'];
    if (!$user->isstaff()){
        //redirects to student landing if user is a student
        header('Location: ../student/');
    } else {
?><!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>St. Aloysius School | <?php echo $user->username; ?></title>
  <link rel="shortcut icon" href="../img/thumpnail.png" type="image/png">
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../css/media.css" rel="stylesheet">
  
  
  <script>
function show2(){
    document.getElementById("uploads").style.display = "inline"; 
    document.getElementById("statistics").style.display = "none"; 
    document.getElementById("edit").style.display = "none"; 
    document.getElementById("delete").style.display = "none"; 
}
function show1(){
    document.getElementById("statistics").style.display = "inline"; 
    document.getElementById("uploads").style.display = "none"; 
    document.getElementById("edit").style.display = "none"; 
    document.getElementById("delete").style.display = "none"; 
}
function show3(){
    document.getElementById("edit").style.display = "inline"; 
    document.getElementById("statistics").style.display = "none"; 
    document.getElementById("uploads").style.display = "none"; 
    document.getElementById("delete").style.display = "none"; 
}
function show4(){
    document.getElementById("delete").style.display = "inline"; 
    document.getElementById("statistics").style.display = "none"; 
    document.getElementById("uploads").style.display = "none"; 
    document.getElementById("edit").style.display = "none"; 
}
function loadsubjects(classname){
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        //exit of data not ready
        if (!(this.readyState == 4 && this.status == 200))
            return;
        //obtain data from db
//        console.log(this.responseText);
        var subjects = [];
        for (x of this.responseText.split("<br/>"))
            subjects.push(x);
        subjects.pop();
        console.log(subjects);
        
        //clear data list options
        var datalist = document.getElementById("subjects");
        var datalistparent = datalist.parentElement;
        datalistparent.removeChild(datalist);
        datalist = document.createElement("datalist");
        datalist.id = "subjects";
        datalistparent.appendChild(datalist);
        
        //add options to the data list
        subjects.forEach(item => {
            let option = document.createElement('option');
            option.value = item;
            option.className = "subjectlist"
            datalist.appendChild(option);
        });
    }
    ajax.open("get", "getsubjects.php?user="+classname);
    ajax.send();
}
</script>
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="#statistics"  onclick="show1()">
          <i class="fa fa-cogs"></i>
          <span>STATISTICS</span></a>
      </li>
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link"  href="#uploads" onclick="show2()">
          <i class="fa fa-upload"></i>
          <span>UPLOAD</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        CHANGES
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link"  href="#edit" onclick="show3()">
          <i class="fas fa-fw fa-cog"></i>
          <span>EDIT</span></a>
      </li>
      
      
      <li class="nav-item">
        <a class="nav-link"  href="#delete" onclick="show4()">
          <i class="fa fa-trash"></i>
          <span>DELETE</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
    </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <!-- Topbar Navbar -->
          <h3>St. ALOYSIUS ENGLISH MEDIUM SCHOOL TANIKALLA</h3>
          <ul class="navbar-nav ml-auto">

           
            <div class="topbar-divider d-none d-sm-block"></div>
            
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Principal</span>
                <img class="img-profile rounded-circle " src="C:\Users\Adhin Babu\Desktop\sr\New folder\thumpnail.png"> 
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal1">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
              </div>
            </li>
          </ul>
        </nav>

       
<!--Stastictis page -->
        <div class="container-fluid" id="statistics" name="section" style="display: inline;">

          <!-- Page Heading -->
          Stastictis page
        </div>    
        

<!--upload page -->
 <div class="container-fluid" id="uploads" name="section" style="display: none;">

          <!-- Page Heading -->
          <form method="post" action="uploadlink.php">
          <table class="table">
    <tbody>
        <tr>
            <th scope="row">Select class</th>
            <td>
                <input list="classes" name="class" class="form-control" onchange="loadsubjects(this.value)"/>
                <datalist id="classes">
<?php
        $classes = fetchclasses();
        foreach($classes as $class){ ?>
                    <option value="<?php echo $class; ?>"> 
<?php   } ?>
                </datalist>
            </td>
        </tr>
        <tr>
            <th scope="row">Select subject</th>
            <td>
                <input list="subjects" name="subject" class="form-control">
                <datalist id="subjects"></datalist>
            </td>
        </tr>
        <tr>
            <th scope="row">Select chapter</th>
            <td>
                 <select name="chapter" class="form-control">
    <option value="1">Chapter 1</option>
    <option value="2">Chapter 2</option>
    <option value="3">Chapter 3</option>
    <option value="4">Chapter 4</option>
    <option value="5">Chapter 5</option>
    <option value="6">Chapter 6</option>
  </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Video Title</th>
            <td>
                <div class="dropdown">
                    <input name="title" class="form-control" type="text">
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">Video Link</th>
            <td>
                <div class="dropdown">
                    <input name="vlink" class="form-control" type="text">
                </div>
            </td>
        </tr>
        <tr>
           <td colspan="2">
                <center><input class="btn btn-success btn-primary btn-lg" type="submit" value="Upload"></center>
            </td>
        </tr>
    </tbody>
</table>
</form>
        </div>    
        
<!--edit page -->       
     <div class="container-fluid" id="edit" name="section" style="display: none;">

          <!-- Page Heading -->
                  <table class="table">
  <thead>
    <tr>
      <th scope="col">SINO</th>
      <th scope="col">CLASS</th>
      <th scope="col">SUBJECT</th>
      <th scope="col">CHAPTER NUMBER</th>
      <th scope="col">TITLE</th>
      <th scope="col">YOUTUBE LINK</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>Otto</td>
      <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal3">Edit</button></td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>Otto</td>
      <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal3">Edit</button></td>
    </tr>
  </tbody>
</table>
        </div>           
               
<!--delete model -->                       
 <div class="container-fluid" id="delete" name="section" style="display: none;">

          <!-- Page Heading -->
          <table class="table">
  <thead>
    <tr>
      <th scope="col">SINO</th>
      <th scope="col">CLASS</th>
      <th scope="col">SUBJECT</th>
      <th scope="col">CHAPTER NUMBER</th>
      <th scope="col">TITLE</th>
      <th scope="col">YOUTUBE LINK</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>Otto</td>
      <td>Otto</td>
      <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal4">Delete</button></td>
    </tr>
  </tbody>
</table>
        </div>     
                            
        
       
      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php" id="logout">Logout</a>
        </div>
      </div>
    </div>
  </div>
  
   <!-- Profile Modal-->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="input-group">
                <input class="form-control" type="password" placeholder="Current Password">
            </div>
            <br>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="New Password">
            </div>
            <br>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="Confrim New Password">
            </div>
            <br>
        </div>
        <div class="modal-footer">
          <a class="btn btn-primary" href="login.html">Save</a>
        </div>
      </div>
    </div>
  </div>
  
 <!--edit model -->
       <div class="modal fade" id="myModal3">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Update</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <table class="table table-dark">
    <thead>
      <tr>
        <th>Class</th>
        <th>Subject</th>
        <th>Chapter</th>
        <th>Video Description</th>
        <th>Video link</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><select name="class" >
        <option value="LKG">LKG</option>
        <option value="UKG">UKG</option>
        </select></td>
      <td>
           <select name="SUBLECT">
    <option value="ENG">ENGLISH</option>
  </select>
      </td>
      <td>
          <select name="CHAPTER">
    <option value="one">1</option>
    <option value="two">2</option>
    <option value="three">3</option>
    <option value="four">4</option>
    <option value="five">5</option>
    <option value="six">6</option>
  </select>
      </td>
      <td><div class="dropdown"><input type="text"></div>
      </td>
   <td>
       <div class="dropdown"><input type="text"></div>
   </td>
        </tr>
    </tbody>
  </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Update</button>
        </div>
      </div>
    </div>
  </div>
  
  
  <!-- delete model -->
  <div class="modal" id="myModal4">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Do you want to remove this ??
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>

    </div>
  </div>
</div>
  
        

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
<?php
    }
}
?>