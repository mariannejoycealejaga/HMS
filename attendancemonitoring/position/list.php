<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."index.php");
     }

?>

<section id="feature" class="transparent-bg">
        <div class="container">
           <div class="center wow fadeInDown">
                 <h2 class="page-header">List of Position</h2>
                <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p> -->
            </div>
               
            <div class="row">
                <div class="features">

						  <form class="wow fadeInDown" action="controller.php?action=delete" Method="POST">   
										<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:14px" cellspacing="0">
										
										  <thead>
										  	<tr> 
										  		<th>POSITION</th>  
										  		<th>DESCRIPTION</th>
										  		<th width="">DEPARTMENT</th>
										  		<th width="10%" >ACTION</th>
										 
										  	</tr>	
										  </thead>     <!-- `POSITION_NAME`, `POSITION_LEVEL`, ``, `POSITION_DESC`, `DEPT_ID` -->
						              
										  <tbody>
										  	<?php 

										  		// $mydb->setQuery("SELECT * 
														// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
										  		$mydb->setQuery("SELECT PositionID,`PositionCode`, p.`Description`,`departmentname`
																	FROM  `tblposition` p, `department` d WHERE p.departmentid=d.departmentid");
										  		$cur = $mydb->loadResultList();

												foreach ($cur as $result) {

						 
										  		echo '<tr>'; 
										  		echo '<td>' . $result->PositionCode.'</a></td>'; 
										  		echo '<td>'. $result->Description.'</td>'; 
										  		echo '<td>'. $result->departmentname.'</td>';

										  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->PositionID.'"  class="btn btn-info btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
										  					 <a title="Delete" href="controller.php?action=delete&id='.$result->PositionID.'" class="btn btn-danger btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
										  					 </td>';
										  		echo '</tr>';
										  	} 
										  	?>
										  </tbody>
											
										</table>
						 
										<div class="btn-group">
										  <a href="index.php?view=add" class="btn btn-primary"><i class="fa fa-plus-circle fw-fa"></i> New</a>
										  <!-- <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button> -->
										</div>
						 
										</form>
 
       
                
                </div><!--/.services-->
            </div><!--/.row-->  
        </div><!--/.container-->
    </section><!--/#feature-->
 
 