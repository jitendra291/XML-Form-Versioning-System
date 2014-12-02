<?php 
$file_name=
    $xmldoc = new DOMDocument( );
    $nameElement = $xmldoc->createElement('information');
    $xmldoc->appendChild($nameElement);
    $nameText = $xmldoc->createTextNode("");
    $nameElement->appendChild($nameText);
	  
    $xmldoc->save('xml_version/.xml');




$doc = new DOMDocument(); 
$doc->load( 'main.xml' ); 
   $count=0;
$employees = $doc->getElementsByTagName("student"); 

foreach( $employees as $employee ) 
{ $count=$count+1;
if($count<26){
$locationname = $employee->getAttribute("roll");

  $names = $employee->getElementsByTagName( "gender" ); 
  $name = $names->item(0)->nodeValue; 
   
  $ages= $employee->getElementsByTagName( "name" ); 
  $age= $ages->item(0)->nodeValue; 
   
  $salaries = $employee->getElementsByTagName( "year" ); 
  $salary = $salaries->item(0)->nodeValue; 
  
  $course = $employee->getElementsByTagName( "Course" ); 
  $courses = $course->item(0)->nodeValue;
   
   $resume = $employee->getElementsByTagName( "resume" ); 
  $resume2 = $resume->item(0)->nodeValue;
  
  echo "$name - $age \n- $salary\n $courses \n $resume2 \n $locationname<br>"; 
  }}
?>