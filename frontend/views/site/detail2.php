<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>


    <?php foreach ($q1 as $l1) ?>

  <div class="row">
      <div class="container container-fluid">
    <div class="col-md-2">
        
            <h5> <?php echo 'BP '.$l1['bps'].' / '.$l1['bpd']; ?></h5>
            
        
    </div>
          <div class="col-md-2">
        
            <h5> <?php echo 'Temp. '.$l1['tem']; ?></h5>
          </div>
            <div class="col-md-2">
            <h5><?php echo ' น้ำหนัก '.$l1['bw']; ?></h5>
         
    </div>
          <div class="col-md-3">
              <div class="container">
             <h5><?php echo ' CC :: '.$l1['cc']; ?></h5>
              </div></div>
  </div>
  </div>
  

<div class="row">
    <div class="col-md-6">
      
            <table class="table table-bordered">
                <tr>
                    <th class="success">
                <center>รายชื่อยา</center>
                </th>
                <th class="success" >
                <center>จำนวนสั่ง</center>
                </th>
                <th class="success" >
                <center>ราคารวม</center>
                </th>
                </tr>
                              <!--End Header-->

                <?php
                foreach ($q2 as $l2) {
                    ?>

                    <tr>
                        <td class="">
    <?php echo $l2['dname']; ?>
                        </td>
                        <td class="">
                    <center><?php echo $l2['qty']; ?></center>

                    </td>
                    <td class="">
                    <center><?php echo $l2['sum']; ?></center>
                    </td>
                    </tr>
                    <?php
                }
                ?>



            </table>
       
    </div>
<!--    ตาราง diag-->
    <div class="col-md-6">
         <table class="table table-bordered">
                <tr>
                    <th class="info">
                <center>ICD 10</center>
                </th>
                <th class="info" >
                <center>Name</center>
                </th>
                <th class="info" >
                <center>Diag Type</center>
                </th>
                </tr>
                              <!--End Header-->

                <?php
                foreach ($q3 as $l3) {
                    ?>

                    <tr>
                        <td class="">
    <?php echo $l3['dcode']; ?>
                        </td>
                        <td class="">
                    <center><?php echo $l3['dname']; ?></center>

                    </td>
                    <td class="">
                    <center><?php echo $l3['dtype']; ?></center>
                    </td>
                    </tr>
                    <?php
                }
                ?>



            </table>
    </div>
</div>
