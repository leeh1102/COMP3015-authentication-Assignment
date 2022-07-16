<?php
require_once 'Repositories/UserRepository.php';
require_once 'Repositories/CourseRepository.php';
require_once './Course_manager.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['title'];
	$completed = $_POST['body'];
	$userId = $_SESSION['user_id'];
  echo "here";
	$authenticatedUser = (new UserRepository())->getUserById($userId);
  echo "here2";
	$toBeDeletedCourse = (new CourseRepository())->deleteCourse($title, $completed, $authenticatedUser->id);
  // $toBeDeletedCourse = (new CourseRepository())->deleteCourse($title, $completed, $userId);

  $sql = "DELETE FROM customers WHERE id='".$_GET['id']."' ";
    if (CourseRepository->$conn->query($sql) === TRUE) {
       header("Location: index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>