<?php 
                       if (!isset($_SESSION['ACCOUNT_ID'])){
                          redirect(web_root."index.php");
                         }

                      // $autonum = New Autonumber();
                      // $res = $autonum->single_autonumber(2);

                       ?> 
<section id="feature" class="transparent-bg">
        <div class="container">
           <div class="center wow fadeInDown">
                 <h2 class="page-header">Add New Position</h2>
                <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p> -->
            </div>
               
            <div class="row">
                <div class="features">
 
                 <form class="form-horizontal span6 wow fadeInDown" action="controller.php?action=add" method="POST"> 
                           
                           <div class="form-group">
                            <div class="col-md-8">
                              <label class="col-md-4 control-label" for=
                              "POSITION_NAME">Position:</label>

                              <div class="col-md-8">
                                <input name="deptid" type="hidden" value="">
                                 <input class="form-control input-sm" id="POSITION_NAME" name="POSITION_NAME" placeholder=
                                    "Position Code" type="text" value=""  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                              </div>
                            </div>
                          </div> 

                          <div class="form-group">
                            <div class="col-md-8">
                              <label class="col-md-4 control-label" for=
                              "POSITION_DESC">Description:</label>

                              <div class="col-md-8">
                                <input name="deptid" type="hidden" value="">
                                 <input class="form-control input-sm" id="POSITION_DESC" name=POSITION_DESC" placeholder=
                                    "Position Description" type="text" value="" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-md-8">
                              <label class="col-md-4 control-label" for=
                              "DEPT_ID">Department:</label>

                              <div class="col-md-8">
                               <select class="form-control input-sm" name="DEPT_ID" id="DEPT_ID">
                               <option value="none" >Select</option>
                                  <?php 

                                    $mydb->setQuery("SELECT * FROM `department`");
                                    $cur = $mydb->loadResultList();

                                    foreach ($cur as $result) {
                                      echo '<option value='.$result->departmentid.' >'.$result->departmentname.' [ '.$result->description .' ]</option>';

                                    }
                                  ?>


                                 
                                </select> 
                              </div>
                            </div>
                          </div>


                    
                     <div class="form-group">
                            <div class="col-md-8">
                              <label class="col-md-4 control-label" for=
                              "idno"></label>

                              <div class="col-md-8">
                               <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span>  Save</button> 
                                  <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span></span>&nbsp;<strong>List of Users</strong></a> -->
                               </div>
                            </div>
                          </div>


                  
                </form>

       
                
                </div><!--/.services-->
            </div><!--/.row-->  
        </div><!--/.container-->
    </section><!--/#feature-->
 
 