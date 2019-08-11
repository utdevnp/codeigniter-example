

 <div class="bus-seatss">
                <div id="multiselect"> 
                <div class="cabin-total col-md-<?php if($tot_cabin == ""){ echo 1;} else if($tot_cabin > 1){ echo $tot_cabin; } else echo 2;?>" style="padding: 0px;" >
                <div class="tot-cabin-hice" style="margin-bottom: 2px;">
                 <img src="<?php echo base_url('uploads/seats/stering.jpg');?>" height="40 " width="40px" />
                  </div>
                 <div class="cabin-seat-hice">
                 <?php  
                      $i=1;   
                      while($i<=2){  ?>
                        <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="F"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="F<?php echo $i;?>"><span class="seat-no"><?php  echo 'F';?><?php echo $i;?></span></div>
                          <?php $i = $i+1; 
                      } ?>
                 </div>

                </div>
                <!-- <div id="multiselect">  -->  
                 <!-- Special Even Side Seats  -->
                 <div class="col-md-1">
                    <?php  
                      $i=1;   
                      while($i<=4){  ?>
                        <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="A"){  if($myside[1]==$i){ echo "disconnect";} }}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="A<?php echo $i;?>">
                        <span class="seat-no"><?php  echo 'A';?><?php echo $i;?></span>
                        </div>
                         <div class="clearfix"></div>
                          <?php $i = $i+1; 
                      } ?>
                     </div>
                      <!-- B Side Even seats  -->
                    <div class="col-md-1">
                        <?php  
                          $i=1;   
                          while($i<=4){  ?>
                            <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]==$i){ echo "disconnect";} }}} ?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                            <span class="seat-no"><?php  echo 'B';?><?php echo $i;?></span>
                            </div>
                             
                              <?php $i = $i+1; 
                          } ?>
                           
                     </div>
                       <!-- Special Odd side seat -->

                    
                   
                   <!--  <div class="clearfix"></div> -->
                    
                 <!--  </div> -->
                  
                </div>
                </div>