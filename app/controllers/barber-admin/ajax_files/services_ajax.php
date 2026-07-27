<?php include '../../../models/barber-admin/connect.php'; ?>
<?php include '../../../config/Includes/functions/functions.php'; ?>


<?php
	

	if(isset($_POST['do']) && $_POST['do'] == "Delete")
	{
		$service_id = $_POST['service_id'];

        $stmt = $con->prepare("DELETE from services where service_id = ?");
        $stmt->execute(array($service_id));    
	}
	
?>