<?php
require_once 'Repositories/CourseRepository.php';

use src\Repositories\CourseRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['courseName'];
	// $authenticatedUser = (new UserRepository())->getUserById($userId);
	$courseToBeDeleted = (new CourseRepository())->deleteCourse($title);
	if ($courscourseToBeDeletede) {
      header('Location: course_manager.php');
	} else {
      echo "ERROR";
      header('Location: course_manager.php');
	}
	exit(0);
}

