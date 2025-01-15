<div>
    <h4> <?php  echo $data['name']//name?></h4>
    <p><?php echo $data['email']//email?></p>
    <p><?php echo $data['date']//date?></p>
    <p><?php echo $data['comment']//comment?></p>

    <?php
    unset($datas);
    $datas = mysqli_query($conn,"SELECT * FROM tb_data")
    
    ?>

</div>