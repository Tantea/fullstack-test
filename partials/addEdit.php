<?php  
session_start(); 
  
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
  
$memberData = $userData = array(); 
if(!empty($_GET['id'])){   
    include 'Json.class.php'; 
    $db = new Json();  
    $memberData = $db->getSingle($_GET['id']); 
} 
$userData = !empty($sessData['userData'])?$sessData['userData']:$memberData; 
unset($_SESSION['sessData']['userData']); 
 
$actionLabel = !empty($_GET['id'])?'Edit':'Add'; 
  
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
?>
 
<link rel="stylesheet" href="../assets/css/styles.css"> 
<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
<div class="col-xs-12">
    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
</div>
<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
<div class="col-xs-12">
    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="header">
        <h1>New user</h1> 
        <a class="standart-button" href="../" class="btn btn-success"><i class="plus"></i>Back</a>  
    </div> 
        <div class="content">  
                    <form method="post" action="userAction.php">
                        <div class="form-wrapper">
                            <label>Personal Info</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo !empty($userData['name'])?$userData['name']:''; ?>" required="">
                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo !empty($userData['username'])?$userData['username']:''; ?>" required="">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo !empty($userData['email'])?$userData['email']:''; ?>" required="">
                            <input type="phone" class="form-control" name="phone" placeholder="Phone" value="<?php echo !empty($userData['phone'])?$userData['phone']:''; ?>">
                            <input type="text" class="form-control" name="website" placeholder="Website" value="<?php echo !empty($userData['website'])?$userData['website']:''; ?>">
                        </div>  
                        <div class="form-wrapper">
                            <label>Address Info</label> 
                            <input type="text" class="form-control" name="street" placeholder="Street" value="<?php echo !empty($userData['street'])?$userData['street']:''; ?>" required="">
                            <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo !empty($userData['city'])?$userData['city']:''; ?>" required="">
                            <input type="number" class="form-control" name="zipcode" placeholder="Zipcode" value="<?php echo !empty($userData['zipcode'])?$userData['zipcode']:''; ?>" required="">
                            <input type="number" class="form-control" name="lat" placeholder="Lat" value="<?php echo !empty($userData['lat'])?$userData['lat']:''; ?>" >
                            <input type="number" class="form-control" name="lng" placeholder="Lng" value="<?php echo !empty($userData['lng'])?$userData['lng']:''; ?>">
                        </div>    
                        <div class="form-wrapper">
                            <label>Company Info</label> 
                            <input type="text" class="form-control" name="companyname" placeholder="Company Name" value="<?php echo !empty($userData['companyname'])?$userData['companyname']:''; ?>">
                            <input type="text" class="form-control" name="catchPhrase" placeholder="CatchPhrase" value="<?php echo !empty($userData['catchPhrase'])?$userData['catchPhrase']:''; ?>">
                            <input type="text" class="form-control" name="bs" placeholder="Bs" value="<?php echo !empty($userData['bs'])?$userData['bs']:''; ?>">
                        </div>      
                        <div class="form-wrapper"> 
                            <input type="hidden" name="id" value="<?php echo !empty($memberData['id'])?$memberData['id']:''; ?>">
                            <input type="submit" name="userSubmit"  class="standart-button" value="Submit">
                        </div>     
                        
                    </form>
    </div>  
    
<div class="footer">
      <a href="https://profile.indeed.com/p/tatianad-0mxxq3c" target="_blank">Tantea</a>
      <div>Warsaw, Poland | 2023</div>
</div> 