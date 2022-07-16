<?php require_once 'header.php'; ?>

<?php

require_once 'Repositories/CourseRepository.php';

use src\Repositories\CourseRepository;

session_start();
$courses = [];
if (isset($_SESSION['user_id'])) {
	$userId = $_SESSION['user_id'];
    $coursesRepository = new CourseRepository();
	$courses = $coursesRepository->getCoursesForUser($userId);
} else {
	header('Location: login.php');
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Course Manager</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
</head>
<body>

<?php require_once 'nav.php' ?>
<div class="grid grid-cols-12 mt-20">
    <ul role="list" class="divide-y divide-gray-200 space-y-6 col-start-4 col-span-6">
        <span class="font-extrabold"><?php echo count($courses) === 0 ? 'No courses yet.' : 'Your courses:' ?></span>

		<?php foreach ($courses as $course): ?>
            <li class="py-4 flex">
                <div class="ml-3">
                    <!-- Checkbox Form -->
                    <form style="display: inline" action="change_status.php" method="post">
                        <input type="hidden" name="courseName" value="<?= $course->title ?>">
                        <input type="checkbox" name="status" value="1" <?= $course->completed ? 'checked' : '' ?>>
                    </form>
                    <!-- Checkbox Form End  -->
                    <!-- Editable Course Title  -->
                    <span class="courseTitle" data-originalcoursename="<?= $course->title  ?>" contentEditable="true">
                        <?php echo $course->title   ?></span>
                    <!-- Editable Course Title End  -->
                    <!-- Delete Button Form  -->
                    <form style="display: inline" action="delete.php" method="post">
                        <input type="hidden" name="courseName" value="<?= $course->title ?>">
                        <button>Delete</button>
                    </form>
                    <!-- Delete Button Form End  -->
                </div>
                
            </li>
            
		<?php endforeach; ?>

    </ul>
</div>

</body>
