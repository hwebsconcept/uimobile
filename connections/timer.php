<?php
$time_difference = time() - $clock ; 
$seconds = $time_difference ; 
$minutes = round($time_difference / 60 );
$hours = round($time_difference / 3600 ); 
$days = round($time_difference / 86400 ); 
$weeks = round($time_difference / 604800 ); 
$months = round($time_difference / 2419200 ); 
$years = round($time_difference / 29030400 ); 

if($seconds <= 60)
{
$timer="$seconds seconds ago"; 
}
else if($minutes <=60)
{
   if($minutes==1)
   {
     $timer="one minute ago"; 
    }
   else
   {
   $timer="$minutes minutes ago"; 
   }
}
else if($hours <=24)
{
   if($hours==1)
   {
   $timer="one hour ago";
   }
  else
  {
  $timer="$hours hours ago";
  }
}
else if($days <=7)
{
  if($days==1)
   {
   $timer="one day ago";
   }
  else
  {
  $timer="$days days ago";
  }


  
}
else if($weeks <=4)
{
  if($weeks==1)
   {
   $timer="one week ago";
   }
  else
  {
  $timer="$weeks weeks ago";
  }
 }
else if($months <=12)
{
   if($months==1)
   {
   $timer="one month ago";
   }
  else
  {
  $timer="$months months ago";
  }
 
   
}

else
{
if($years==1)
   {
   $timer="one year ago";
   }
  else
  {
  $timer="$years years ago";
  }


}
?>