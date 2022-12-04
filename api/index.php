<?php

require_once "Careerjet_API.php" ;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$api = new Careerjet_API('en_GB') ;
$page = 1 ; # Or from parameters.

$result = $api->search(array(
  'keywords' => 'php developer',
  'location' => 'London',
  'page' => $page ,
  'affid' => '92a60b31bf3e3bee48fb790bc9568437',
));

if ( $result->type == 'JOBS' ){
  //echo "Found ".$result->hits." jobs" ;
  //echo " on ".$result->pages." pages\n" ;
  $jobs = $result->jobs ;
  
  //make api for frontend to get jobs
  //send json data to frontend
  //make object
  $json = json_encode($jobs);
  echo $json;
  // foreach( $jobs as $job ){
  //   echo " URL:     ".$job->url."\n" ;
  //   echo " TITLE:   ".$job->title."\n" ;
  //   echo " LOC:     ".$job->locations."\n";
  //   echo " COMPANY: ".$job->company."\n" ;
  //   echo " SALARY:  ".$job->salary."\n" ;
  //   echo " DATE:    ".$job->date."\n" ;
  //   echo " DESC:    ".$job->description."\n" ;
  //   echo "\n" ;
  // }

  # Basic paging code
  if( $page > 1 ){
    //echo "Use \$page - 1 to link to previous page\n";
  }
 // echo "You are on page $page\n" ;
  if ( $page < $result->pages ){
   // echo "Use \$page + 1 to link to next page\n" ;
  }
}

# When location is ambiguous
if ( $result->type == 'LOCATIONS' ){
  $locations = $result->solveLocations ;
  foreach ( $locations as $loc ){
   // echo $loc->name."\n" ; # For end user display
    ## Use $loc->location_id when making next search call
    ## as 'location_id' parameter
  }
}
?>