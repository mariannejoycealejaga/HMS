<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>RFID | Attendance Monitoring System</title>
    
    <!-- core CSS -->
    <link href="<?php echo web_root; ?>css/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/main.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/responsive.css" rel="stylesheet">

    <link href="<?php echo web_root; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">

<link href="<?php echo web_root; ?>css/dataTables.bootstrap.css" rel="stylesheet">
<!-- // <script src="<?php echo web_root; ?>select2/select2.min.css"></script> ./ -->

<!-- datetime picker CSS -->
<link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="screen">


<link rel="stylesheet" href="<?php echo web_root; ?>select2/select2.min.css">

<link href="<?php echo web_root; ?>css/nav-button-custom.css" rel="stylesheet" media="screen">
 
<link href="<?php echo web_root; ?>css/menu.css" rel="stylesheet" media="screen">
</head><!--/head--> 

<body class="homepage" >
 
<div id='cssmenu' style="margin-bottom: 30px">
<ul>
   <li class="<?php echo (currentpage_public() == 'index.php') ? "active" : false;?>"><a href='<?php echo web_root; ?>index.php'><i class="fa fa-home"></i> Home</a></li>
   <li class="<?php echo (currentpage_public() == 'employee') ? "active" : false;?>"><a href='<?php echo web_root; ?>employee/'><i class="fa fa-users"></i> Employees</a></li>
   <li class="<?php echo (currentpage_public() == 'attendance') ? "active" : false;?>"><a href='<?php echo web_root; ?>attendance/'><i class="fa fa-clock-o"></i> Attendance</a></li>
   <li  class="<?php echo (currentpage_public() == 'position') ? "active" : false;?>"><a href='<?php echo web_root; ?>position/'><i class="fa fa-graduation-cap"></i> Positions</a></li>
   <li class="<?php echo (currentpage_public() == 'department') ? "active" : false;?>"><a href='<?php echo web_root; ?>department/'><i class="fa fa-building"></i>  Departments</a></li>
   <li class="<?php echo (currentpage_public() == 'user') ? "active" : false;?>"><a href='<?php echo web_root; ?>user/'><i class="fa fa-user"></i> Users</a></li>
   <li  class="<?php echo (currentpage_public() == 'report') ? "active" : false;?>"><a href='<?php echo web_root; ?>report/'><i class="fa fa-info"></i> Reports</a></li>
<!--   <li ><a href='--><?php //echo web_root; ?><!--logout.php'><i class="fa fa-logout-o"></i> Logout</a></li>-->
</ul>
</div>
      

<div class="container"  style="min-height:500px;">
        <div class="row">
            <?php  check_message();  ?>    
            <?php require_once $content; ?>  
        </div>
</div>
 
 <!--
    <footer id="footer" class="midnight-blue" style="background-color: #47c9af;border-top: 1px solid #47c9ad">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2018 <a target="_blank" href="<?php echo web_root; ?>" title="Free Twitter Bootstrap WordPress Themes and HTML templates">Attendance Monitoring System</a>. All Rights Reserved.
                </div> 

            </div>
        </div>
    </footer>--><!--/#footer--> 

 
    <script src="<?php echo web_root; ?>jquery/jquery.min.js"></script> 
    <script src="<?php echo web_root; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo web_root; ?>js/js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo web_root; ?>js/js/jquery.isotope.min.js"></script>
    <script src="<?php echo web_root; ?>js/js/main.js"></script>
    <script src="<?php echo web_root; ?>js/js/wow.min.js"></script>

    <!-- DataTables JavaScript -->
<script src="<?php echo web_root; ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo web_root; ?>js/dataTables.bootstrap.min.js"></script>

<script src="<?php echo web_root; ?>select2/select2.full.min.js"></script>
<script src="<?php echo web_root; ?>slimScroll/jquery.slimscroll.min.js"></script>

<script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>




<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>input-mask/jquery.inputmask.js"></script> 
<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>input-mask/jquery.inputmask.date.extensions.js"></script> 
<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>input-mask/jquery.inputmask.extensions.js"></script> 
 

<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>input-mask/meiomask.min.js"></script> 
<script src="<?php echo web_root; ?>js/ekko-lightbox.js"></script>


<!-- Custom Theme JavaScript --> 


<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/alejaga.js"></script> 

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script> 
    
    $(function () {
         $(".select2").select2();
    })
  

     $('input[data-mask]').each(function() {
        var input = $(this);
        input.setMask(input.data('mask'));
      });

   //Datemask2 mm/dd/yyyy
    $("#datetime12").inputmask("hh:mm t", {"placeholder": "hh:mm t"});

       //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();
 
     
 $(document).ready(function() {
    $('#dash-table').DataTable({
                responsive: true ,
                  "sort": false
        });
 
    });
 
  function capitalize(textboxid, str) {
      // string with alteast one character
      // if (str && str.length >= 1)
      // {       
      //     var firstChar = str.charAt(0);
      //     var remainingStr = str.slice(1);
      //     str = firstChar.toUpperCase() + remainingStr;
      // }
    
      document.getElementById(textboxid).value =  str.toUpperCase();
  }


  $("#search_attendance").on("click", function(){

    var attenddate = $(".date_pickerfrom").val();
    var employeestatus = $(".EmployeeStatus	").val();
    var attendance = $(".Attendance").val();

    if(attenddate==''){
        // alert('Please enter the dates');
         $("#error_msg").hide();
         $("#error_msg").css({ 
            "background" :"red",
            "color"      : "#fff",
        });
        $("#error_msg").fadeIn("slow");
        $("#error_msg").html('Please enter the dates');

        return false;
    }
    if(employeestatus==''){
        // alert('Please enter the dates');
         $("#error_msg").hide();
         $("#error_msg").css({ 
            "background" :"red",
            "color"      : "#fff",
        });
        $("#error_msg").fadeIn("slow");
        $("#error_msg").html('Please select Position Level');

        return false;
    }
    if(attendance==''){
        // alert('Please enter the dates');
         $("#error_msg").hide();
         $("#error_msg").css({ 
            "background" :"red",
            "color"      : "#fff",
        });
        $("#error_msg").fadeIn("slow");
        $("#error_msg").html('Please select Position');

        return false;
    }
  })

 
$('.date_pickerfrom').datetimepicker({
  format: 'mm/dd/yyyy',
   startDate : '01/01/2000', 
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1, 
    startView: 2,
    minView: 2,
    forceParse: 0 

    });


$('.date_pickerto').datetimepicker({
  format: 'mm/dd/yyyy',
   startDate : '01/01/2000', 
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1, 
    startView: 2,
    minView: 2,
    forceParse: 0   

    });
 
 
$('#date_picker').datetimepicker({
  format: 'mm/dd/yyyy',
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0,
     changeMonth: true,
      changeYear: true,
      yearRange: '1945:'+(new Date).getFullYear() 
    });

</script>  
   
<script type="text/javascript" > 

$(document).on("click", ".save",function(){

    var pass1 = document.getElementById("U_PASS").value;
    var pass2 = document.getElementById("RU_PASS").value;
    var name  = document.getElementById("U_NAME").value;
    var username = document.getElementById("U_USERNAME").value;

    if (name=='') {
          $("#errormsg_uname").hide();
         $("#errormsg_uname").css({ 
            "background" :"red",
            "color"      : "#fff"
        });
        $("#errormsg_uname").fadeIn("slow");
        $("#errormsg_uname").html("This field is required"); 
        $("#U_NAME").focus();
       return false;
    }else{
          $("#errormsg_uname").hide();
    }

    if (username=='') {
          $("#errormsg_username").hide();
         $("#errormsg_username").css({ 
            "background" :"red",
            "color"      : "#fff"
        });
        $("#errormsg_username").fadeIn("slow");
        $("#errormsg_username").html("This field is required"); 
        $("#U_USERNAME").focus();
       return false;
    }else{
          $("#errormsg_username").hide();
    }
    if (pass1=='') {
          $("#errormsg_pass1").hide();
         $("#errormsg_pass1").css({ 
            "background" :"red",
            "color"      : "#fff"
        });
        $("#errormsg_pass1").fadeIn("slow");
        $("#errormsg_pass1").html("This field is required"); 
        $("#U_PASS").focus();
       return false;
    }else{
          $("#errormsg_pass1").hide();
    }
    if (pass2=='') {
         $("#errormsg_pass2").css({ 
            "background" :"red",
            "color"      : "#fff"
        });
        $("#errormsg_pass2").fadeIn("slow");
        $("#errormsg_pass2").html("This field is required"); 
        $("#RU_PASS").focus();
       return false;
    }else{
          $("#errormsg_pass2").hide();
    }

    if (pass1 != pass2) {
       $("#errormsg_pass2").css({ 
            "background" :"red",
            "color"      : "#fff"
        });
        $("#errormsg_pass2").fadeIn("slow");
        $("#errormsg_pass2").html("Password does not match"); 
        $("#RU_PASS").focus();
       return false;
    } 

});
  

// $(document).on("click", ".studsave", function () {
//  /* load all variables */
   
//     var employeeid =  document.getElementById('EmployeeID').value 
   
//     // $("#checkid_message").hide();

//    // alert(positionid);
//      $.ajax({    //create an ajax request to load_page.php
//         type:"POST",  
//         url: "controller.php?action=checkid",    
//         dataType: "text",   //expect html to be returned  
//         data:{check:'', IDNO:employeeid},               
//         success: function(data){                    
//          $('#checkid_message').html(data); 
           
//            if (data=='Employee ID already in use!') {
//             return false;
//            }else{
//             return true;
//            }

//         }

//     }); 
  
// }); 


$("#gosearch").click(function() {
    var instructor = document.getElementById("INST_ID").value;
    if (instructor == 'Select') {
        alert("Pls. Select Instructor.");
        return false;
    }else{
        return true;
    };
})
</script> 
</body>
</html>