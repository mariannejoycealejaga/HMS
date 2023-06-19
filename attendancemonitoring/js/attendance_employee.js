$(document).on('keypress',".EmployeeID", function(){



var Digital=new Date()
var T_hours=Digital.getHours()
var T_minutes=Digital.getMinutes() 
var timeObject;


var employeeID = document.getElementById('EmployeeID').value;  
 


 // if () {};
  // alert(evnts);

 


 //
 if ($("#EmployeeID").val().length>9){

    // evnts  = $('.attendevents').val();
    timeObject = T_hours + ':' + T_minutes;
    
  $.ajax({    //create an ajax request to load_page.php
        type:"POST",
        url: "loaddetails.php",             
        dataType: "text",   //expect html to be returned  
        data:{IDNO:employeeID,stringtime:timeObject,checkattendance:''},               
        success: function(data){    
        $("#check_attendance").html(data); 
        // alert(data)
        }
        

    });


  $.ajax({    //create an ajax request to load_page.php
        type:"POST",
        url: "loaddetails.php",             
        dataType: "text",   //expect html to be returned  
        data:{IDNO:employeeID,name:''},               
        success: function(data){    
           $("#name").html(data); 
        }


    });


  $.ajax({    //create an ajax request to load_page.php
        type:"POST",
        url: "loaddetails.php",             
        dataType: "text",   //expect html to be returned  
        data:{IDNO:employeeID,position:''},               
        success: function(data){    
           $("#position").html(data); 
        }

    });

  $.ajax({    //create an ajax request to load_page.php
        type:"POST",
        url: "loaddetails.php",             
        dataType: "text",   //expect html to be returned  
        data:{IDNO:employeeID,year:''},               
        success: function(data){    
           $("#year").html(data); 
        }

    });

    $.ajax({    //create an ajax request to load_page.php
        type:"POST",
        url: "loaddetails.php",             
        dataType: "text",   //expect html to be returned  
        data:{IDNO:employeeID,img:''},               
        success: function(data){    

          // alert(data);
           $("#img_profile").html(data); 
        }

    });



$("#EmployeeID").val('');
$("$EmployeeID").focus();


 }

});

 