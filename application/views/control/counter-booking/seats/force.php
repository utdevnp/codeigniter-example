         

             <div class="col-md-7 bus-seats">
                <div class="bus-seatss">
                <div id="multiselect"> 
               
                <div class="cabin-total col-md-1" style="padding: 0px;" >
                <div class="tot-cabin" style="margin-bottom: 9px;">
                 <img src="<?php echo base_url('uploads/seats/stering.jpg');?>" height="40 " width="40px" />
                  </div>
                 <div class="cabin-seat">
                 <?php  
                      $i=1;   
                      while($i<=2){  ?>
                        <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside = sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="C"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="C"){ if($resv[1]==$i){ echo "disconnect";}}}}?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="C<?php echo $i;?>"><span class="seat-no"><?php if(@$student[2] =="C" AND @$student[1]==$i){echo 'SC';} else if(@$female[2] =="C" AND @$female[1]==$i){echo 'FC';} else if(@$old[2] =="C" AND @$old[1]==$i){echo 'OC';} else if(@$staff[2] =="C" AND @$staff[1]==$i){echo 'St';} else echo 'C';?><?php echo $i;?></span></div>
                         <div class="clearfix"></div> 
                          <?php $i = $i+1; 
                      } ?>
                    

                 </div>

                </div>
                <!-- <div id="multiselect">  -->  
                <div class="last-martin col-md-<?php if($rowb > $rowa){echo  $rowa+1;} else echo $rowa ;?>" style="padding-bottom: 0px;">
                 <!-- Special Even Side Seats  -->
                    
                      <!-- B Side Even seats  -->
                    <?php  
                      $i=2;   
                      while($i<=$forceseats[2]){  ?>
                        <div  class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="B"){ if($resv[1]==$i){ echo "disconnect";}}}}?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                        <span class="seat-no"><?php if(@$student[2] =="B" AND @$student[1]==$i){echo 'SB';} else if(@$female[2] =="B" AND @$female[1]==$i){echo 'FB';} else if(@$old[2] =="B" AND @$old[1]==$i){echo 'OB';} else if(@$staff[2] =="B" AND @$staff[1]==$i){echo 'St';} else echo 'B';?><?php echo $i;?></span>
                        </div>
                          <?php $i = $i+2; 
                      } ?>
                      <div class="clearfix"></div>

                       <!-- Special Odd side seat -->
                        
                      <!-- B Side Odd Seats -->
                    <?php
                      $i=1;
                      while($i<=$forceseats[2]){ ?>
                        <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="B"){  if($myside[1]%2==1 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="B"){ if($resv[1]==$i){ echo "disconnect";}}}}?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="B<?php echo $i;?>">
                        <span class="seat-no"><?php if(@$student[2] =="B" AND @$student[0]==$i){echo 'SB';} else if(@$female[2] =="B" AND @$female[0]==$i){echo 'FB';} else if(@$old[2] =="B" AND @$old[0]==$i){echo 'OB';} else if(@$staff[2] =="B" AND @$staff[0]==$i){echo 'St';} else echo 'B';?><?php echo $i;?></span>
                        </div><?php 
                        $i = $i+2;
                      }
                    ?>
                   
                   <div class="clearfix"></div>
                   <br>
                   <div class="clearfix" style="height: 12px;"></div>
                    <?php  if($rowb > $rowa OR $rowb == $rowa AND $total_special > 0 OR $rowb > $rowa){ ?>
                    <div class="col-md-1" style="width: 47px;"></div> 
                    <?php } ?>
                    
                    <div class="aside-seats">
                   <?php 
                    $i=2;
                      while($i<=$forceseats[1]){ ?>
                        <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="A"){  if($myside[1]%2==0 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="A"){ if($resv[1]==$i){ echo "disconnect";}}}}?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="A<?php echo $i;?>"><span class="seat-no"><?php if(@$student[2] =="A" AND @$student[1]==$i){echo 'SA';} else if(@$female[2] =="A" AND @$female[1]==$i){echo 'FA';} else if(@$old[2] =="A" AND @$old[1]==$i){echo 'OA';} else if(@$staff[2] =="A" AND @$staff[1]==$i){echo 'St';} else echo 'A';?><?php echo $i;?></span></div>
                        <?php $i = $i+2;
                      }
                    ?>
                    <div class="clearfix"></div>
                    <?php if($rowb > $rowa OR $rowb == $rowa AND $total_special > 0 OR $rowb > $rowa){ ?>
                    <div class="col-md-1" style="width: 47px;"></div> 
                    <?php } ?>
                    

                    <?php
                      $i=1;
                       while($i<=$forceseats[1]){ ?>
                        <div class="select col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d");  if($myside[0]=="A"){  if($myside[1]%2==1 AND $myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="A"){ if($resv[1]==$i){ echo "disconnect";}}}}?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="A<?php echo $i;?>"><span class="seat-no"><?php if(@$student[2] =="A" AND @$student[0]==$i){echo 'SA';} else if(@$female[2] =="A" AND @$female[0]==$i){echo 'FA';} else if(@$old[2] =="A" AND @$old[0]==$i){echo 'OA';} else if(@$staff[2] =="A" AND @$staff[0]==$i){echo 'St';} else echo 'A';?><?php echo $i;?></span></div>
                        <?php $i = $i+2;
                      }
                    ?>
                    </div>
                   <!--  <div class="clearfix"></div> -->
                  </div>
                   <div class="last-row col-md-1">
                  <?php
                      $i=1;
                      if($last!==""){
                       while($i<=$forceseats[3]){ ?>
                      
                        <div class="select pull-left col-md-1 <?php if($bookedseat!==""){ for($m=0;$m<$all;$m++){ $myside =  sscanf($bookedseat[$m], "%[A-Z]%d"); if($myside[0]=="L"){  if($myside[1]==$i){ echo "disconnect";} }}} if(@$reservetot>0){for($n=0;$n<$reservetot;$n++){$resv = sscanf(@$expres[$n], "%[A-Z]%d"); if($resv[0]=="L"){ if($resv[1]==$i){ echo "disconnect";}}}}?>" price="<?php echo $price;?>" title="<?php echo $everybus;?>" id="L<?php echo $i;?>"><span class="seat-no">L<?php echo $i;?></span></div>
                        <div class="clearfix"></div>
                        
                        <?php $i = $i+1;
                      }}
                    ?>
                    </div>
                </div>
                </div>
              </div>