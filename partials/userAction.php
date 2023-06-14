<?php 
session_start(); 
  
require_once 'Json.class.php'; 
$db = new Json(); 
  
$redirectURL = 'main.php'; 
 
if(isset($_POST['userSubmit'])){  
    $id = $_POST['id']; 
    $name = trim(strip_tags($_POST['name'])); 
    $username = trim(strip_tags($_POST['username'])); 
    $email = trim(strip_tags($_POST['email'])); 
    $street = trim(strip_tags($_POST['street']));  
    $city = trim(strip_tags($_POST['city']));  
    $zipcode = trim(strip_tags($_POST['zipcode']));  
    $lat = trim(strip_tags($_POST['lat']));  
    $lng = trim(strip_tags($_POST['lng']));  
    $phone = trim(strip_tags($_POST['phone']));  
    $website = trim(strip_tags($_POST['website']));  
    $catchPhrase = trim(strip_tags($_POST['catchPhrase']));  
    $bs = trim(strip_tags($_POST['bs']));   
     
    $id_str = ''; 
    if(!empty($id)){ 
        $id_str = '?id='.$id; 
    } 
      
    $errorMsg = ''; 
    if(empty($name)){ 
        $errorMsg .= '<p>Please, enter name.</p>'; 
    } 
    if(empty($username)){ 
        $errorMsg .= '<p>Please, enter username.</p>'; 
    } 
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){ 
        $errorMsg .= '<p>Please, enter a valid email.</p>'; 
    }  
    if(empty($street)){ 
        $errorMsg .= '<p>Please, enter street.</p>'; 
    } 
    if(empty($city)){ 
        $errorMsg .= '<p>Please, enter city.</p>'; 
    } 
    if(empty($zipcode)){ 
        $errorMsg .= '<p>Please, enter zipcode.</p>'; 
    } 
    
    
    $userData = array();
    $userData['name'] = $name;
    $userData['username'] = $username;
    $userData['email'] = $email;
    $userData['address']['street'] = $street;
    $userData['address']['city'] = $city;
    $userData['address']['zipcode'] = $zipcode;
    $userData['address']['geo']['lat'] = $lat;
    $userData['address']['geo']['lng'] = $lng;
    $userData['phone'] = $phone;
    $userData['website'] = $website;
    $userData['company']['name'] = $companyname;
    $userData['company']['catchPhrase'] = $catchPhrase;
    $userData['company']['bs'] = $bs;

      
    $sessData['userData'] = $userData;  
    if(empty($errorMsg)){ 
        if(!empty($_POST['id'])){  
            $update = $db->update($userData, $_POST['id']); 
             
            if($update){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'Member data has been updated successfully.'; 
                  
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                  
                $redirectURL = 'addEdit.php'.$id_str; 
            } 
        }else{  
            $insert = $db->insert($userData); 
             
            if($insert){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'Member data has been added successfully.';  
                unset($sessData['userData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurred, please try again.';  
                $redirectURL = 'addEdit.php'.$id_str; 
            } 
        } 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg;  
        $redirectURL = 'addEdit.php'.$id_str; 
    } 
      
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){  
    $delete = $db->delete($_GET['id']); 
     
    if($delete){ 
        $sessData['status']['type'] = 'success'; 
        $sessData['status']['msg'] = 'Member data has been deleted successfully.'; 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
    } 
      
    $_SESSION['sessData'] = $sessData; 
} 
  
header("Location:".$redirectURL); 
exit(); 
?>