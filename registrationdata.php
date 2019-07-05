<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

include 'connection.php';

 $MobileNum = $_POST['mobilenumber'];
 
 $Password = $_POST['password'];
 
 //$Password = password_hash($Password, PASSWORD_DEFAULT);
 
 $Full_Name = $_POST['name'];

 $Gender = $_POST['gender'];
 
 $City = $_POST['address'];
 
 $Status = "OK";
 
$CheckSQL = mysqli_query($con,"SELECT * FROM register WHERE MobileNumber='$MobileNum'");
 
 if(mysqli_fetch_array($CheckSQL)){

 //echo 'Mobile Number Already Exist, Please Enter Another Mobile.';

	$response['error'] = false; 
	$response['message'] = 'Mobile Number Already Exist, Please Enter Another Mobile.';
	//$response['user'] = $user;
    echo json_encode($response);
 }
else{  
 $Sql_Query = "INSERT INTO register (Name,MobileNumber,Gender,Address,Password,Status) Values('$Full_Name','$MobileNum','$Gender','$City','$Password','$Status')";

 if(mysqli_query($con,$Sql_Query))
{
    $getSQL=mysqli_query($con,"SELECT * FROM register WHERE MobileNumber='$MobileNum'");
        

    if(mysqli_num_rows($getSQL)>0)
    {
        $row=mysqli_fetch_assoc($getSQL);
    
    
    $user = array(
        'id'=>$row['id'],
        'name'=>$row['Name'],
        'mobilenumber'=>$row['MobileNumber'],
        'gender'=>$row['Gender'],
        'address'=>$row['Address'],
        'password'=>$row['Password']
        );
    
    
	$response['error'] = false; 
	$response['message'] = 'Registration successfull';
	$response['user'] = $user;
    echo json_encode($response);

    
}
}
else
{
 $response['error'] = false; 
	$response['message'] = 'Mobile Number Rr Password Did Not Match';
	//$response['user'] = $user;
    echo json_encode($response);

 }
 }
}
?>
