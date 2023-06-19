<?php  
     if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."index.php");
     }

  @$POSITION_ID = $_GET['id'];
    if($POSITION_ID==''){
  redirect("index.php");
}
  $position = New Position();
  $singleposition = $position->single_position($POSITION_ID);

?> 

<section id="feature" class="transparent-bg">
        <div class="container">
           <div class="center wow fadeInDown">
                 <h2 class="page-header">Update Position</h2>
                <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p> -->
            </div>
               
            <div class="row">
                <div class="features">
 
 
                           <form class="form-horizontal span6 wow fadeInDown" action="controller.php?action=edit" method="POST"> 
                                   <input class="form-control input-sm" id="POSITION_ID" name="POSITION_ID" placeholder=
                                      "Account Id" type="Hidden" value="<?php echo $singleposition->PositionID; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                              
                              <div class="form-group">
                              <div class="col-md-8">
                                <label class="col-md-4 control-label" for=
                                "POSITION_NAME">Position:</label>

                                <div class="col-md-8">
                                  
                                   <input class="form-control input-sm" id="POSITION_NAME" name="POSITION_NAME" placeholder=
                                      "Position" type="text" value="<?php echo $singleposition->PositionCode; ?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                                </div>
                              </div>
                            </div> 

                            <div class="form-group">
                              <div class="col-md-8">
                                <label class="col-md-4 control-label" for=
                                "POSITION_DESC">Description:</label>

                                <div class="col-md-8">
                                  
                                   <input class="form-control input-sm" id="POSITION_DESC" name="POSITION_DESC" placeholder=
                                      "Position Description" type="text" value="<?php echo $singleposition->Description; ?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                                </div>
                              </div>
                            </div>
                           

                           <div class="form-group">
                              <div class="col-md-8">
                                <label class="col-md-4 control-label" for=
                                "DEPT_ID">Department:</label>

                                <div class="col-md-8">
                                 <select class="form-control input-sm" name="DEPT_ID" id="DEPT_ID"> 
                                    <?php 

                                      $mydb->setQuery("SELECT * FROM `department` WHERE departmentid=". $singleposition->departmentid);
                                      $cur = $mydb->loadResultList();

                                      foreach ($cur as $result) {
                                        echo '<option value='.$result->departmentid.' >'.$result->departmentname.' [ '.$result->description .' ]</option>';

                                      }
                                    ?> 
                                    <?php 

                                      $mydb->setQuery("SELECT * FROM `department` WHERE departmentid!=". $singleposition->departmentid);
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
                                   <button class="btn btn-primary " name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
                                  </div>
                              </div>
                            </div>

                        
                       <div class="form-group">
                          <div class="rows">
                            <div class="col-md-6">
                              <label class="col-md-6 control-label" for=
                              "otherperson"></label>

                              <div class="col-md-6">
                             
                              </div>
                            </div>

                            <div class="col-md-6" align="right">
                             

                             </div>
                            
                        </div>
                        </div>

                    </form> 
                
                </div><!--/.services-->
            </div><!--/.row-->  
        </div><!--/.container-->
    </section><!--/#feature-->
 