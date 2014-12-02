<?php
$name=$_POST['name'];
$gender=$_POST['gender'];
$year2=$_POST['year'];
$course= $_POST['course'];
$version2=$_POST['version3'];
$rollNum=0;
if(empty($course)) 
  {
    echo("You didn't select any Courses.");
  } 
  else
  {
    $N = count($course);
 
   // echo("You selected $N Course(s): ");
	
	if($N==1){
	$total_course=$course[0];
	}
	else {
	$total_course=$course[0];
    for($i=1; $i < $N; $i++)
    {
        $total_course=$total_course . ' ,' . $course[$i];;
    }
	}
  }

  
$uploaddir = 'upload/';
$uploadfile = $uploaddir . basename($_FILES['upload']['name']);		   
if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadfile)) {
    //echo "File is valid, and was successfully uploaded.\n";
} else {
    //echo "Possible file upload attack!\n";
}

  if ($_FILES["upload"]["error"] > 0)
  {
  echo "Error: " . $_FILES["upload"]["error"] . "<br>";
  }
else
  {
  
  echo "Upload: " . $_FILES["upload"]["name"] . "<br>";
  echo "Type: " . $_FILES["upload"]["type"] . "<br>";
  echo "Size: " . ($_FILES["upload"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["upload"]["tmp_name"];
  }
  

  //echo "total no. of count ";
  //echo $n;
  
  /*writing the data in the xml file */
$xmldoc = new DomDocument('2.0');
$xmldoc->preserveWhiteSpace = false;
$xmldoc->formatOutput = true;
if(!$version2){
$file_count = 'version.txt';
$current = file_get_contents($file_count);
$current=$current+1;
$rollNum=$current;
// Write the contents back to the file
file_put_contents($file_count, $current);
}
else
{
$rollNum=$version2;
}
echo "<br>";
echo "Current roll number is : $rollNum";
 $file_name="xml_version/".$rollNum.".xml";
 $file_name2="xml_version\\".$rollNum.".xml";
 $count=0;
   $iterator = new RecursiveDirectoryIterator("xml_version");
   foreach (new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST) as $file) 
   {
   
  // echo $file->getPathname();
   //echo $file_name;
   if($file->getPathname()==$file_name2){$count=$count+1;}
   }
  // echo $count;
   if(!$count && ($version2==0)){
    $xmldoc = new DOMDocument( );
    $nameElement = $xmldoc->createElement('information');
    $xmldoc->appendChild($nameElement);
    $nameText = $xmldoc->createTextNode("");
    $nameElement->appendChild($nameText);
    $xmldoc->save($file_name);
}
if( $xml = file_get_contents( $file_name) ) {
    $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );
	
    // find the headercontent tag
    $root = $xmldoc->getElementsByTagName('information')->item(0);

    // create the <student> tag
    $student = $xmldoc->createElement('student');
    $numAttribute = $xmldoc->createAttribute("roll");
    $numAttribute->value = $rollNum;
    $student->appendChild($numAttribute);

    // add the student tag before the first element in the <headercontent> tag
    $root->insertBefore( $student, $root->firstChild );

    // create other elements and add it to the <student> tag.
    $nameElement = $xmldoc->createElement('name');
    $student->appendChild($nameElement);
    $nameText = $xmldoc->createTextNode($name);
    $nameElement->appendChild($nameText);

    $genderElement = $xmldoc->createElement('gender');
    $student->appendChild($genderElement);
    $genderText = $xmldoc->createTextNode($gender);
    $genderElement->appendChild($genderText);

	$yearElement = $xmldoc->createElement('year');
    $student->appendChild($yearElement);
    $yearText = $xmldoc->createTextNode($year2);
    $yearElement->appendChild($yearText);
	
	$courseElement = $xmldoc->createElement('Course');
    $student->appendChild($courseElement);
    $CourseText = $xmldoc->createTextNode($total_course);
    $courseElement->appendChild($CourseText);
	
	$resumeElement = $xmldoc->createElement('resume');
    $student->appendChild($resumeElement);
    $resumeText = $xmldoc->createTextNode($uploadfile );
    $resumeElement->appendChild($resumeText);
	
    $xmldoc->save($file_name);
}
//echo $version2;
$path="index.php?roll=".$rollNum."";
//echo $path;
header('Refresh: 7; URL='.$path.'');
  ?>