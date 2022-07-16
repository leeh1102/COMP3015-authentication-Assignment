<?php require_once 'header.php' ?>

    <body>

	<?php require_once 'nav.php' ?>

    <div class="grid grid-cols-12 mt-20">

        <form class="space-y-6 col-start-4 col-span-6" action="new_course.php" method="POST">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700"> Course Title </label>
                <div class="mt-1">
                    <input id="title" name="title" type="text" placeholder="A title for your course"
                           required
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">Course body</label>
                <div class="mt-1">
                    <textarea rows="4" name="body" id="body" placeholder="Course content"
                              class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Post
                </button>
            </div>
        </form>

    </div>

    </body>

<?php

require_once 'Repositories/CourseRepository.php';
require_once 'Repositories/UserRepository.php';

use src\Repositories\CourseRepository;
use src\Repositories\UserRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['title'];
	$body = $_POST['body'];
	$userId = $_SESSION['user_id'];
	$authenticatedUser = (new UserRepository())->getUserById($userId);
	$course = (new CourseRepository())->saveCourse($title, $body, $authenticatedUser->id);
	if ($course) {
		header('Location: course_manager.php');
	} else {
		$_SESSION['error_message'] = 'Error creating course';
		header('Location: new_course.php');
	}
	exit(0);
}
