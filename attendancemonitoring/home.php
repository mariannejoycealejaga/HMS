<style type="text/css">

/*.bg{

  background:url(../images/bg/home_bg.png) no-repeat;
}
*/
.ssgmenu  > li > a {

  font-size: 25px;
  /*font-weight: bold;*/
  padding: 15px;
  color: #000;

} 
.ssgmenu > li > a:hover,
.ssgmenu > li > a:focus{
  background: #47c9af;
  color: #fff;
} 
 
.motto p {
  font-size: 32px;
  /*font-weight: bold;*/
  margin-top: 5%;
  line-height: 40px;

}
.motto{
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 1);
  color: #000;
  font-size:16px;
    
}
.timeh1{
   text-shadow: 1px 1px 4px rgba(0, 0, 0, 1);
  color: #000;
 
}
.span10 img {
  width: 100%;
  height: 60%;
}
</style>  
  <section id="feature" class="transparent-bg"   >
        <div class="container bg">
          <div class="row">
            <div class="center wow fadeInDown "> 
            <ul class="nav navbar-nav ssgmenu motto" id="footer_nav"> 
                <li ><a href="attendance/check_attendance.php" target="_blank"><i class="icon-info-sign"></i>CHECK ATTENDANCE</a></li>      
            </ul> 
            </div> 
          </div>
            <div class="row">
                <div class="features">
                  <!--   <div class="col-lg-2"></div>
                    <div class="col-lg-8"> -->
                        <div class="col-lg-6">
                          <div class="title_index">

                                <div class="row-fluid">
                                  <div class="span12"></div>
                                      <div class="row-fluid">
                                        <div class="span10">
                                        <img class="index_logo" src="images/hospitalmanagementsystem.png">
                                        </div>             
                                      </div>                    
                                </div>  
                              <?php //include('title_index.php'); ?>
                          </div>
                        </div>
                        <div class="col-lg-6">

                                        <div class="col-md-12">
                                          <div class="motto">
                                           <p> 
                                              RFID Based <br>Employees Gate Pass 
                                           </p>                     
                                          </div>                      
                                        </div>   
                         <div class="row-fluid">
                          <div class="col-md-12 "> 
                            <br>
                          <span id="tick2" class="timeh1" style="font-size:25px; color: red;">
                          </span>  
                          <br>
                          <?php
                            $date = new DateTime();
                            echo $date->format('l, F jS, Y'); 
                          ?> 
                         
                          </div>
                        </div>  
                      </div>
                        <!-- <img class="img-responsive img-blog" src="img/ssgback.png" style="width:100%; height:400px"   alt="" /> -->
                   <!--  </div>
                    <div class="col-lg-2"></div>  -->
                </div><!--/.services-->
            </div><!--/.row-->  
        </div><!--/.container-->
    </section><!--/#feature--> 


    <script>
// <!--/. tells about the time  -->
function show2(){
if (!document.all&&!document.getElementById)
return
thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
var ctime=hours+":"+minutes+":"+seconds+" "+dn
thelement.innerHTML=ctime
setTimeout("show2()",1000)
}
window.onload=show2
//-->

</script>   