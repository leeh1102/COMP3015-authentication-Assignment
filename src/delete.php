
<?php

$courseName = $_POST['courseName'];

$courses = json_decode(file_get_contents('./courses.json'), true);


foreach($courses->title as $idx => $course) {
  if($course->title == $courseName) {
    array_splice($courses->title, $idx, 1);
  }
}


// file_put_contents('./courses.json', json_encode($courses, JSON_PRETTY_PRINT));
header('Location: course_manager.php');