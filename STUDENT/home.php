<?php 
require('../fun.php');
if (sessioncheck() == false)
    //redirect to login if session isn't set
    header('Location: ../login.php');
else {
    $user = $_SESSION['user'];
    if ($user->isstaff()){
        //redirect to staff landing if user is a staff member
        header('Location: ../staff/');
    } else {
        $clas = classes($user->id); //array of clas-subs of usr
        $vids = vidlink($clas); //array of (array of links)
?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/media.css" rel="stylesheet">
    
    <title>St. Aloysius School | <?php echo $user->username; ?></title>
    <link rel="shortcut icon" href="../img/thumpnail.png" type="image/png">
    <script>
        class link{
            constructor(staffid, classid, title, vlink, chapter){
                this.staffid = staffid;
                this.classid = classid;
                this.title = title;
                this.vlink = vlink;
                this.chapter = chapter;
            }
        }
        <?php
        echo "var allvids=[";
        foreach($vids as $sublinks){
            echo "[";
            foreach($sublinks as $link){
                echo "new link($link->staffid, $link->classid, '$link->title', '$link->vlink', $link->chapter),";
            }
            echo "],";
        }
        echo "];";
        ?>
        console.log(allvids);
    </script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <span class="sidebar-brand d-flex align-items-center justify-content-center" href="student_login.html">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3"><h4><?php echo $user->username; ?></h4></div>
      </span>

      <hr class="sidebar-divider my-0">
      <!-- Heading -->
      <div class="sidebar-heading">
       <br>
        <h6>SUBJECTS</h6>
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
<?php $i=0; foreach($clas as $subject){ ?>
      <li class="nav-item">
        <a class="nav-link" href="#" id="<?php echo $i++; ?>" >
          <i class="fa fa-book"></i>
          <span><?php echo $subject->subjectname; ?></span></a>
      </li>
<!--      <hr class="sidebar-divider my-0">-->
<?php } ?>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <h3>St. ALOYSIUS ENGLISH MEDIUM SCHOOL THANIKELLA</h3>
          <ul class="navbar-nav ml-auto">

           
            <div class="topbar-divider d-none d-sm-block"></div>
            
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                              <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal" id="logout">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              <!-- Dropdown - User Information -->
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
          <!-- Page Heading -->
        <script>
            jQuery('a').click(function (event) {
            var id = $(this).attr("id");
                if(id!='logout')
                var vids = allvids[id]; //gets all the links to that subject
                if (vids.length == 0){
                    document.getElementById("accordion2").style.display = "inline"; 
                    //var iv = document.getElementById('accordion');
                    //iv.innerHTML += ' ';
                    //iv.innerHTML += '<center><h3>No chapters Added<h3></center>';
                    //document.getElementById("accordion").innerText = "\tNo chapters Uploaded";   
                }
                //fetch all chapters for which links are available
                var chap = [];
                for (x of vids) chap.push(x.chapter);
                chap = [...(new Set(chap))].sort();
                console.log(chap);
                
                //display
                var parent = document.getElementsByClassName('card')[0];
                parent.innerHTML = "";
                for (x of chap){
                    document.getElementById("accordion2").style.display = "none";
                    parent.innerHTML += '<div class="card-header collapsed" data-toggle="collapse" href="#collapse'+x+'"><a class="card-title">Chapter '+x+'</a></div>';
                    for (y of vids) if (y.chapter == x){
                        parent.innerHTML += '<div id="collapse'+x+'" class="card-body collapse" data-parent="#accordion" ><a  href="#" data-toggle="modal" data-target="#myModalPrev"  onClick="re(\'' +y.vlink+ '\')">'+y.title+'</a></div>'; 
                    }
                }
                
            });
        </script>
           <B><div id="accordion" class="accordion">
        <div class="card mb-0" style="background-color:#DAE0E2;">
           <center><h2>Select a subject to view Classes</h2>
           </center>
        </div>
    </div></B>
        <B><div id="accordion2" style="display: none;">
        <div class="card mb-0" style="background-color:#DAE0E2;">
           <center><h2>No chapters added</h2>
           </center>
        </div>
    </div></B>

        <!-- /.container-fluid -->

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
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade" id="myModalPrev" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body embed-responsive embed-responsive-16by9">
                   
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
  <script>
    function re(url)
    {
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match && match[2].length == 11) 
    {
    var idVideo = match[2];
        $('#myModalPrev .modal-body').html('<iframe width="100%" height="400px" src="https://www.youtube.com/embed/' + idVideo + '?autoplay=true" frameborder="0" allowfullscreen></iframe>');
        $('#myModalPrev').on('hidden.bs.modal', function () {
       $('#myModalPrev .modal-body').empty();
    });
    } else {
        alert("NO VIDEO UPLOADED");
    }
    }
    </script>
</body>
</html>
<?php
    }
}
?>