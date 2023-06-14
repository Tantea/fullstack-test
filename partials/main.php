 
    <?php  
session_start(); 
  
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';  
require_once 'Json.class.php'; 
$db = new Json(); 
  
$members = $db->getRows(); 
  
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
?>
     <link rel="stylesheet" href="../assets/css/styles.css"> 

     <div class="header">
        <h1>Users</h1>  
        <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?> 
            <div class="alert alert-success"><?php echo $statusMsg; ?></div> 
        <?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?> 
            <div class="alert alert-danger"><?php echo $statusMsg; ?></div> 
        <?php } ?>
        <a class="standart-button" href="addEdit.php" class="btn btn-success"><i class="plus"></i>New User</a>  
    </div> 
        <div class="content">  
                <div class="row">
                    <div>name</div>
                    <div>username</div>
                    <div>email</div>
                    <div>address</div>
                    <div>phone</div>
                    <div>website</div>
                    <div>company</div> 
                    <div>actions</div> 
                </div>
                <?php if(!empty($members)){ $count = 0; foreach($members as $row){ $count++; ?>  
                <div class="row">
                    <div><?php if(isset($row['name'])) {echo $row['name'];} ?></div> 
                    <div><?php if(isset($row['username'])) {echo $row['username'];} ?></div> 
                    <div><?php if(isset($row['email'])) {echo "<a href='mailto:$row[email]'>$row[email]</a>";}?></div> 
                    <div>
                        <div>
                            <?php if(isset($row['address']['street'])) {echo $row['address']['street'];} ?>
                            <?php if(isset($row['address']['suite'])) {echo $row['address']['suite'];} ?>
                            <?php if(isset($row['address']['city'])) {echo $row['address']['city'];} ?>
                            <?php if(isset($row['address']['zipcode'])) {echo $row['address']['zipcode'];} ?>
                        </div> 
                        <div>
                            <?php if(isset($row['address']['geo']['lat'])) {echo $row['address']['geo']['lat'];} ?>
                            <?php if(isset($row['address']['geo']['lng'])) {echo $row['address']['geo']['lng'];} ?>
                        </div> 
                    </div> 
                    <div><?php if(isset($row['phone'])) {echo "<a href='tel:$row[phone]' target='_blank'>$row[phone]</a>";} ?></div> 
                    <div><?php if(isset($row['website'])) {echo "<a href='http://$row[website]' target='_blank'>$row[website]</a>";} ?></div> 
                    <div>
                        <div><?php if(isset($row['company']['name'])) {echo $row['company']['name'];} ?></div> 
                        <div><?php if(isset($row['company']['catchPhrase'])) {echo $row['company']['catchPhrase'];} ?></div> 
                        <div><?php if(isset($row['company']['bs'])) {echo $row['company']['bs'];} ?></div>  
                    </div>
                    <div>
                        <a href="userAction.php?action_type=delete&id=<?php echo $row['id']; ?>" class="remove-button" onclick="return confirm('Are you sure to delete?');">Remove</a>
                    </div>
                </div>


                <?php } }else{ ?>
                <div>No member(s) found...</div>
                <?php } ?>  
    </div>  
    
    <div class="footer">
        <a href="https://profile.indeed.com/p/tatianad-0mxxq3c" target="_blank">Tantea</a>
        <div>Warsaw, Poland | 2023</div>
    </div> 