<?php
$roll_num = isset($_GET['roll']) ? $_GET['roll'] : null;
  $dhandle2 = opendir("xml_version/");
	$files = array();
	if($dhandle2){
	 while (false !== ($fname = readdir($dhandle2))) {
      // if the file is not this file, and does not start with a '.' or '..',
      // then store it for later display
      if (($fname != '.') && ($fname != '..') &&
          ($fname != basename($_SERVER['PHP_SELF']))) {
          // store the filename
          $files[] = (is_dir( "./$fname" )) ? "(Dir) {$fname}" : $fname;
	  }
   }
   }
   $n=sizeof($files);
   $file_name="xml_version/".$roll_num.".xml";
if($roll_num!=NULL){
$doc = new DOMDocument(); 
$doc->load($file_name); 
$students = $doc->getElementsByTagName("student");
$count=0;
foreach( $students as $student ) 
{ $count=$count+1;
if($count<2){
$RollNum= $student->getAttribute("roll");

  $name2 = $student->getElementsByTagName( "name" ); 
  $name1 = $name2->item(0)->nodeValue; 
   
  $gender2= $student->getElementsByTagName("gender"); 
  $gender1= $gender2->item(0)->nodeValue; 
   
  $year2 = $student->getElementsByTagName("year"); 
  $year1 = $year2->item(0)->nodeValue; 
  
  $course2 = $student->getElementsByTagName("Course"); 
  $course1= $course2->item(0)->nodeValue;
   
   $resume2 = $student->getElementsByTagName("resume"); 
  $resume1 = $resume2->item(0)->nodeValue;
  
  
  }}
  
$students3 = $doc->getElementsByTagName("student");
$count2=0;
if($roll_num!=NULL) {
  echo "<b>Previous Data according to your Roll Number \n </b><br>"; 
  }
foreach( $students3 as $student1 ) 
{ $count2=$count2+1;

if($count2<10){
$RollNum2= $student1->getAttribute("roll");

  $name3 = $student1->getElementsByTagName( "name" ); 
  $name4 = $name3->item(0)->nodeValue; 
   
  $gender3= $student1->getElementsByTagName("gender"); 
  $gender4= $gender3->item(0)->nodeValue; 
   
  $year3 = $student1->getElementsByTagName("year"); 
  $year4 = $year3->item(0)->nodeValue; 
  
  $course3 = $student1->getElementsByTagName("Course"); 
  $course4= $course3->item(0)->nodeValue;
   
  $resume3 = $student1->getElementsByTagName("resume"); 
  $resume4 = $resume3->item(0)->nodeValue;
 if($roll_num!=NULL) {
  //echo "<b>Previous Data according to your Roll Number \n </b><br>";
 echo "<b>Name </b>: $name4 \n<b>Gender </b>: $gender4 \n <b> Year </b>: $year4 <b>Course : </b> $course4<b> Resume :</b> $resume4\n<br>" ;
  }
  }}}
  echo "<br>";
?>

<html>
<head>
<title>Student Information Portal</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="forms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="default.css" />
</head>
<body>
<div id="container">
<form action="process.php" method="post" class="niceform" enctype="multipart/form-data">
	 
    <fieldset>
    	<legend>Personal Information </legend>
		 <dl>
        	<label for="name">Name:</label>
            <dd><input type="text" name="name" id="name" size="32"  value="<?php if($roll_num!=NULL){echo $name1; }?>" maxlength="128" /></dd>
        </dl>
        <dl>
        	<label for="gender">Gender:</label>
            <dd>
            	<input type="radio" name="gender" id="gender" value="male" /><label for="gender" class="opt">Male</label>
                <input type="radio" name="gender" id="gender" value="female" /><label for="gender" class="opt">Female</label>
            </dd>
        </dl>
		   
    </fieldset>
    <fieldset>
    	<legend>Roll No.(Versioning)</legend>
		  <dl>
        	<label for="version">Roll Number (Version):</label>
<select size="1" name="version3" id="year">
                  <option value="0"> New roll Number </option>
                   <?php
				 for($i=1;$i<=$n;$i++)
				 {
				$file_name=substr($files[$i-1], 0, -4);
				 echo "<option value='$file_name'>";
				 echo $files[$i-1];
				 echo "</option>";
				 }
				 ?>
            	</select>			
        </dl>
    </fieldset>
	<fieldset>
    	<legend>Preferences </legend>
         <dl>
        	<label for="year">Year:</label>
            <dd>
            	<select size="1" name="year" id="year">
                    <option value="0">Select your year</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
					<option value="3">3</option>
                    <option value="4">4</option>
                    <option  value="5">PG</option>
            	</select>
            </dd>
        </dl>
		
		 <dl>
        	<label for="interests">Courses:</label>
            <dd>
                <input type="checkbox" name="course[]" id="course1" value="Database" /><label for="course1" class="opt">Data base</label>
                <input type="checkbox" name="course[]" id="course2" value="AI" /><label for="course2" class="opt">Artificial Intelligent </label>
                <input type="checkbox" name="course[]" id="course3" value="Software Engineering" /><label for="course3" class="opt">Software Engineering</label>
                <input type="checkbox" name="course[]" id="course4" value="Computer Network" /><label for="course4" class="opt">Computer Network </label>
                </dd>
        </dl>
        <dl>
        	<label for="upload">Upload resume:</label>
            <dd><input type="file" name="upload" id="upload" /></dd>
        </dl>
        
    </fieldset>
    <fieldset class="action">
    	<div align="center"><input type="submit" name="submit" id="submit" value="Submit" /></div>
    </fieldset>
</form>
</div>
</body>
</html>