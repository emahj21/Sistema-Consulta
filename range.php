
<?php
  require_once('conexion.php');
  if(ISSET($_POST['search'])){
    $date1 = date("Y-m-d", strtotime($_POST['inicio']));
    $date2 = date("Y-m-d", strtotime($_POST['fin']));
    $query=mysqli_query($conn, "SELECT * FROM `member` WHERE `date_submit` BETWEEN '$date1' AND '$date2'") ;
    $row=mysqli_num_rows($query);
    if($row>0){
      while($fetch=mysqli_fetch_array($query)){
?>
  <tr>
    <td><?php echo $fetch['firstname']?></td>
    <td><?php echo $fetch['lastname']?></td>
    <td><?php echo $fetch['project']?></td>
    <td><?php echo $fetch['date_submit']?></td>
  </tr>
<?php
      }
    }else{
      echo'
      <tr>
        <td colspan = "4"><center>Registros no Existen</center></td>
      </tr>';
    }
  }else{
    $query=mysqli_query($conn, "SELECT * FROM `pruebafechas`") ;
    while($fetch=mysqli_fetch_array($query)){
?>
  <tr>
    <td><?php echo $fetch['firstname']?></td>
    <td><?php echo $fetch['lastname']?></td>
    <td><?php echo $fetch['project']?></td>
    <td><?php echo $fetch['date_submit']?></td>
  </tr>
<?php
    }
  }
?>