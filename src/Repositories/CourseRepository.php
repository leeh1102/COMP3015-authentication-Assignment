<?php

namespace src\Repositories;

require_once 'Repository.php';
require_once __DIR__ . '/../Models/Course.php';

use src\Models\Course;

class CourseRepository extends Repository {

	/**
	 * @param int $user_id
	 * @return array
	 */
	public function getCoursesForUser(int $user_id): array {
		$sqlStatement = $this->mysqlConnection->prepare("SELECT id, title, completed, author_id FROM courses WHERE author_id = ?");
		$sqlStatement->bind_param('i', $user_id);
		$sqlStatement->execute();
		$resultSet = $sqlStatement->get_result();

		$courses = [];
		while ($row = $resultSet->fetch_assoc()) {
			$courses[] = new Course($row);
		}

		return $courses;
	}

	/**
	 * @param string $title
	 * @param string $body
	 * @param int $user_id
	 * @return bool
	 */
	public function saveCourse(string $title, string $body, int $user_id): bool {
		$sqlStatement = $this->mysqlConnection->prepare("INSERT INTO courses VALUES(NULL, ?, ?, ?)");
		$sqlStatement->bind_param('ssi', $title, $body, $user_id);
		return $sqlStatement->execute();
	}
	public function deleteCourse(string $title): bool {
		$sqlStatement = $this->mysqlConnection->prepare("DELETE FROM courses WHERE title='$title'");
		return $sqlStatement->execute();
	}
	public function updateCourse(string $title): bool {
	$sqlStatement = $this->mysqlConnection->prepare("UPDATE courses SET title='$title' WHERE id='$id");
	return $sqlStatement->execute();
	}

}
