<?php

//PDO connection
try{
	
	//$con = new PDO('mysql:dbname=fids;host=localhost;charset=utf8', 'statisto', 'statisto@123#');
	
	//$con -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	//$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
}catch(PDOException $erry){

	//echo"<script language = 'Javascript'>location.href = 'error111.php','_self'</script>";
	//echo "Something wrong somewhere: ".$erry->getMessage();
	
	echo "Something wrong somewhere: Kindly contact the system developers.";	
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//setting a timezone for server
date_default_timezone_set('Asia/Kuala_Lumpur');


//getting the user IP address
function getIp(){
	
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	
	return $ip;
	
}



//tab icon
function getIcon(){
	echo"<link rel='shortcut icon' href='assets/images/favicon.ico' />";
}




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function fidsRoles(){
	
	global $con;
    $user = $_SESSION['UID'];
    $timestamp = time();
    $php_timestamp_date = date('y,m,d', $timestamp);
	
	
	/*retrieve pilot details from database*/

	//SQL query
	$sql = "SELECT * FROM pilot";
	
	if ( $selectsql = $con -> prepare ($sql)) // Prepare the SQL query
	{
		// Execute statement
		$selectsql -> execute();
		
		// Set fetch mode to FETCH_ASSOC to return an array indexed by column name
		$selectsql -> setFetchMode(PDO::FETCH_ASSOC);
		
		// Fetch result
		while($row = $selectsql -> fetchColumn()){
		
			$dcID = $row['pilotID'];
			$dcName = $row['pilotName'];
			$dcImage = $row['pilotPhoto'];
            $roles = $row['adminPrivilege'];			
		}	
		
	}



/*retrieve user details from database*/	

	$sql2 = "SELECT * FROM user WHERE userName='$user'";
	
	if ( $selectsql2 = $con -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
			$roles = $row['adminPrivilege'];
		}
	
	}


	
	
	/*retrieve foologin details from database*/	

	$sql2 = "SELECT * FROM foologin WHERE userName='$user'";
	
	if ( $selectsql2 = $con -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
			$roles = $row['adminPrivilege'];
		}
	
	}
	
	





/*retrieve administrator details from database*/

	$sql3 = "SELECT * FROM administrator WHERE adminID='$user'
	         JOIN base b ON (a.adminBase=b.baseID)";
	
	if ( $selectsql3 = $con -> prepare ($sql3)) 
	{
		// Bind parameters to statement variables
		//$selectsql3 -> bindParam(':id', $user);
		
		$selectsql3 -> execute();
	
		while($row = $selectsql3 -> fetch(PDO::FETCH_ASSOC)){
			
		      $ID = $row['adminID'];
			$Name = $row['adminName'];
			$Photo = $row['adminPhoto'];
            $roles = $row['adminPrivilege'];
            $admin_base = $row['adminBase'];			
		}
	}
	
}

//top-body :: display duty captain, flight count & percentage, passenger count & percentage

function fliCount(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count." Flights";
		}else{
			echo "No Flight";
		}	
	}//end if ($selectfli)
}


function fliCount2(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');
	
	if(isset($_GET['search_fli'])){
	$s_frodat = date('Y,m,d', strtotime($_GET['frodate']));
	$s_todat = date('Y,m,d', strtotime($_GET['todate']));

	$flight2 = "SELECT fsNum FROM flightschedule WHERE fsDate >= '$s_frodat' AND fsDate <= '$s_todat'";
	
	if ($selectfli = $con -> prepare ($flight2)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count." Flights Found";
		}else{
			echo "No Flight";
		}	
	}//end if ($selectfli)
	}//end if (search_fli)
}



function fliCount3(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');
	$date = date("Y-m-d", strtotime("tomorrow"));

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$date'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count." Flights";
		}else{
			echo "No Flight";
		}	
	}//end if ($selectfli)
}




function fliCount_ground(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='On Ground'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}

function fliCount_refuelling(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='Refuelling'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}

function fliCount_ready(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='Ready to Dispatch'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}

function fliCount_turnaround(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='Turnaround Check'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}

function fliCount_air(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='On Air'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}

function fliCount_rtb(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='Return to Base'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}

function fliCount_rtd(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='Return to Dispersal'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}


function fliCount_unserviceable(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='Unserviceable'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}


function fliCount_completed(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='Flight Completed'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}

function fliCount_cancelled(){
	
	/*Count total number of flights for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND aircraftStatus='Cancelled'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "Nil";
		}	
	}//end if ($selectfli)
}



function fli_statCount_AW139_KTE(){
	
	/*Count total MONTHLY number of flights*/

	global $con;
	$today_date = date('Y-m-d');
	$today_year = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE aircraftStatus='Flight Completed'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count + 30674;
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function weststar_tower(){
	
	/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT accessNum FROM accesslist WHERE accessDATEIN='$today_date' AND accessLOCATION='HQ'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}

function weststar_honda(){
	
	/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT accessNum FROM accesslist WHERE accessDATEIN='$today_date' AND accessLOCATION='HONDA'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}

function weststar_kte(){
	
	/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT accessNum FROM accesslist WHERE accessDATEIN='$today_date' AND accessLOCATION='KTE'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function weststar_kbr(){
	
	/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT accessNum FROM accesslist WHERE accessDATEIN='$today_date' AND accessLOCATION='KBR'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function weststar_bki(){
	
	/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT accessNum FROM accesslist WHERE accessDATEIN='$today_date' AND accessLOCATION='BKI'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function weststar_myy(){
	
	/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT accessNum FROM accesslist WHERE accessDATEIN='$today_date' AND accessLOCATION='MYY'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function weststar_tbk(){
	
	/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT accessNum FROM accesslist WHERE accessDATEIN='$today_date' AND accessLOCATION='TBK'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function weststar_kjo(){
	
	/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');

	$flight = "SELECT accessNum FROM accesslist WHERE accessDATEIN='$today_date' AND accessLOCATION='KJO'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function count_staff(){
	
	/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');
	$user = $_SESSION['UID'];
	
	
	/*retrieve administrator details from database*/

	$sql3 = "SELECT * FROM administrator a 
	JOIN gelaran g ON (a.adminGelaran=g.gelaranID) 
	JOIN base b ON (a.adminBase=b.baseID)
	WHERE adminID='$user'";
	
	if ( $selectsql3 = $con -> prepare ($sql3)) 
	{
		// Bind parameters to statement variables
		//$selectsql3 -> bindParam(':id', $user);
		
		$selectsql3 -> execute();
	
		while($row = $selectsql3 -> fetch(PDO::FETCH_ASSOC)){
			
			$admin_base = $row['adminBase'];
		}
	}
	
	$flight = "SELECT accessNum FROM accesslist a
	           JOIN administrator b ON (a.accessLOCATION=b.adminBase)
	           WHERE accessDATEIN='$today_date' AND adminID='$user' AND accessTYPE='ST' AND accessLOCATION='$admin_base'";
		
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}

function count_visitor(){
	
/*Count total number of weststar_tower for the current day*/

	global $con;
	$today_date = date('Y-m-d');
	$user = $_SESSION['UID'];
	
	
	/*retrieve administrator details from database*/

	$sql3 = "SELECT * FROM administrator a 
	JOIN gelaran g ON (a.adminGelaran=g.gelaranID) 
	JOIN base b ON (a.adminBase=b.baseID)
	WHERE adminID='$user'";
	
	if ( $selectsql3 = $con -> prepare ($sql3)) 
	{
		// Bind parameters to statement variables
		//$selectsql3 -> bindParam(':id', $user);
		
		$selectsql3 -> execute();
	
		while($row = $selectsql3 -> fetch(PDO::FETCH_ASSOC)){
			
			$admin_base = $row['adminBase'];
		}
	}

	$flight = "SELECT accessNum FROM accesslist a
	           JOIN administrator b ON (a.accessLOCATION=b.adminBase)
	           WHERE accessDATEIN='$today_date' AND adminID='$user' AND accessTYPE='VS' AND accessLOCATION='$admin_base'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}




function fli_statCount_Jan(){
	
	/*Count total MONTHLY number of flights*/

	global $con;
	$today_date = date('Y-m-d');
	$today_year = date('Y');
	

	$flight = "SELECT fsNum FROM flightschedule WHERE clientID='PC' AND fsDate BETWEEN '$today_year-01-01' AND '$today_year-01-31'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



///////////////////////FEBRUARY////////////

function fli_statCount_Feb(){
	
	/*Count total MONTHLY number of flights*/

	global $con;
	$today_date = date('Y-m-d');
	$today_year = date('Y');

	$flight = "SELECT fsNum FROM flightschedule WHERE clientID='PC' AND fsDate BETWEEN '$today_year-02-01' AND '$today_year-02-31'";
	
	if ($selectfli = $con -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function fliPercent(){
	
	/* Count percentage of flights for (current day/yesterday) */
	
	global $con;	
	$today_date = date('Y-m-d');

	$todayfli = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date'";
	$preptodfli = $con -> prepare($todayfli);
	$preptodfli -> execute();
	$count_today = $preptodfli -> rowCount();
	

	$date = strtotime(date('Y-m-d'));
	$yesterday_date = date('Y-m-d', strtotime('-1days',$date));

	$yesterdayfli = "SELECT fsNum FROM flightschedule WHERE fsDate='$yesterday_date'";
	$prepyesfli = $con -> prepare($yesterdayfli);
	$prepyesfli -> execute();
	$count_yesterday = $prepyesfli -> rowCount();

	
		if($count_yesterday != NULL){
			$count_row = ($count_today/$count_yesterday);
			echo "<small class='text-success text-size-base'><i class='icon-arrow-up12'></i>".round($count_row,1)."%</small>";
		}else{
			echo "<small class='text-success text-size-base'></i>(0.0%)</small>";	
		}
}


function fliPercent_tomorrow(){
	
	/* Count percentage of flights for (current day/yesterday) */
	
	global $con;	
	$date_tomorrow = date("Y-m-d", strtotime("tomorrow"));

	$todayfli = "SELECT fsNum FROM flightschedule WHERE fsDate='$date_tomorrow'";
	$preptodfli = $con -> prepare($todayfli);
	$preptodfli -> execute();
	$count_tomorrow = $preptodfli -> rowCount();
	

	global $con;	
	$today_date = date('Y-m-d');

	$yesterdayfli = "SELECT fsNum FROM flightschedule WHERE fsDate='$$today_date'";
	$prepyesfli = $con -> prepare($yesterdayfli);
	$prepyesfli -> execute();
	$count_today = $prepyesfli -> rowCount();

	
		if($count_today != NULL){
			$count_row = ($count_tomorrow/$count_today);
			echo "<small class='text-success text-size-base'><i class='icon-arrow-up12'></i>".round($count_row,1)."%</small>";
		}else{
			echo "<small class='text-success text-size-base'></i>(0.0%)</small>";	
		}
}




function psngCount(){
	
	/*Count total number of passengers for the current day*/
	
	global $con;	
	$today_date = date('Y-m-d');
	
	$psng = "SELECT passengerTotal FROM flightschedule WHERE fsDate='$today_date'";
	
	if ( $selectpsng = $con -> prepare ($psng)){

		$selectpsng -> execute();		
		$sumpsng = 0;

		while($row = $selectpsng -> fetch(PDO::FETCH_ASSOC)){$sumpsng += $row['passengerTotal'];}
	
		if($sumpsng != NULL){
			echo $sumpsng." Passengers";
		}else{
			echo "No Passenger";
		}
	
	}//end if ($selectpsng)	
}


function psngPercent(){
	
	/* Count percentage of passengers for (current day/yesterday) */
	
	global $con;
	$today_date = date('Y,m,d');

	$todaypsng = "SELECT passengerTotal FROM flightschedule WHERE fsDate='$today_date'";
	$preptodpsng = $con -> prepare($todaypsng);
	$preptodpsng -> execute();
	$tot_today = 0;
	while($row = $preptodpsng -> fetch(PDO::FETCH_ASSOC)){ $tot_today += $row['passengerTotal']; }
	

	$date = strtotime(date('Y-m-d'));
	$yesterday_date = date('Y-m-d', strtotime('-1days', $date));

	$yesterdaypsng = "SELECT passengerTotal FROM flightschedule WHERE fsDate='$yesterday_date'";
	$prepyespsng = $con -> prepare($yesterdaypsng);
	$prepyespsng -> execute();
	$tot_yesterday = 0;
	while($row = $prepyespsng -> fetch(PDO::FETCH_ASSOC)){ $tot_yesterday += $row['passengerTotal']; }
	
	
	if($tot_yesterday != NULL){
		$count_tot = ($tot_today/$tot_yesterday);
		echo "<small class='text-success text-size-base'><i class='icon-arrow-up12'></i>".round($count_tot,1)."%</small>";
	}else{
		echo "<small class='text-success text-size-base'></i>(0.0%)</small>";
	}

}




///////////////////////////////////////////////////////////crew_pilot.php chart//////////////////////////////////////////////////////////////////////////

function captainCount(){
	
	/*Count total number of captain*/

	global $con;
	$today_date = date('Y-m-d');

	$captain = "SELECT pilotNum FROM pilot WHERE pilotTitle='Captain' AND pilotBase = 'KRT' AND pilotStatus='Active'";
	
	if ($selectcap = $con -> prepare ($captain)){
		
		$selectcap -> execute();
		$count = $selectcap -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}

function foCount(){
	
	/*Count total number of fo*/

	global $con;
	$today_date = date('Y-m-d');

	$fo = "SELECT pilotNum FROM pilot WHERE pilotTitle='First Officer' AND pilotBase = 'KRT' AND pilotStatus='Active'";
	
	if ($selectfo = $con -> prepare ($fo)){
		
		$selectfo -> execute();
		$count = $selectfo -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function sfoCount(){
	
	/*Count total number of sfo*/

	global $con;
	$today_date = date('Y-m-d');

	$sfo = "SELECT pilotNum FROM pilot WHERE pilotTitle='Senior First Officer' AND pilotBase = 'KRT' AND pilotStatus='Active'";
	
	if ($selectsfo = $con -> prepare ($sfo)){
		
		$selectsfo -> execute();
		$count = $selectsfo -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function cadetCount(){
	
	/*Count total number of cadet*/

	global $con;
	$today_date = date('Y-m-d');

	$cadet = "SELECT pilotNum FROM pilot WHERE pilotTitle='Cadet' AND pilotBase = 'KRT' AND pilotStatus='Active'";
	
	if ($selectcadet = $con -> prepare ($cadet)){
		
		$selectcadet -> execute();
		$count = $selectcadet -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function localCount(){
	
	/*Count total number of local pilot*/

	global $con;
	$today_date = date('Y-m-d');

	$local = "SELECT pilotNum FROM pilot WHERE pilotNationality='Local' AND pilotBase = 'KRT' AND pilotStatus='Active'";
	
	if ($selectlocal = $con -> prepare ($local)){
		
		$selectlocal -> execute();
		$count = $selectlocal -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function expatCount(){
	
	/*Count total number of expat pilot*/

	global $con;
	$today_date = date('Y-m-d');

	$expat = "SELECT pilotNum FROM pilot WHERE pilotNationality='Expatriate' AND pilotBase = 'KRT' AND pilotStatus='Active'";
	
	if ($selectexpat = $con -> prepare ($expat)){
		
		$selectexpat -> execute();
		$count = $selectexpat -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


///////////////////////////////////////////////////////////daily_schedule_tomorrow.php chart//////////////////////////////////////////////////////////////////////////




function dailypetronasCount_tomorrow(){
	
	/*Count total daily flight number*/

	global $con;
	$today_date = date('Y-m-d');
	$date = date("Y-m-d", strtotime("tomorrow"));
	
	$dailypetronas = "SELECT fsNum FROM flightschedule WHERE fsDate='$date' AND clientID = 'PC'";
	
	if ($selectdailypetronas = $con -> prepare ($dailypetronas)){
		
		$selectdailypetronas -> execute();
		$count = $selectdailypetronas -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function dailyemepmiCount_tomorrow(){
	
	/*Count total daily flight number*/

	global $con;
	$today_date = date('Y-m-d');
	$date = date("Y-m-d", strtotime("tomorrow"));
	
	$dailyemepmi = "SELECT fsNum FROM flightschedule WHERE fsDate='$date' AND clientID = 'EM'";
	
	if ($selectdailyemepmi = $con -> prepare ($dailyemepmi)){
		
		$selectdailyemepmi -> execute();
		$count = $selectdailyemepmi -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function dailysapuraCount_tomorrow(){
	
	/*Count total daily flight number*/

	global $con;
	$today_date = date('Y-m-d');
	$date = date("Y-m-d", strtotime("tomorrow"));
	
	$dailysapura = "SELECT fsNum FROM flightschedule WHERE fsDate='$date' AND clientID = 'SK'";
	
	if ($selectdailysapura = $con -> prepare ($dailysapura)){
		
		$selectdailysapura -> execute();
		$count = $selectdailysapura -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function dailyenquestCount_tomorrow(){
	
	/*Count total daily flight number*/

	global $con;
	$today_date = date('Y-m-d');
	$date = date("Y-m-d", strtotime("tomorrow"));
	
	$dailyenquest = "SELECT fsNum FROM flightschedule WHERE fsDate='$date' AND clientID = 'EN'";
	
	if ($selectdailyenquest = $con -> prepare ($dailyenquest)){
		
		$selectdailyenquest -> execute();
		$count = $selectdailyenquest -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function dailypetrofacCount_tomorrow(){
	
	/*Count total daily flight number*/

	global $con;
	$today_date = date('Y-m-d');
	$date = date("Y-m-d", strtotime("tomorrow"));
	
	$dailypetrofac = "SELECT fsNum FROM flightschedule WHERE fsDate='$date' AND clientID = 'PETRO'";
	
	if ($selectdailypetrofac = $con -> prepare ($dailypetrofac)){
		
		$selectdailypetrofac -> execute();
		$count = $selectdailypetrofac -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function dailyvestigoCount_tomorrow(){
	
	/*Count total daily flight number*/

	global $con;
	$today_date = date('Y-m-d');
	$date = date("Y-m-d", strtotime("tomorrow"));
	
	$dailyvestigo = "SELECT fsNum FROM flightschedule WHERE fsDate='$date' AND clientID = 'VS'";
	
	if ($selectdailyvestigo = $con -> prepare ($dailyvestigo)){
		
		$selectdailyvestigo -> execute();
		$count = $selectdailyvestigo -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}

function dailyipcCount_tomorrow(){
	
	/*Count total daily flight number*/

	global $con;
	$today_date = date('Y-m-d');
	$date = date("Y-m-d", strtotime("tomorrow"));
	
	$dailyipc = "SELECT fsNum FROM flightschedule WHERE fsDate='$date' AND clientID = 'IPC'";
	
	if ($selectdailyipc = $con -> prepare ($dailyipc)){
		
		$selectdailyipc -> execute();
		$count = $selectdailyipc -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}














/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//page footer
function fidsFoot(){
	
	echo "&copy; 2018. <a href='#'>Flight Information Display System</a><!-- by <a href='#' target='_blank'>ICT KTE Base</a>-->";
	
	
    //echo "&copy; 2018. <a href='#'>Flight Information Display System</a> by <a href='#' target='_blank'>Aizad</a>";
	
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







/////////////////////////////////////////////////////////KERTEH BASE////////////////////////////////////////////////////////////////////////////

//Main Navbar Profile n Image Name
function main_menu(){
	
	global $con;
    $user = $_SESSION['UID'];
    $timestamp = time();
    $php_timestamp_date = date('y,m,d', $timestamp);
	
	
	/*retrieve pilot details from database*/

	//SQL query
	$sql = "SELECT * FROM pilot";
	
	if ( $selectsql = $con -> prepare ($sql)) // Prepare the SQL query
	{
		// Execute statement
		$selectsql -> execute();
		
		// Set fetch mode to FETCH_ASSOC to return an array indexed by column name
		$selectsql -> setFetchMode(PDO::FETCH_ASSOC);
		
		// Fetch result
		while($row = $selectsql -> fetchColumn()){
		
			$dcID = $row['pilotID'];
			$dcName = $row['pilotName'];
			$dcImage = $row['pilotPhoto'];
			$roles = $row['adminPrivilege'];
		}	
		
	}



/*retrieve user details from database*/	

	$sql2 = "SELECT * FROM user WHERE userName='$user'";
	
	if ( $selectsql2 = $con -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
			$roles = $row['adminPrivilege'];
		}
	
	}

/*retrieve englogin details from database*/	

	$sql2 = "SELECT * FROM englogin WHERE userName='$user'";
	
	if ( $selectsql2 = $con -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
			$roles = $row['adminPrivilege'];
		}
	
	}
	
	
	/*retrieve foologin details from database*/	

	$sql2 = "SELECT * FROM foologin WHERE userName='$user'";
	
	if ( $selectsql2 = $con -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
			$roles = $row['adminPrivilege'];
		}
	
	}
	
	
	/*retrieve rologin details from database*/	

	$sql2 = "SELECT * FROM rologin WHERE userName='$user'";
	
	if ( $selectsql2 = $con -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
			$roles = $row['adminPrivilege'];
		}
	
	}




/*retrieve administrator details from database*/

	$sql3 = "SELECT * FROM administrator WHERE adminID='$user'";
	
	if ( $selectsql3 = $con -> prepare ($sql3)) 
	{
		// Bind parameters to statement variables
		//$selectsql3 -> bindParam(':id', $user);
		
		$selectsql3 -> execute();
	
		while($row = $selectsql3 -> fetch(PDO::FETCH_ASSOC)){
			
		      $ID = $row['adminID'];
			$Name = $row['adminName'];
			$Photo = $row['adminPhoto'];
            $roles = $row['adminPrivilege'];			
		}
	}
	
	
/*retrieve foc user details from database*/

	$sql4 = "SELECT * FROM focuser WHERE fosID='$user'";
	
	if ( $selectsql4 = $con -> prepare ($sql4)) 
	{
		// Bind parameters to statement variables
		//$selectsql4 -> bindParam(':id', $user);
		
		$selectsql4 -> execute();
	
		while($row = $selectsql4 -> fetch(PDO::FETCH_ASSOC)){
		
			$Name = $row['fosFullname'];
			$Photo = $row['fosPhoto'];	
			$roles = $row['adminPrivilege'];
		}
	}

	
	//Close the connection to the database
	//$con = null;	
}







//Main Navbar Profile n Image Name
function mainNavbar(){
	
	global $con;
    $user = $_SESSION['UID'];
    $timestamp = time();
    $php_timestamp_date = date('y,m,d', $timestamp);
	$myt = date('H:i');
	$utc = gmdate('H:i'); 
	
	
/*retrieve user details from database*/	

	$sql2 = "SELECT * FROM user WHERE userName='$user'";
	
	if ( $selectsql2 = $con -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
		}
	
	}


/*retrieve administrator details from database*/

	$sql3 = "SELECT * FROM administrator WHERE adminID='$user'";
	
	if ( $selectsql3 = $con -> prepare ($sql3)) 
	{
		// Bind parameters to statement variables
		//$selectsql3 -> bindParam(':id', $user);
		
		$selectsql3 -> execute();
	
		while($row = $selectsql3 -> fetch(PDO::FETCH_ASSOC)){
			
		      $ID = $row['adminID'];
			$Name = $row['adminName'];
			$Photo = $row['adminPhoto'];
            $Menu_Permission = $row['menuPermission'];				
		}
	}
	

/*retrieve login details from database*/
    
	$out = "SELECT logNum FROM loguserin WHERE logUsername='$user'";	
	$prepout = $con -> prepare ($out);
	$prepout -> execute();
	
		while($row = $prepout -> fetch(PDO::FETCH_ASSOC)){
		
			$log_code = $row['logNum'];	
		}
	
	//Close the connection to the database
	//$con = null;
	
	
/*retrieve base details from database*/

	$sql4 = "SELECT * FROM administrator a JOIN base b ON (a.adminBase=b.baseID) WHERE adminID='$user'";
	
	if ( $selectsql4 = $con -> prepare ($sql4)) 
	{
		$selectsql4 -> execute();
	
		while($row = $selectsql4 -> fetch(PDO::FETCH_ASSOC)){
			
		      $base_name = $row['baseName'];	
		}
	}
	
	
	echo "
	
	
	<div class='navbar navbar-inverse'>
	     <div class='navbar-header'>
		    <a class='navbar-brand2' href='daily_schedule.php'><img src='assets/images/logo/was.png' alt='' width='112' height=''></a>
			<a class='' href='daily_schedule.php'><img src='assets/images/qrcode.png' alt='' width='45' height=''></a>
			<ul class='nav navbar-nav pull-right visible-xs-block'>
				<li><a data-toggle='collapse' data-target='#navbar-mobile'><i class='icon-paragraph-justify3'></i></a></li>
			</ul>
	     </div>
	
	<div class='navbar-collapse collapse' id='navbar-mobile'>
	
	        <!--<ul class='nav navbar-nav'>
	        <li class='dropdown'>
					<a href='daily_schedule.php' class='dropdown-toggle' data-toggle='dropdown'>
						<img src='assets/images/FIDS Latest 3.png' alt='' width='70' height=''>
						<span class='visible-xs-inline-block position-right'>Full Screen</span>
					</a>
			</li>
			</ul>-->
		
		    <!--<p class='navbar-text'><span class='label bg-success-400'>KERTEH BASE</span></p>-->
			
			<ul class='nav navbar-nav'>
				<li class='dropdown' data-popup='tooltip' title='FullScreen' data-placement='bottom' onclick='toggleFullScreen();'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
						<img src='assets/images/icons/full-screen.png' alt='' width='23' height=''>
						<span class='visible-xs-inline-block position-right'>Full Screen</span>
					</a>
				</li>
                                                
				<li class='dropdown' data-popup='tooltip' title='Refresh' data-placement='bottom' type='submit'  onClick='refreshPage();'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
						<img src='assets/images/icons/refresh4.png' alt='' width='26' height=''>
						<span class='visible-xs-inline-block position-right'>Refresh</span>
					</a>
				</li>
				
				
				
				<li class='dropdown'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
						<img src='assets/images/icons/icons8-settings-80.png'  alt='' width='19' height=''>
						<span class='visible-xs-inline-block position-right'>Settings</span>
						<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-200'>
						<li><a href='#'><img src='assets/images/icons/crew-80.png' class='position-left' alt='' width='19' height=''> User Manager</a></li>
						<!--<li><a href='#'><img src='assets/images/icons/icons8-airport-80.png' class='position-left' alt='' width='19' height=''>Select Base</a></li>-->
						<li><a href='#'><img src='assets/images/icons/icons8-id-verified-80.png' class='position-left' alt='' width='19' height=''> Roles & Permissions</a></li>
						<li class='divider'></li>
						<li><a href='#'><img src='assets/images/icons/icons8-gears-80.png' class='position-left' alt='' width='19' height=''> All settings</a></li>
					</ul>
				</li>
				
				<!--<p class='navbar-text' data-popup='tooltip' title='FIDS is still under development and prototype phase. Your valuable feedback is very much appreciated.' data-placement='bottom'><span class='label bg-danger-400'>PROTOTYPE</span></p>-->
			
			    <p class='navbar-text'><span class='label bg-success-400'>$base_name</span></p>
				
				<!--<p class='navbar-text'><span class='label bg-success-400'>$myt</span><span class='label bg-orange-300'>MYT</span></p>
				
				<p class='navbar-text'><span class='label bg-success-400'>$utc</span><span class='label bg-orange-300'>UTC</span></p>-->
				
				
				<li class='' data-popup='tooltip' title='QRCODE is still under development and prototype phase. Your valuable feedback is very much appreciated.' data-placement='bottom'>
				<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
				  <i class='icon-info22'></i>
				</a>
				</li>
				
				
				<!--<li class='' data-popup='tooltip' title='Smart tools for video conferencing among users' data-placement='bottom'><a href='fids_live.php' class='text-default text-semibold'><img src='assets/images/logo/FIDS_live_3.png' 
				class='position-left img-thumbnail'' alt='' width='60' height=''></a>
                </li>-->
				
				
			</ul>
			
			<ul class='nav navbar-nav navbar-right'>
			
	<li class='dropdown dropdown-user'>
					<a class='dropdown-toggle'' data-toggle='dropdown'>
						<img src='assets/images/users/$Photo' alt=''>
						<span>$Name</span>
						<i class='caret'></i>
					</a>

					<ul class='dropdown-menu dropdown-menu-right'>
						<li><a href='#'><img src='assets/images/icons/icons8-customer-80.png' class='position-left' alt='' width='20' height=''> My profile</a></li>
						<!--<li><a href='#'><span class='badge badge-warning pull-right'>58</span> <i class='icon-comment-discussion'></i> Messages</a></li>-->
						<li class='divider'></li>
						<!--<li><a href='#'><img src='assets/images/icons/icons8-settings-80.png' class='position-left' alt='' width='19' height=''> Settings</a></li>-->
						<li><a href='logout.php?logoutcode=<?php echo $log_code; ?>' ><img src='assets/images/icons/icons8-shutdown-80.png' class='position-left' alt='' width='19' height=''> Logout</a></li>
					</ul>
				</li>
				
			</ul>
			
			<!--<ul class='nav navbar-nav navbar-right'>
			<form class='navbar-form navbar-left'>
			<div class='form-group has-feedback'>
			<input type='search' class='form-control' placeholder='Search'>
			<div class='form-control-feedback'>
			<i class='icon-search4 text-muted text-size-base'></i>
			</div>
			</div>
			</form>
			</ul>-->
				
	</div>

    </div>	
				
	";	
}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//Second Navbar
function fidsMenu(){
	
	global $con;
    $user = $_SESSION['UID'];
    $timestamp = time();
    $php_timestamp_date = date('y,m,d', $timestamp);
	$myt = date('H:i');
	$utc = gmdate('H:i'); 
	
	
/*retrieve user details from database*/	

	$sql2 = "SELECT * FROM user WHERE userName='$user'";
	
	if ( $selectsql2 = $con -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
		}
	
	}


/*retrieve administrator details from database*/

	$sql3 = "SELECT * FROM administrator WHERE adminID='$user'";
	
	if ( $selectsql3 = $con -> prepare ($sql3)) 
	{
		// Bind parameters to statement variables
		//$selectsql3 -> bindParam(':id', $user);
		
		$selectsql3 -> execute();
	
		while($row = $selectsql3 -> fetch(PDO::FETCH_ASSOC)){
			
		    $ID = $row['adminID'];
			$Name = $row['adminName'];
			$Photo = $row['adminPhoto'];
            $Menu_Permission = $row['menuPermission'];				
		}
	}
	

/*retrieve login details from database*/
    
	$out = "SELECT logNum FROM loguserin WHERE logUsername='$user'";	
	$prepout = $con -> prepare ($out);
	$prepout -> execute();
	
		while($row = $prepout -> fetch(PDO::FETCH_ASSOC)){
		
			$log_code = $row['logNum'];	
		}
	
	//Close the connection to the database
	//$con = null;
	
	
/*retrieve base details from database*/

	$sql4 = "SELECT * FROM administrator a JOIN base b ON (a.adminBase=b.baseID) WHERE adminID='$user'";
	
	if ( $selectsql4 = $con -> prepare ($sql4)) 
	{
		$selectsql4 -> execute();
	
		while($row = $selectsql4 -> fetch(PDO::FETCH_ASSOC)){
			
		      $base_name = $row['baseName'];	
		}
	}
	
	echo "
	
	
	<!-- Second navbar -->
	<div class='navbar navbar-default' id='navbar-second'>
		<ul class='nav navbar-nav no-border visible-xs-block'>
			<li><a class='text-center collapsed' data-toggle='collapse' data-target='#navbar-second-toggle'><i class='icon-menu7'></i></a></li>
		</ul>

		<div class='navbar-collapse collapse' id='navbar-second-toggle'>
			<ul class='nav navbar-nav'>
			
                
				
				<!--Dashboard-->
                
				<li class=''><a href='index.php' class='text-default text-semibold'><img src='assets/images/icons/analysis.png' class='position-left' alt='' width='25' height=''> Dashboard</a>
                </li>
				
				
				
				
				<!--Company-->
				
				$Menu_Permission
			
			
			<!--WASSB n Goal Zero-->
				<ul class='nav navbar-nav navbar-right'>
				<li class='dropdown mega-menu mega-menu-wide'>
										<a href='#' data-toggle='dropdown' class='dropdown-toggle'>
					                    <!--<img src='assets/images/logo/was.png' alt='' width='65' height=''>-->
						                <img src='assets/images/logo/goalzero.png' alt='' width='50' height=''>
					                    <span class='caret'></span></a>
										<div class='dropdown-menu dropdown-content'>
											<div class='dropdown-content-body'>
												<div class='row'>
													<div class='col-md-3'>
														<div class='row'>
															<div class='col-md-12'>
																<span class='menu-heading underlined'>Menu</span>
																<ul class='menu-list'>
																	<li><a href='https://www.weststar-aviation.aero/index.php' target='_blank'><img src='assets/images/logo/was.png' class='position-left' alt='' width='45' height=''>Weststar Aviation Services Website</a></li>
																	<li><a href='https://www.weststar-aviation.aero/was3/goalZero.php' target='_blank'><img src='assets/images/logo/goalzero.png' class='position-left' alt='' width='40' height=''>Goal Zero Mission</a></li>
																	<li><a href='changelog.php'><img src='assets/images/icons/icons8-maintenance-80.png' class='position-left' alt='' width='20' height=''>FIDS System Changelog</a></li>
																</ul>
															</div>
														</div>
													</div>
													
													<div class='col-md-3'>
														<span class='menu-heading'>WASSB Corporate Video</span>
														<iframe height='230' width='100%' src='https://www.youtube.com/embed/zrkLFmPV8Q4' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
														</div>
													
													<div class='col-md-3'>
														<span class='menu-heading'>WASSB Safety Video</span>
														<iframe height='230' width='100%' src='https://www.youtube.com/embed/zVDuny2epbY' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
														</div>

													<div class='col-md-3'>
														<span class='menu-heading'>WASSB Goal Zero Mission</span>
														<iframe src='https://www.youtube.com/embed/4lFpxGvG9dI' height='230' width='100%' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
													</div>
												</div>
											</div>
										</div>
									</li>
				</ul>
			
			
			<!--<ul class='nav navbar-nav navbar-right'>
				<li>
					<a href='changelog.php' class='text-default text-semibold'>
					    <img src='assets/images/logo/was.png' alt='' width='65' height=''>
						<img src='assets/images/logo/goalzero.png' alt='' width='50' height=''>
						FIDS<span class='label label-inline position-right bg-danger-400'>BETA</span>
					</a>		
				</li>
			</ul>-->
		</div>
	</div>
	<!-- /second navbar -->
	
	
	
	
	
	";
	
}






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//Second Navbar
function fidsMenu2(){
	
	echo "
	
	
	<!-- Second navbar -->
	<div class='navbar navbar-default' id='navbar-second'>
		<ul class='nav navbar-nav no-border visible-xs-block'>
			<li><a class='text-center collapsed' data-toggle='collapse' data-target='#navbar-second-toggle'><i class='icon-menu7'></i></a></li>
		</ul>

		<div class='navbar-collapse collapse' id='navbar-second-toggle'>
			<ul class='nav navbar-nav'>
			
                
				
				<!--Dashboard
                
				<li class=''><a href='index.php' class='text-default text-semibold'><img src='assets/images/icons/icons8-statistics-80.png' class='position-left' alt='' width='20' height=''> Dashboard</a>
                </li>
				-->
				
				<!--Flight Information-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='assets/images/icons/icons8-airplane-take-off-80.png' class='position-left' alt='' width='20' height=''> Flight <span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-200'>
						<li class='dropdown-header'>Flight Schedule</li>
						<li><a href='user_daily_schedule.php'><img src='assets/images/icons/icons8-airplane-take-off-80.png' class='position-left' alt='' width='20' height=''>Daily Flight Schedule</a></li>
					    <li><a href='user_flighist_dis.php'><img src='assets/images/icons/icons8-calendar-plus-80.png' class='position-left' alt='' width='20' height=''>Flight History</a></li>
					</ul>
				</li>
			
				
				</li>
                
				
				<!--Crew-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='assets/images/icons/crew-80.png' class='position-left' alt='' width='20' height=''>Crew<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-400'>
						<li class='dropdown-header'>Flight Operations</li>
                        <li><a href='user_crew_pilot.php'><img src='assets/images/icons/icons8-account-80.png' class='position-left' alt='' width='19' height=''> Pilot</a></li>
						<!--<li><a href='flight_support.php'><img src='assets/images/icons/icons8-people-80.png' class='position-left' alt='' width='19' height=''> Flight Operations Support</a></li>-->
						
						<li class='dropdown-header'>Engineering</li>
                        <li><a href='user_crew_engineering.php'><img src='assets/images/icons/icons8-engineer-80.png' class='position-left' alt='' width='19' height=''>Engineer & Technician</a></li>
						<!--<li><a href='engineering_support.php'><img src='assets/images/icons/icons8-people-80.png' class='position-left' alt='' width='19' height=''>Engineering Operations Support</a></li>-->
					</ul>
				</li>
				
				
				<!--Client-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='assets/images/icons/icons8-skyscrapers-80.png' class='position-left' alt='' width='20' height=''>Client<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-200'>
						<li class='dropdown-header'>Client</li>
						<li><a href='user_client.php'><img src='assets/images/icons/icons8-people-80.png' class='position-left' alt='' width='19' height=''>JOPS</a></li>
						
						</ul>
				</li>
				
				
				<!--Safety
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='assets/images/icons/icons8-stethoscope-80.png' class='position-left' alt='' width='20' height=''>Safety<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-300'>
						<li class='dropdown-header'>Q - Pulse Report</li>
						<li><a href='qpulseflight_technical.php'><img src='assets/images/icons/icons8-treatment-80.png' class='position-left' alt='' width='19' height=''>Flight / Technical Occurrence Report</a></li>
						</ul>
				</li>
				
				-->
				
                <!--Area of Operations-->
                
                 <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='assets/images/icons/icons8-map-marker-80.png' class='position-left' alt='' width='20' height=''>Operations Area<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-200'>
						<li class='dropdown-header'>Operations Area </li>
						<li><a href='user_map-fullscreen.php'><img src='assets/images/icons/icons8-map-marker-80.png' class='position-left' alt='' width='19' height=''> Operations Area</a></li>
						<li><a href='user_operation_list.php'><img src='assets/images/icons/icons8-pass-fail-80.png' class='position-left' alt='' width='19' height=''> List of Operations Area</a></li>
					</ul>
				</li>
				
				
				<!--Weather-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='20' height=''>Weather<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-400'>
						<li class='dropdown-header'>Weather Forecast</li>
						<li><a href='user_weather_kertih.php'><img src='assets/images/icons/icons8-sun-80.png' class='position-left' alt='' width='22' height=''> Kertih Weather Forecast</a></li>
                        <li><a href='user_weather.php'><img src='assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='19' height=''> Weather Forecast Map</a></li>
						
						
						<li class='dropdown-header'>Satellite Images</li>
                        <li><a href='user_himawari_satellite.php'><img src='assets/images/icons/icons8-satellite-signal-80.png' class='position-left' alt='' width='19' height=''>HIMAWARI Satellite</a></li>
						<li><a href='user_fy2_satellite.php'><img src='assets/images/icons/icons8-gps-signal-80.png' class='position-left' alt='' width='19' height=''> FY-2 Satellite</a></li>
						
						<li class='dropdown-header'>Radar Images</li>
                        <li><a href='user_peninsular_radar.php'><img src='assets/images/icons/icons8-radar-80.png' class='position-left' alt='' width='23' height=''>Merged Peninsular Malaysia CAPPI</a></li>
						<li><a href='user_rains_radar.php'><img src='assets/images/icons/icons8-radar-80.png' class='position-left' alt='' width='23' height=''>Radar Integrated Nowcasting System (RAINS)</a></li>
						
						<li class='dropdown-header'>Malaysia Meteorology System</li>
						<li><a href='user_abt.php'><img src='assets/images/icons/icons8-user-manual-80.png' class='position-left' alt='' width='19' height=''> Aviation Briefing Terminal</a></li>
					</ul>
				</li>
				
				
				
				<!--Weather
				
				    <li class='dropdown mega-menu mega-menu-wide'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'><img src='assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='20' height=''> Weather <span class='caret'></span></a>

					<div class='dropdown-menu dropdown-content'>
						<div class='dropdown-content-body'>
							<div class='row'>
								<div class='col-md-3'>
									<span class='menu-heading underlined'>Weather Forecast</span>
									<ul class='menu-list'>
										<li><a href='weather.php'><img src='assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='19' height=''> Weather Forecast</a></li>
										<li><a href='abt.php'><img src='assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='19' height=''> Aviation Briefing Terminal</a></li>
										<li><a href='weather_globe.php'><img src='assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='19' height=''> Weather Globe</a></li>
									</ul>
								</div>
								<div class='col-md-3'>
									<span class='menu-heading underlined'>WARNING & ADVISORIES</span>
									<ul class='menu-list'>
									    <li>
											<li><a href='volcanic_advisory.php'><img src='assets/images/icons/icons8-volcano-80.png' class='position-left' alt='' width='19' height=''>Volcanic Ash Advisory</a></li>
											<li><a href='weather.php'><img src='assets/images/icons/icons8-tornado-80.png' class='position-left' alt='' width='19' height=''> Tropical Cyclone and Typhoon Advisory</a></li>
											<li><a href='aero_warning_local.php'><img src='assets/images/icons/icons8-alert-80.png' class='position-left' alt='' width='19' height=''> Aerodrome Warning for Local Airports</a></li>
											<li><a href='weather.php'><img src='assets/images/icons/icons8-alert-80.png' class='position-left' alt='' width='19' height=''> Aerodrome Warning for WMKK</a></li>
										</li>
									
										
										<li>
											<a href='#'><img src='assets/images/icons/icons8-documents-80.png' class='position-left' alt='' width='19' height=''>SIGMET / AIRMET Bulletin</a>
											<ul>
												<li><a href='#'>Domestic SIGMET Bulletin</a></li>
												<li><a href='#'>Domestic Airmet Bulletin</a></li>
												<li><a href='#'>Asean SIGMET / AIRMET Bulletin</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<div class='col-md-3'>
									<span class='menu-heading underlined'>PILOT BRIEFING</span>
									<ul class='menu-list'>
										<li>
											<a href='#'><img src='assets/images/icons/icons8-airplane-take-off-80.png' class='position-left' alt='' width='19' height=''> Domestic Flight Route</a>
											<ul>
												<li><a href='#'>Domestic METAR Bulletin</a></li>
												<li><a href='#'>Domestic TAF Bulletin</a></li>
												<li><a href='#'>Domestic SIGMET Bulletin</a></li>
												<li><a href='#'>Domestic AIRMET Bulletin</a></li>
												<li><a href='#'>Forecast Upper Winds</a></li>
												<li><a href='echarts_funnels_chords.html'>Domestic - Wind & Temperature Chart</a></li>
												<li><a href='echarts_candlesticks_others.html'>Domestic Significant Weather Chart</a></li>
											</ul>
										</li>
										<li>
											<a href='#'><img src='assets/images/icons/icons8-airplane-take-off-80.png' class='position-left' alt='' width='19' height=''>ASEAN Flight Route</a>
											<ul>
												<li><a href='d3_lines_basic.html'>ASEAN METAR Bulletin</a></li>
												<li><a href='d3_lines_advanced.html'>ASEAN TAF Bulletin</a></li>
												<li><a href='d3_bars_basic.html'>ASEAN SIGMET / AIRMET Bulletin</a></li>
												<li><a href='d3_bars_advanced.html'>ASEAN - Wind & Temperature Chart</a></li>
												<li><a href='d3_pies.html'>ASEAN Significant Weather Chart</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<div class='col-md-3'>
									<span class='menu-heading underlined'>SATELLITE IMAGES</span>
									<ul class='menu-list'>
										<li><a href='weather_1.php'><img src='assets/images/icons/icons8-satellite-signal-80.png' class='position-left' alt='' width='19' height=''>HIMAWARI Satellite</a></li>
						                <li><a href='weather_3.php'><img src='assets/images/icons/icons8-gps-signal-80.png' class='position-left' alt='' width='19' height=''> FY-2 Satellite</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</li>
	
				End of Weather-->
				
				
			<!--Publications-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='assets/images/icons/icons8-course-80.png' class='position-left' alt='' width='20' height=''>Publications<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-300'>
						<li class='dropdown-header'>Publications</li>
						<li><a href='user_aip.php'><img src='assets/images/icons/caam.png' class='position-left' alt='' width='25' height=''>Aeronautical Information Publications</a></li>
						</ul>
				</li>	
				
				
			<!--Links-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='assets/images/icons/icons8-responsive-80.png' class='position-left' alt='' width='25' height=''>Links<span class='caret'></span>
					</a>
					<ul class='dropdown-menu width-350'>
					
					
					<!--Flight Ops-->
					
				    <li class='dropdown-header'>Flight Operations</li>
					<li><a href='https://skyweb.skytrac.ca/Login.aspx?security=ssl' target='_blank'><img src='assets/images/icons/skyweb.ico' class='position-left img-circle' alt='' width='30' height=''>Skyweb</a></li>
					<li><a href='https://go.spidertracks.com/registration' target='_blank'><img src='assets/images/icons/spidertrack.png' class='position-left img-circle' alt='' width='30' height=''>Spidertrack</a></li>
					
					<li class='dropdown-submenu'>
							<a href='#' target='_blank' class='dropdown-toggle' data-toggle='dropdown'><img src='assets/images/icons/ofp.jpg' class='position-left img-circle' alt='' width='30' height=''>Offshore Flight Plan (OFP)</a>
							<ul class='dropdown-menu width-200'>
								<li><a href='http://checks.offshoreflightplan.co.uk' target='_blank'><img src='assets/images/icons/ofp.jpg' class='position-left img-circle' alt='' width='30' height=''>OFP Web Checks</a></li>
								<li><a href='https://reports.offshoreflightplan.co.uk/login/index' target='_blank'><img src='assets/images/icons/ofp.jpg' class='position-left img-circle' alt='' width='30' height=''>OFP Web Reports</a></li>
								<li><a href='https://logbook.offshoreflightplan.co.uk/login/index' target='_blank'><img src='assets/images/icons/ofp.jpg' class='position-left img-circle' alt='' width='30' height=''>OFP Pilot Logbook</a></li>
							</ul>
					</li>
					
					<li><a href='https://training.ctsys.com/cts/CompanyUsers/index.cfm?event=Common.ViewLogin#' target='_blank'><img src='assets/images/icons/cts.png' class='position-left img-circle' alt='' width='30' height=''>Computer Training Systems (CTS)</a></li>
					<li><a href='http://ptsjops.weststar-aviation.aero/pts/app/' target='_blank'><img src='assets/images/icons/tieto.png' class='position-left img-circle' alt='' width='30' height=''>Personnel Transportation Solution (PTS)</a></li>
					
					
					
					<!--Engineering-->
					
					<li class='dropdown-header'>Engineering</li>
				    <li><a href='https://www.campsystems.com/' target='_blank'><img src='assets/images/icons/camp2.png' class='position-left' alt='' width='30' height=''>CAMP Systems</a></li>
					<li><a href='http://www.infoblast.com.my/infoblastv2/' target='_blank'><img src='assets/images/icons/blast.png' class='position-left' alt='' width='35' height=''>TM Infoblast</a></li>
				    
					
					<!--Others-->
					<li class='dropdown-header'>Others</li>
					
					<li class='dropdown-submenu'>
							<a href='#' target='_blank' class='dropdown-toggle' data-toggle='dropdown'><img src='assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Q Pulse</a>
							<ul class='dropdown-menu width-250'>
								<li><a href='https://qpulse.weststar-aviation.aero/QPulseWeb/UI/Open/Login.aspx?ReturnUrl=%2fQPulseWeb%2f' target='_blank'><img src='assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Q Pulse Web Apps</a></li>
								<li><a href='https://qpulse.weststar-aviation.aero/reporting' target='_blank'><img src='assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Q Pulse Web Safety Reporting</a></li>
								<li><a href='https://weststaraviation.gaelrisk.com/Account/Login?ReturnUrl=%2f' target='_blank'><img src='assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Gael Risk</a></li>
								<li><a href='http://learn.gaelacademy.com/Public/Homepage.aspx' target='_blank'><img src='assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Gael Academy</a></li>
							</ul>
					</li>
					
					<li><a href='https://webmail.weststar-aviation.aero/owa' target='_blank'><img src='assets/images/icons/owa.jpg' class='position-left img-circle' alt='' width='30' height=''>Outlook Web App (OWA)</a></li>
					<li><a href='https://wess.weststar-aviation.aero/UserLogin.aspx' target='_blank'><img src='assets/images/icons/was.png' class='position-left img-circle' alt='' width='35' height=''>Weststar Employee Self Service (WESS)</a></li>
					<li><a href='https://wiz.weststar-aviation.aero' target='_blank'><img src='assets/images/icons/wiz.png' class='position-left img-circle' alt='' width='35' height=''>Weststar Intranet Zone (WIZ)</a></li>
					
					</ul>
						

				</li>
				
				
				
			</ul>
			
			
			
			
			
			
			
			

			<ul class='nav navbar-nav navbar-right'>
				<li>
					<a href='user_changelog.php' class='text-default text-semibold'>
						<img src='assets/images/logo/was.png' alt='' width='80' height=''>
						FIDS
						<span class='label label-inline position-right bg-danger-400'>BETA</span>
					</a>		
				</li>

				<!--<li class='dropdown'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
						<img src='assets/images/icons/icons8-settings-80.png'  alt='' width='19' height=''>
						<span class='visible-xs-inline-block position-right'>Settings</span>
						<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-200'>
						<li><a href='#'><img src='assets/images/icons/crew-80.png' class='position-left' alt='' width='19' height=''> User Manager</a></li>
						<li><a href='#'><img src='assets/images/icons/icons8-airport-80.png' class='position-left' alt='' width='19' height=''>Select Base</a></li>
						<li><a href='#'><img src='assets/images/icons/icons8-id-verified-80.png' class='position-left' alt='' width='19' height=''> Roles & Permissions</a></li>
						<li class='divider'></li>
						<li><a href='#'><img src='assets/images/icons/icons8-gears-80.png' class='position-left' alt='' width='19' height=''> All settings</a></li>
					</ul>
				</li>-->
			</ul>
		</div>
	</div>
	<!-- /second navbar -->
	";
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Mobile Left Menu
function fidsMenu3(){
	
	echo "
	
	<div class='list links-list'>
                <ul class='accordion-list'>
				  
				  

                  	<li class='accordion-item'>
                        <a href='' class='item-link item-content'>
                            <div class='item-title'>    
                                <!--<i class='icon f7-icons ios-only'>menu</i>-->
                                <img src='../assets/images/icons/icons8-website-96.png' style='float: left; display: inline-block;' width='25' height=''> &nbsp;&nbsp; Links
                            </div>                        
                        </a>
                        <div class='accordion-item-content'>
                            <a href='https://webmail.weststar-aviation.aero/owa' class='panel-open link external'>
                             Outlook Web Apps 
                            </a>
							<a href='https://wess.weststar-aviation.aero/UserLogin.aspx' class='panel-open link external'>
                             WESS 
                            </a>
							<a href='https://qpulse.weststar-aviation.aero/QPulseWeb/UI/Open/Login.aspx' class='panel-open link external'>
                             Q - Pulse 
                            </a>
							<a href='https://qpulse.weststar-aviation.aero/reporting' class='panel-open link external'>
                             Q - Pulse Reporting
                            </a>
							<a href='http://learn.gaelacademy.com/Public/Homepage.aspx' class='panel-open link external'>
                             Gael Academy 
                            </a>
							<a href='https://logbook.offshoreflightplan.co.uk/login/index' class='panel-open link external'>
                             OFP Pilot Logbook
                            </a>
							<a href='https://training.ctsys.com/cts/CompanyUsers/index.cfm?event=Common.ViewLogin#' class='panel-open link external'>
                             Pilot CTS 
                            </a>
                        </div>
                    </li>
                </ul>
              </div>
	";	
}























//Mobile Left Menu
function fidsMenu4(){
	
	echo "
	
	<div class='list links-list'>
                <ul class='accordion-list'>
                  <li>
                      <a href='homepage.php' class='panel-close'>
                          <div class='item-title'> 
                              <!--<i class='icon f7-icons ios-only'>home</i>-->
                              <img src='../assets/images/icons/dashboard.png' style='float: left; display: inline-block;' width='25' height=''> &nbsp;&nbsp;  Dashboard
                          </div>
                      </a>
                  </li>
				  
				  <li>
                      <a href='http://210.187.31.198/fids/mobile/homepage.php' class='panel-close link external'>
                          <div class='item-title'> 
                              <!--<i class='icon f7-icons ios-only'>search</i>-->
                              <img src='../assets/images/icons/helicopter copy.png' style='float: left; display: inline-block;' width='25' height=''> &nbsp;&nbsp;  Today's Flight
                          </div>
                      </a>
                  </li>
				  
				  
				  <li>
                      <a href='homepage.php' class='panel-close'>
                          <div class='item-title'> 
                              <!--<i class='icon f7-icons ios-only'>search</i>-->
                              <img src='../assets/images/icons/icons8-calendar-96.png' style='float: left; display: inline-block;' width='25' height=''> &nbsp;&nbsp;  Search Flight
                          </div>
                      </a>
                  </li>
                  
                  <li>
                      <a href='homepage.php' class='panel-close'>
                          <div class='item-title'> 
                              <!--<i class='icon f7-icons ios-only'>document_text</i>-->
                              <img src='../assets/images/icons/icons8-globe-96.png' style='float: left; display: inline-block;' width='25' height=''> &nbsp;&nbsp;  Operations Area
                          </div>
                      </a>
                  </li>
				  
                  <li>
                      <a href='homepage.php' class='panel-close'>
                          <div class='item-title'> 
                              <!--<i class='icon f7-icons ios-only'>person</i>-->
                              <img src='../assets/images/icons/icons8-stormy-weather-96.png' style='float: left; display: inline-block;' width='25' height=''> &nbsp;&nbsp;  Weather
                          </div>
                      </a>
                  </li>
				  
                  <li>
                      <a href='homepage.php' class='panel-close'>
                          <div class='item-title'> 
                              <!--<i class='icon f7-icons ios-only'>bolt</i>-->
                              <img src='../assets/images/icons/icons8-push-notifications-96.png' style='float: left; display: inline-block;' width='25' height=''> &nbsp;&nbsp;  Notifications
                          </div>
                      </a>
                  </li>  
				  
                  <li>                  
                      <a href='homepage.php' class='panel-close'>
                          <div class='item-title'> 
                              <!--<i class='icon f7-icons ios-only'>keyboard_fill</i>-->
                              <img src='../assets/images/icons/icons8-settings-96.png' style='float: left; display: inline-block;' width='25' height=''> &nbsp;&nbsp;  Settings
                          </div>
                      </a>
                  </li>

                  	<li class='accordion-item'>
                        <a href='' class='item-link item-content'>
                            <div class='item-title'>    
                                <!--<i class='icon f7-icons ios-only'>menu</i>-->
                                <img src='../assets/images/icons/icons8-website-96.png' style='float: left; display: inline-block;' width='25' height=''> &nbsp;&nbsp; Links
                            </div>                        
                        </a>
                        <div class='accordion-item-content'>
                            <a href='https://webmail.weststar-aviation.aero/owa' class='panel-open link external'>
                             Outlook Web Apps 
                            </a>
							<a href='https://wess.weststar-aviation.aero/UserLogin.aspx' class='panel-open link external'>
                             WESS 
                            </a>
							<a href='https://qpulse.weststar-aviation.aero/QPulseWeb/UI/Open/Login.aspx' class='panel-open link external'>
                             Q - Pulse 
                            </a>
							<a href='https://qpulse.weststar-aviation.aero/reporting' class='panel-open link external'>
                             Q - Pulse Reporting
                            </a>
							<a href='http://learn.gaelacademy.com/Public/Homepage.aspx' class='panel-open link external'>
                             Gael Academy 
                            </a>
							<a href='https://logbook.offshoreflightplan.co.uk/login/index' class='panel-open link external'>
                             OFP Pilot Logbook
                            </a>
							<a href='https://training.ctsys.com/cts/CompanyUsers/index.cfm?event=Common.ViewLogin#' class='panel-open link external'>
                             Pilot CTS 
                            </a>
                        </div>
                    </li>
                </ul>
              </div>
	";	
}


































































////////////////////////////////////////////////////////////////KOTA BHARU BASE/////////////////////////////////////////////////////////////////////


//top-body :: display duty captain, flight count & percentage, passenger count & percentage

function kb_fliCount(){
	
	/*Count total number of flights for the current day*/

	global $con2;
	$today_date = date('Y-m-d');

	$flight = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date'";
	
	if ($selectfli = $con2 -> prepare ($flight)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count." Flights";
		}else{
			echo "No Flight";
		}	
	}//end if ($selectfli)
}




function kb_fliCount2(){
	
	/*Count total number of flights for the current day*/

	global $con2;
	$today_date = date('Y-m-d');
	
	if(isset($_GET['search_fli'])){
	$s_frodat = date('Y,m,d', strtotime($_GET['frodate']));
	$s_todat = date('Y,m,d', strtotime($_GET['todate']));

	$flight2 = "SELECT fsNum FROM flightschedule WHERE fsDate >= '$s_frodat' AND fsDate <= '$s_todat'";
	
	if ($selectfli = $con2 -> prepare ($flight2)){
		
		$selectfli -> execute();
		$count = $selectfli -> rowCount();
	
		if($count != NULL){
			echo $count." Flights Found";
		}else{
			echo "No Flight";
		}	
	}//end if ($selectfli)
	}//end if (search_fli)
}





function kb_fliPercent(){
	
	/* Count percentage of flights for (current day/yesterday) */
	
	global $con2;	
	$today_date = date('Y-m-d');

	$todayfli = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date'";
	$preptodfli = $con2 -> prepare($todayfli);
	$preptodfli -> execute();
	$count_today = $preptodfli -> rowCount();
	

	$date = strtotime(date('Y-m-d'));
	$yesterday_date = date('Y-m-d', strtotime('-1days',$date));

	$yesterdayfli = "SELECT fsNum FROM flightschedule WHERE fsDate='$yesterday_date'";
	$prepyesfli = $con2 -> prepare($yesterdayfli);
	$prepyesfli -> execute();
	$count_yesterday = $prepyesfli -> rowCount();

	
		if($count_yesterday != NULL){
			$count_row = ($count_today/$count_yesterday);
			echo "<small class='text-success text-size-base'><i class='icon-arrow-up12'></i>".round($count_row,1)."%</small>";
		}else{
			echo "<small class='text-success text-size-base'></i>(0.0%)</small>";	
		}
}











///////////////////////////////////////////////////////////kb_crew_pilot.php chart//////////////////////////////////////////////////////////////////////////

function kb_captainCount(){
	
	/*Count total number of captain*/

	global $con2;
	$today_date = date('Y-m-d');

	$captain = "SELECT pilotNum FROM pilot WHERE pilotTitle='Captain' AND pilotBase = 'KBR'";
	
	if ($selectcap = $con2 -> prepare ($captain)){
		
		$selectcap -> execute();
		$count = $selectcap -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}

function kb_foCount(){
	
	/*Count total number of fo*/

	global $con2;
	$today_date = date('Y-m-d');

	$fo = "SELECT pilotNum FROM pilot WHERE pilotTitle='First Officer' AND pilotBase = 'KBR'";
	
	if ($selectfo = $con2 -> prepare ($fo)){
		
		$selectfo -> execute();
		$count = $selectfo -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_sfoCount(){
	
	/*Count total number of sfo*/

	global $con2;
	$today_date = date('Y-m-d');

	$sfo = "SELECT pilotNum FROM pilot WHERE pilotTitle='Senior First Officer' AND pilotBase = 'KBR'";
	
	if ($selectsfo = $con2 -> prepare ($sfo)){
		
		$selectsfo -> execute();
		$count = $selectsfo -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function kb_cadetCount(){
	
	/*Count total number of cadet*/

	global $con2;
	$today_date = date('Y-m-d');

	$cadet = "SELECT pilotNum FROM pilot WHERE pilotTitle='Cadet' AND pilotBase = 'KBR'";
	
	if ($selectcadet = $con2 -> prepare ($cadet)){
		
		$selectcadet -> execute();
		$count = $selectcadet -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function kb_localCount(){
	
	/*Count total number of local pilot*/

	global $con2;
	$today_date = date('Y-m-d');

	$local = "SELECT pilotNum FROM pilot WHERE pilotNationality='Local' AND pilotBase = 'KBR'";
	
	if ($selectlocal = $con2 -> prepare ($local)){
		
		$selectlocal -> execute();
		$count = $selectlocal -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_expatCount(){
	
	/*Count total number of expat pilot*/

	global $con2;
	$today_date = date('Y-m-d');

	$expat = "SELECT pilotNum FROM pilot WHERE pilotNationality='Expatriate' AND pilotBase = 'KBR'";
	
	if ($selectexpat = $con2 -> prepare ($expat)){
		
		$selectexpat -> execute();
		$count = $selectexpat -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}




///////////////////////////////////////////////////////////kb_flight_support.php chart//////////////////////////////////////////////////////////////////////////

function kb_FOOCount(){
	
	/*Count total number of KB Flight Operation Officer*/

	global $con2;
	$today_date = date('Y-m-d');

	$foo = "SELECT fosNum FROM focuser WHERE fosUnit='Flight Operations Officer' AND fosBase = 'KBR'";
	
	if ($selectfoo = $con2 -> prepare ($foo)){
		
		$selectfoo -> execute();
		$count = $selectfoo -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_FOACount(){
	
	/*Count total number of KB Flight Operation Administrator*/

	global $con2;
	$today_date = date('Y-m-d');

	$foa = "SELECT fosNum FROM focuser WHERE fosUnit='Flight Operations Administrator' AND fosBase = 'KBR'";
	
	if ($selectfoa = $con2 -> prepare ($foa)){
		
		$selectfoa -> execute();
		$count = $selectfoa -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_FOTCount(){
	
	/*Count total number of KB Flight Operation Training*/

	global $con2;
	$today_date = date('Y-m-d');

	$fot = "SELECT fosNum FROM focuser WHERE fosUnit='Flight Operations Training' AND fosBase = 'KBR'";
	
	if ($selectfot = $con2 -> prepare ($fot)){
		
		$selectfot -> execute();
		$count = $selectfot -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_PlannerCount(){
	
	/*Count total number of KB Flight Planner*/

	global $con2;
	$today_date = date('Y-m-d');

	$planner = "SELECT fosNum FROM focuser WHERE fosUnit='Flight Planner' AND fosBase = 'KBR'";
	
	if ($selectplanner = $con2 -> prepare ($planner)){
		
		$selectplanner -> execute();
		$count = $selectplanner -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_ROCount(){
	
	/*Count total number of KB RO*/

	global $con2;
	$today_date = date('Y-m-d');

	$ro = "SELECT fosNum FROM focuser WHERE fosUnit='Radio Operator' AND fosBase = 'KBR'";
	
	if ($selectro = $con2 -> prepare ($ro)){
		
		$selectro -> execute();
		$count = $selectro -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}




function kb_BaggageCount(){
	
	/*Count total number of KB Baggage Handler*/

	global $con2;
	$today_date = date('Y-m-d');

	$baggage = "SELECT fosNum FROM focuser WHERE fosUnit='Baggage Handler' AND fosBase = 'KBR'";
	
	if ($selectbaggage = $con2 -> prepare ($baggage)){
		
		$selectbaggage -> execute();
		$count = $selectbaggage -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function kb_PaxCount(){
	
	/*Count total number of KB Pax*/

	global $con2;
	$today_date = date('Y-m-d');

	$pax = "SELECT fosNum FROM focuser WHERE fosUnit='Pax Handler' AND fosBase = 'KBR'";
	
	if ($selectpax = $con2 -> prepare ($pax)){
		
		$selectpax -> execute();
		$count = $selectpax -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


						
						
						
						
						

///////////////////////////////////////////////////////////kb_crew_engineering.php chart//////////////////////////////////////////////////////////////////////////


function kb_englocalCount(){
	
	/*Count total number of local eng*/

	global $con2;
	$today_date = date('Y-m-d');

	$englocal = "SELECT engNum FROM engineer WHERE engNationality='Local' AND engBase = 'KBR'";
	
	if ($selectenglocal = $con2 -> prepare ($englocal)){
		
		$selectenglocal -> execute();
		$count = $selectenglocal -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_engexpatCount(){
	
	/*Count total number of expat eng*/

	global $con2;
	$today_date = date('Y-m-d');

	$engexpat = "SELECT engNum FROM engineer WHERE engNationality='Expat' AND engBase = 'KBR'";
	
	if ($selectengexpat = $con2 -> prepare ($engexpat)){
		
		$selectengexpat -> execute();
		$count = $selectengexpat -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function kb_ancengineerCount(){
	
	/*Count total number of anc engineer*/

	global $con2;
	$today_date = date('Y-m-d');

	$ancengineer = "SELECT engNum FROM engineer WHERE engTitle='A&C Engineer' AND engBase = 'KBR'";
	
	if ($selectancengineer = $con2 -> prepare ($ancengineer)){
		
		$selectancengineer -> execute();
		$count = $selectancengineer -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function kb_anctechCount(){
	
	/*Count total number of anctech*/

	global $con2;
	$today_date = date('Y-m-d');

	$anctech = "SELECT engNum FROM engineer WHERE engTitle='A&C Technician' AND engBase = 'KBR'";
	
	if ($selectanctech = $con2 -> prepare ($anctech)){
		
		$selectanctech -> execute();
		$count = $selectanctech -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_aviengineerCount(){
	
	/*Count total number of aviengineer*/

	global $con2;
	$today_date = date('Y-m-d');

	$aviengineer = "SELECT engNum FROM engineer WHERE engTitle='Avionic Engineer' AND engBase = 'KBR'";
	
	if ($selectaviengineer = $con2 -> prepare ($aviengineer)){
		
		$selectaviengineer -> execute();
		$count = $selectaviengineer -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_avitechCount(){
	
	/*Count total number of avitech*/

	global $con2;
	$today_date = date('Y-m-d');

	$avitech = "SELECT engNum FROM engineer WHERE engTitle='Avionic Technician' AND engBase = 'KBR'";
	
	if ($selectavitech = $con2 -> prepare ($avitech)){
		
		$selectavitech -> execute();
		$count = $selectavitech -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}







///////////////////////////////////////////////////////////kb_operation_list.php chart//////////////////////////////////////////////////////////////////////////


function kb_baseCount(){
	
	/*Count total number of operations base*/

	global $con2;
	$today_date = date('Y-m-d');

	$base = "SELECT areaNum FROM opsarea WHERE areaType='Base' AND areaBase = 'KTE'";
	
	if ($selectbase = $con2 -> prepare ($base)){
		
		$selectbase -> execute();
		$count = $selectbase -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_fixedCount(){
	
	/*Count total number of operations fixed*/

	global $con2;
	$today_date = date('Y-m-d');

	$fixed = "SELECT areaNum FROM opsarea WHERE areaType='Fixed' AND areaBase = 'KTE'";
	
	if ($selectfixed = $con2 -> prepare ($fixed)){
		
		$selectfixed -> execute();
		$count = $selectfixed -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function kb_mobileCount(){
	
	/*Count total number of operations mobile*/

	global $con2;
	$today_date = date('Y-m-d');

	$mobile = "SELECT areaNum FROM opsarea WHERE areaType='Mobile' AND areaBase = 'KTE'";
	
	if ($selectmobile = $con2 -> prepare ($mobile)){
		
		$selectmobile -> execute();
		$count = $selectmobile -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}





function kb_petronasCount(){
	
	/*Count total number of petronas operations area*/

	global $con2;
	$today_date = date('Y-m-d');

	$petronas = "SELECT areaNum FROM opsarea WHERE clientID='petronas.jpg' AND areaBase = 'KTE'";
	
	if ($selectpetronas = $con2 -> prepare ($petronas)){
		
		$selectpetronas -> execute();
		$count = $selectpetronas -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_emepmiCount(){
	
	/*Count total number of emepmi operations area*/

	global $con2;
	$today_date = date('Y-m-d');

	$emepmi = "SELECT areaNum FROM opsarea WHERE clientID='exxon.jpg' AND areaBase = 'KTE'";
	
	if ($selectemepmi = $con2 -> prepare ($emepmi)){
		
		$selectemepmi -> execute();
		$count = $selectemepmi -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function kb_enquestCount(){
	
	/*Count total number of enquest operations area*/

	global $con2;
	$today_date = date('Y-m-d');

	$enquest = "SELECT areaNum FROM opsarea WHERE clientID='enquest.jpg' AND areaBase = 'KTE'";
	
	if ($selectenquest = $con2 -> prepare ($enquest)){
		
		$selectenquest -> execute();
		$count = $selectenquest -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_petrofacCount(){
	
	/*Count total number of petrofac operations area*/

	global $con2;
	$today_date = date('Y-m-d');

	$petrofac = "SELECT areaNum FROM opsarea WHERE clientID='petrofac.jpg' AND areaBase = 'KTE'";
	
	if ($selectpetrofac = $con2 -> prepare ($petrofac)){
		
		$selectpetrofac -> execute();
		$count = $selectpetrofac -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_sapuraCount(){
	
	/*Count total number of sapura operations area*/

	global $con2;
	$today_date = date('Y-m-d');

	$sapura = "SELECT areaNum FROM opsarea WHERE clientID='sapura.jpg' AND areaBase = 'KTE'";
	
	if ($selectsapura = $con2 -> prepare ($sapura)){
		
		$selectsapura -> execute();
		$count = $selectsapura -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}




///////////////////////////////////////////////////////////kb_daily_schedule.php chart//////////////////////////////////////////////////////////////////////////


function kb_dailypetronasCount(){
	
	/*Count total daily flight number*/

	global $con2;
	$today_date = date('Y-m-d');
	
	$dailypetronas = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND clientID = 'PC'";
	
	if ($selectdailypetronas = $con2 -> prepare ($dailypetronas)){
		
		$selectdailypetronas -> execute();
		$count = $selectdailypetronas -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_dailyemepmiCount(){
	
	/*Count total daily flight number*/

	global $con2;
	$today_date = date('Y-m-d');
	
	$dailyemepmi = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND clientID = 'EM'";
	
	if ($selectdailyemepmi = $con2 -> prepare ($dailyemepmi)){
		
		$selectdailyemepmi -> execute();
		$count = $selectdailyemepmi -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}


function kb_dailysapuraCount(){
	
	/*Count total daily flight number*/

	global $con2;
	$today_date = date('Y-m-d');
	
	$dailysapura = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND clientID = 'SK'";
	
	if ($selectdailysapura = $con2 -> prepare ($dailysapura)){
		
		$selectdailysapura -> execute();
		$count = $selectdailysapura -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}

function kb_dailyenquestCount(){
	
	/*Count total daily flight number*/

	global $con2;
	$today_date = date('Y-m-d');
	
	$dailyenquest = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND clientID = 'EN'";
	
	if ($selectdailyenquest = $con2 -> prepare ($dailyenquest)){
		
		$selectdailyenquest -> execute();
		$count = $selectdailyenquest -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



function kb_dailypetrofacCount(){
	
	/*Count total daily flight number*/

	global $con2;
	$today_date = date('Y-m-d');
	
	$dailypetrofac = "SELECT fsNum FROM flightschedule WHERE fsDate='$today_date' AND clientID = 'PETRO'";
	
	if ($selectdailypetrofac = $con2 -> prepare ($dailypetrofac)){
		
		$selectdailypetrofac -> execute();
		$count = $selectdailypetrofac -> rowCount();
	
		if($count != NULL){
			echo $count."";
		}else{
			echo "0";
		}	
	}//end if ($selectfli)
}



































//Main Navbar Profile n Image Name
function kb_mainNavbar(){
	
	global $con2;
    $user = $_SESSION['UID'];
    $timestamp = time();
    $php_timestamp_date = date('y,m,d', $timestamp);
	
	
	/*retrieve pilot details from database*/

	//SQL query
	$sql = "SELECT * FROM pilot";
	
	if ( $selectsql = $con2 -> prepare ($sql)) // Prepare the SQL query
	{
		// Execute statement
		$selectsql -> execute();
		
		// Set fetch mode to FETCH_ASSOC to return an array indexed by column name
		$selectsql -> setFetchMode(PDO::FETCH_ASSOC);
		
		// Fetch result
		while($row = $selectsql -> fetchColumn()){
		
			$dcID = $row['pilotID'];
			$dcName = $row['pilotName'];
			$dcImage = $row['pilotPhoto'];	
		}	
		
	}



/*retrieve user details from database*/	

	$sql2 = "SELECT * FROM user WHERE userName='$user'";
	
	if ( $selectsql2 = $con2 -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
		}
	
	}

/*retrieve englogin details from database*/	

	$sql2 = "SELECT * FROM englogin WHERE userName='$user'";
	
	if ( $selectsql2 = $con2 -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
		}
	
	}
	
	
	/*retrieve foologin details from database*/	

	$sql2 = "SELECT * FROM foologin WHERE userName='$user'";
	
	if ( $selectsql2 = $con2 -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
		}
	
	}
	
	
	/*retrieve rologin details from database*/	

	$sql2 = "SELECT * FROM rologin WHERE userName='$user'";
	
	if ( $selectsql2 = $con2 -> prepare ($sql2)) 
	{
		// Bind parameters to statement variables
		//$selectsql2 -> bindParam(':id', $user);
		
		$selectsql2 -> execute();
	
		while($row = $selectsql2 -> fetch(PDO::FETCH_ASSOC)){
		
			$ID = $row['userName'];
			$Name = $row['userFullname'];
			$Photo = $row['userPhoto'];	
		}
	
	}




/*retrieve administrator details from database*/

	$sql3 = "SELECT * FROM administrator WHERE adminID='$user'";
	
	if ( $selectsql3 = $con2 -> prepare ($sql3)) 
	{
		// Bind parameters to statement variables
		//$selectsql3 -> bindParam(':id', $user);
		
		$selectsql3 -> execute();
	
		while($row = $selectsql3 -> fetch(PDO::FETCH_ASSOC)){
			
		      $ID = $row['adminID'];
			$Name = $row['adminName'];
			$Photo = $row['adminPhoto'];	
		}
	}
	
	
/*retrieve foc user details from database*/

	$sql4 = "SELECT * FROM focuser WHERE fosID='$user'";
	
	if ( $selectsql4 = $con2 -> prepare ($sql4)) 
	{
		// Bind parameters to statement variables
		//$selectsql4 -> bindParam(':id', $user);
		
		$selectsql4 -> execute();
	
		while($row = $selectsql4 -> fetch(PDO::FETCH_ASSOC)){
		
			$Name = $row['fosFullname'];
			$Photo = $row['fosPhoto'];	
		}
	}

	
/*retrieve login details from database*/

	$out = "SELECT logNum FROM loguserin WHERE logUsername='$user'";	
	$prepout = $con2 -> prepare ($out);
	$prepout -> execute();
	
		while($row = $prepout -> fetch(PDO::FETCH_ASSOC)){
		
			$log_code = $row['logNum'];	
		}
	
	//Close the connection to the database
	//$con2 = null;
	
	
	
	
	
	echo "
	
	<div class='navbar-header'>
			<a class='navbar-brand' href='kb_daily_schedule.php'><img src='../../assets/images/logo_light.png' alt=''></a>
			<ul class='nav navbar-nav pull-right visible-xs-block'>
				<li><a data-toggle='collapse' data-target='#navbar-mobile'><i class='icon-paragraph-justify3'></i></a></li>
			</ul>
	</div>	
	
	<div class='navbar-collapse collapse' id='navbar-mobile'>
		
		    <p class='navbar-text'><span class='label bg-success-400'>KBR BASE</span></p>
			
			<ul class='nav navbar-nav'>
				<li class='dropdown' data-popup='tooltip' title='FullScreen' data-placement='bottom' onclick='toggleFullScreen();'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
						<img src='../../assets/images/icons/full-screen.png' alt='' width='23' height=''>
						<span class='visible-xs-inline-block position-right'>Full Screen</span>
					</a>
				</li>
                                                
				<li class='dropdown' data-popup='tooltip' title='Refresh' data-placement='bottom' type='submit'  onClick='refreshPage();'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
						<img src='../../assets/images/icons/refresh4.png' alt='' width='26' height=''>
						<span class='visible-xs-inline-block position-right'>Refresh</span>
					</a>
				</li>
			</ul>
			
			<ul class='nav navbar-nav navbar-right'>
			
	<li class='dropdown dropdown-user'>
					<a class='dropdown-toggle'' data-toggle='dropdown'>
						<img src='../../assets/images/users/$Photo' alt=''>
						<span>$Name</span>
						<i class='caret'></i>
					</a>

					<ul class='dropdown-menu dropdown-menu-right'>
						<li><a href='#'><img src='../../assets/images/icons/icons8-customer-80.png' class='position-left' alt='' width='20' height=''> My profile</a></li>
						<!--<li><a href='#'><span class='badge badge-warning pull-right'>58</span> <i class='icon-comment-discussion'></i> Messages</a></li>-->
						<li class='divider'></li>
						<li><a href='#'><img src='../../assets/images/icons/icons8-settings-80.png' class='position-left' alt='' width='19' height=''> Settings</a></li>
						<li><a href='kb_logout.php?logoutcode=<?php echo $log_code; ?>' ><img src='../../assets/images/icons/icons8-shutdown-80.png' class='position-left' alt='' width='19' height=''> Logout</a></li>
					</ul>
				</li>
				
			</ul>
			
			<ul class='nav navbar-nav navbar-right'>
			<form class='navbar-form navbar-left'>
			<div class='form-group has-feedback'>
			<input type='search' class='form-control' placeholder='Search'>
			<div class='form-control-feedback'>
			<i class='icon-search4 text-muted text-size-base'></i>
			</div>
			</div>
			</form>
			</ul>
				
	</div>		
				
	";	
}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//Second Navbar
function kb_fidsMenu(){
	
	echo "
	
	
	<!-- Second navbar -->
	<div class='navbar navbar-default' id='navbar-second'>
		<ul class='nav navbar-nav no-border visible-xs-block'>
			<li><a class='text-center collapsed' data-toggle='collapse' data-target='#navbar-second-toggle'><i class='icon-menu7'></i></a></li>
		</ul>

		<div class='navbar-collapse collapse' id='navbar-second-toggle'>
			<ul class='nav navbar-nav'>
			
                
				
				<!--Dashboard-->
                
				<li class=''><a href='kb_index.php' class='text-default text-semibold'><img src='../../assets/images/icons/analysis.png' class='position-left' alt='' width='25' height=''> Dashboard</a>
                </li>
				
				
				<!--Flight Information-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='../../assets/images/icons/eta.png' class='position-left' alt='' width='25' height=''> Flight <span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-300'>
						<li class='dropdown-header'>Flight Schedule</li>
						<li><a href='kb_daily_schedule.php'><img src='../../assets/images/icons/atd.png' class='position-left' alt='' width='25' height='25'>Daily Flight Schedule</a></li>
						<li><a href='kb_daily_schedule_tomorrow.php'><img src='../../assets/images/icons/tomorrow.png' class='position-left' alt='' width='25' height='25'>Tomorrow's Flight Schedule</a></li>
					    <li><a href='kb_flighist_dis.php'><img src='../../assets/images/icons/icons8-schedule-96.png' class='position-left' alt='' width='25' height='25'>Flight History</a></li>
					</ul>
				</li>
			
				
				</li>
				
                <!--Aircraft Status-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='../../assets/images/icons/helicopter copy.png' class='position-left' alt='' width='27' height=''> Aircraft <span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-200'>
						<li class='dropdown-header'>Aircraft Status</li>
						<li><a href='kb_aircraft_status.php'><img src='../../assets/images/icons/helicopter copy.png' class='position-left' alt='' width='25' height=''> Daily Aircraft Status</a></li>
						<li><a href='kb_aircraft_base.php'><img src='../../assets/images/icons/icons8-skyscrapers-80.png' class='position-left' alt='' width='20' height=''> Aircraft at Base</a></li>
                        <li><a href='kb_aircraft_list.php'><img src='../../assets/images/icons/icons8-pass-fail-80.png' class='position-left' alt='' width='20' height=''> List of Aircraft</a></li>
					</ul>
				</li>
                
				
				<!--Crew-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='../../assets/images/icons/teamwork2.png' class='position-left' alt='' width='27' height=''>Crew<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-400'>
						<li class='dropdown-header'>Flight Operations</li>
                        <li><a href='kb_crew_pilot.php'><img src='../../assets/images/icons/icons8-account-80.png' class='position-left' alt='' width='19' height=''> Pilot</a></li>
						<li><a href='kb_flight_support.php'><img src='../../assets/images/icons/icons8-people-80.png' class='position-left' alt='' width='21' height=''> Flight Operations Support</a></li>
						
						<li class='dropdown-header'>Engineering</li>
                        <li><a href='kb_crew_engineering.php'><img src='../../assets/images/icons/icons8-engineer-80.png' class='position-left' alt='' width='19' height=''>Engineer & Technician</a></li>
						<li><a href='kb_engineering_support.php'><img src='../../assets/images/icons/icons8-people-80.png' class='position-left' alt='' width='21' height=''>Engineering Operations Support</a></li>
					</ul>
				</li>
				
				
				<!--Client-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='../../assets/images/icons/cooperation.png' class='position-left' alt='' width='27' height=''>Client<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-200'>
						<li class='dropdown-header'>Client</li>
						<li><a href='client.php'><img src='../../assets/images/icons/client.png' class='position-left' alt='' width='19' height=''>JOPS</a></li>
						
						</ul>
				</li>
				
				
				<!--Safety
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='../../assets/images/icons/icons8-stethoscope-80.png' class='position-left' alt='' width='20' height=''>Safety<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-300'>
						<li class='dropdown-header'>Q - Pulse Report</li>
						<li><a href='qpulseflight_technical.php'><img src='../../assets/images/icons/icons8-treatment-80.png' class='position-left' alt='' width='19' height=''>Flight / Technical Occurrence Report</a></li>
						</ul>
				</li>
				
				-->
				
                <!--Area of Operations-->
                
                 <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='../../assets/images/icons/icons8-globe-96.png' class='position-left' alt='' width='27' height=''>Operations Area<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-200'>
						<li class='dropdown-header'>Operations Area </li>
						<li><a href='map-fullscreen.php'><img src='../../assets/images/icons/icons8-map-marker-80.png' class='position-left' alt='' width='19' height=''> Operations Area</a></li>
						<li><a href='operation_list.php'><img src='../../assets/images/icons/icons8-pass-fail-80.png' class='position-left' alt='' width='19' height=''> List of Operations Area</a></li>
					</ul>
				</li>
				
				
				<!--Weather-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='../../assets/images/icons/cloudy.png' class='position-left' alt='' width='25' height=''>Weather<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-400'>
						<li class='dropdown-header'>Weather Forecast</li>
						<li><a href='weather_kertih.php'><img src='../../assets/images/icons/icons8-sun-80.png' class='position-left' alt='' width='22' height=''> Kertih Weather Forecast</a></li>
                        <li><a href='weather.php'><img src='../../assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='19' height=''> Weather Forecast Map</a></li>
						
						
						<li class='dropdown-header'>Satellite Images</li>
                        <li><a href='himawari_satellite.php'><img src='../../assets/images/icons/icons8-satellite-signal-80.png' class='position-left' alt='' width='19' height=''>HIMAWARI Satellite</a></li>
						<li><a href='fy2_satellite.php'><img src='../../assets/images/icons/icons8-gps-signal-80.png' class='position-left' alt='' width='19' height=''> FY-2 Satellite</a></li>
						
						<li class='dropdown-header'>Radar Images</li>
                        <li><a href='peninsular_radar.php'><img src='../../assets/images/icons/icons8-radar-80.png' class='position-left' alt='' width='23' height=''>Merged Peninsular Malaysia CAPPI</a></li>
						<li><a href='rains_radar.php'><img src='../../assets/images/icons/icons8-radar-80.png' class='position-left' alt='' width='23' height=''>Radar Integrated Nowcasting System (RAINS)</a></li>
						
						<li class='dropdown-header'>Malaysia Meteorology System</li>
						<li><a href='abt.php'><img src='../../assets/images/icons/icons8-user-manual-80.png' class='position-left' alt='' width='19' height=''> Aviation Briefing Terminal</a></li>
					</ul>
				</li>
				
				
				
				<!--Weather
				
				    <li class='dropdown mega-menu mega-menu-wide'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'><img src='assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='20' height=''> Weather <span class='caret'></span></a>

					<div class='dropdown-menu dropdown-content'>
						<div class='dropdown-content-body'>
							<div class='row'>
								<div class='col-md-3'>
									<span class='menu-heading underlined'>Weather Forecast</span>
									<ul class='menu-list'>
										<li><a href='weather.php'><img src='../../assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='19' height=''> Weather Forecast</a></li>
										<li><a href='abt.php'><img src='../../assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='19' height=''> Aviation Briefing Terminal</a></li>
										<li><a href='weather_globe.php'><img src='../../assets/images/icons/icons8-stormy-weather-80.png' class='position-left' alt='' width='19' height=''> Weather Globe</a></li>
									</ul>
								</div>
								<div class='col-md-3'>
									<span class='menu-heading underlined'>WARNING & ADVISORIES</span>
									<ul class='menu-list'>
									    <li>
											<li><a href='volcanic_advisory.php'><img src='../../assets/images/icons/icons8-volcano-80.png' class='position-left' alt='' width='19' height=''>Volcanic Ash Advisory</a></li>
											<li><a href='weather.php'><img src='../../assets/images/icons/icons8-tornado-80.png' class='position-left' alt='' width='19' height=''> Tropical Cyclone and Typhoon Advisory</a></li>
											<li><a href='aero_warning_local.php'><img src='../../assets/images/icons/icons8-alert-80.png' class='position-left' alt='' width='19' height=''> Aerodrome Warning for Local Airports</a></li>
											<li><a href='weather.php'><img src='../../assets/images/icons/icons8-alert-80.png' class='position-left' alt='' width='19' height=''> Aerodrome Warning for WMKK</a></li>
										</li>
									
										
										<li>
											<a href='#'><img src='../../assets/images/icons/icons8-documents-80.png' class='position-left' alt='' width='19' height=''>SIGMET / AIRMET Bulletin</a>
											<ul>
												<li><a href='#'>Domestic SIGMET Bulletin</a></li>
												<li><a href='#'>Domestic Airmet Bulletin</a></li>
												<li><a href='#'>Asean SIGMET / AIRMET Bulletin</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<div class='col-md-3'>
									<span class='menu-heading underlined'>PILOT BRIEFING</span>
									<ul class='menu-list'>
										<li>
											<a href='#'><img src='../../assets/images/icons/icons8-airplane-take-off-80.png' class='position-left' alt='' width='19' height=''> Domestic Flight Route</a>
											<ul>
												<li><a href='#'>Domestic METAR Bulletin</a></li>
												<li><a href='#'>Domestic TAF Bulletin</a></li>
												<li><a href='#'>Domestic SIGMET Bulletin</a></li>
												<li><a href='#'>Domestic AIRMET Bulletin</a></li>
												<li><a href='#'>Forecast Upper Winds</a></li>
												<li><a href='echarts_funnels_chords.html'>Domestic - Wind & Temperature Chart</a></li>
												<li><a href='echarts_candlesticks_others.html'>Domestic Significant Weather Chart</a></li>
											</ul>
										</li>
										<li>
											<a href='#'><img src='../../assets/images/icons/icons8-airplane-take-off-80.png' class='position-left' alt='' width='19' height=''>ASEAN Flight Route</a>
											<ul>
												<li><a href='d3_lines_basic.html'>ASEAN METAR Bulletin</a></li>
												<li><a href='d3_lines_advanced.html'>ASEAN TAF Bulletin</a></li>
												<li><a href='d3_bars_basic.html'>ASEAN SIGMET / AIRMET Bulletin</a></li>
												<li><a href='d3_bars_advanced.html'>ASEAN - Wind & Temperature Chart</a></li>
												<li><a href='d3_pies.html'>ASEAN Significant Weather Chart</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<div class='col-md-3'>
									<span class='menu-heading underlined'>SATELLITE IMAGES</span>
									<ul class='menu-list'>
										<li><a href='weather_1.php'><img src='../../assets/images/icons/icons8-satellite-signal-80.png' class='position-left' alt='' width='19' height=''>HIMAWARI Satellite</a></li>
						                <li><a href='weather_3.php'><img src='../../assets/images/icons/icons8-gps-signal-80.png' class='position-left' alt='' width='19' height=''> FY-2 Satellite</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</li>
	
				End of Weather-->
				
				
			<!--Publications-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='../../assets/images/icons/contact-book.png' class='position-left' alt='' width='25' height=''>Publications<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-300'>
						<li class='dropdown-header'>Publications</li>
						<li><a href='aip.php'><img src='../../assets/images/icons/caam.png' class='position-left' alt='' width='25' height=''>Aeronautical Information Publications</a></li>
						</ul>
				</li>	
				
				
			<!--Links-->
                
              <li class='dropdown'>
					<a href='#' class='dropdown-toggle text-default text-semibold' data-toggle='dropdown'>
						<img src='../../assets/images/icons/www.png' class='position-left' alt='' width='25' height=''>Links<span class='caret'></span>
					</a>
					<ul class='dropdown-menu width-350'>
					
					
					<!--Flight Ops-->
					
				    <li class='dropdown-header'>Flight Operations</li>
					<li><a href='https://skyweb.skytrac.ca/Login.aspx?security=ssl' target='_blank'><img src='../../assets/images/icons/skyweb.ico' class='position-left img-circle' alt='' width='30' height=''>Skyweb</a></li>
					<li><a href='https://go.spidertracks.com/registration' target='_blank'><img src='../../assets/images/icons/spidertrack.png' class='position-left img-circle' alt='' width='30' height=''>Spidertrack</a></li>
					
					<li class='dropdown-submenu'>
							<a href='#' target='_blank' class='dropdown-toggle' data-toggle='dropdown'><img src='../../assets/images/icons/ofp.jpg' class='position-left img-circle' alt='' width='30' height=''>Offshore Flight Plan (OFP)</a>
							<ul class='dropdown-menu width-200'>
								<li><a href='http://checks.offshoreflightplan.co.uk' target='_blank'><img src='../../assets/images/icons/ofp.jpg' class='position-left img-circle' alt='' width='30' height=''>OFP Web Checks</a></li>
								<li><a href='https://reports.offshoreflightplan.co.uk/login/index' target='_blank'><img src='../../assets/images/icons/ofp.jpg' class='position-left img-circle' alt='' width='30' height=''>OFP Web Reports</a></li>
								<li><a href='https://logbook.offshoreflightplan.co.uk/login/index' target='_blank'><img src='../../assets/images/icons/ofp.jpg' class='position-left img-circle' alt='' width='30' height=''>OFP Pilot Logbook</a></li>
							</ul>
					</li>
					
					<li><a href='https://training.ctsys.com/cts/CompanyUsers/index.cfm?event=Common.ViewLogin#' target='_blank'><img src='../../assets/images/icons/cts.png' class='position-left img-circle' alt='' width='30' height=''>Computer Training Systems (CTS)</a></li>
					<li><a href='http://ptsjops.weststar-aviation.aero/pts/app/' target='_blank'><img src='../../assets/images/icons/tieto.png' class='position-left img-circle' alt='' width='30' height=''>Personnel Transportation Solution (PTS)</a></li>
					
					
					
					<!--Engineering-->
					
					<li class='dropdown-header'>Engineering</li>
				    <li><a href='https://www.campsystems.com/' target='_blank'><img src='../../assets/images/icons/camp2.png' class='position-left' alt='' width='30' height=''>CAMP Systems</a></li>
					<li><a href='http://www.infoblast.com.my/infoblastv2/' target='_blank'><img src='../../assets/images/icons/blast.png' class='position-left' alt='' width='35' height=''>TM Infoblast</a></li>
				    
					
					<!--Others-->
					<li class='dropdown-header'>Others</li>
					
					<li class='dropdown-submenu'>
							<a href='#' target='_blank' class='dropdown-toggle' data-toggle='dropdown'><img src='../../assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Q Pulse</a>
							<ul class='dropdown-menu width-250'>
								<li><a href='https://qpulse.weststar-aviation.aero/QPulseWeb/UI/Open/Login.aspx?ReturnUrl=%2fQPulseWeb%2f' target='_blank'><img src='../../assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Q Pulse Web Apps</a></li>
								<li><a href='https://qpulse.weststar-aviation.aero/reporting' target='_blank'><img src='../../assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Q Pulse Web Safety Reporting</a></li>
								<li><a href='https://weststaraviation.gaelrisk.com/Account/Login?ReturnUrl=%2f' target='_blank'><img src='../../assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Gael Risk</a></li>
								<li><a href='http://learn.gaelacademy.com/Public/Homepage.aspx' target='_blank'><img src='../../assets/images/icons/qpulse.png' class='position-left img-circle' alt='' width='30' height=''>Gael Academy</a></li>
							</ul>
					</li>
					
					<li><a href='https://webmail.weststar-aviation.aero/owa' target='_blank'><img src='../../assets/images/icons/owa.jpg' class='position-left img-circle' alt='' width='30' height=''>Outlook Web App (OWA)</a></li>
					<li><a href='https://wess.weststar-aviation.aero/UserLogin.aspx' target='_blank'><img src='../../assets/images/icons/was.png' class='position-left img-circle' alt='' width='35' height=''>Weststar Employee Self Service (WESS)</a></li>
					<li><a href='https://wiz.weststar-aviation.aero' target='_blank'><img src='../../assets/images/icons/wiz.png' class='position-left img-circle' alt='' width='35' height=''>Weststar Intranet Zone (WIZ)</a></li>
					
					</ul>
						

				</li>
				
				
				
			</ul>
			
			
			
			
			
			
			
			

			<ul class='nav navbar-nav navbar-right'>
				<li>
					<a href='changelog.php' class='text-default text-semibold'>
						<img src='../../assets/images/logo/was.png' alt='' width='60' height=''>
						FIDS
						<span class='label label-inline position-right bg-danger-400'>BETA</span>
					</a>		
				</li>

				<!--<li class='dropdown'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
						<img src='../../assets/images/icons/icons8-settings-80.png'  alt='' width='19' height=''>
						<span class='visible-xs-inline-block position-right'>Settings</span>
						<span class='caret'></span>
					</a>

					<ul class='dropdown-menu width-200'>
						<li><a href='#'><img src='../../assets/images/icons/crew-80.png' class='position-left' alt='' width='19' height=''> User Manager</a></li>
						<li><a href='#'><img src='../../assets/images/icons/icons8-airport-80.png' class='position-left' alt='' width='19' height=''>Select Base</a></li>
						<li><a href='#'><img src='../../assets/images/icons/icons8-id-verified-80.png' class='position-left' alt='' width='19' height=''> Roles & Permissions</a></li>
						<li class='divider'></li>
						<li><a href='#'><img src='../../assets/images/icons/icons8-gears-80.png' class='position-left' alt='' width='19' height=''> All settings</a></li>
					</ul>
				</li>-->
			</ul>
		</div>
	</div>
	<!-- /second navbar -->
	
	
	
	
	
	";
	
}






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	


















/*
public class TableTest {
    public static void main(String[] args) {
        JFrame frame = new JFrame();
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        final Color[] rowColors = new Color[] {
                randomColor(), randomColor(), randomColor()
        };
        final JTable table = new JTable(3, 3);
        table.setDefaultRenderer(Object.class, new TableCellRenderer() {
            @Override
            public Component getTableCellRendererComponent(JTable table,
                    Object value, boolean isSelected, boolean hasFocus,
                    int row, int column) {
                JPanel pane = new JPanel();
                pane.setBackground(rowColors[row]);
                return pane;
            }
        });
        frame.setLayout(new BorderLayout());

        JButton btn = new JButton("Change row2's color");
        btn.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                rowColors[1] = randomColor();
                table.repaint();
            }
        });

        frame.add(table, BorderLayout.NORTH);
        frame.add(btn, BorderLayout.SOUTH);
        frame.pack();
        frame.setVisible(true);
    }

    private static Color randomColor() {
        Random rnd = new Random();
        return new Color(rnd.nextInt(256),
                rnd.nextInt(256), rnd.nextInt(256));
    }
}
*/




?>

