<?php require_once 'header.php'; ?>

<?php

require_once 'Repositories/PostRepository.php';

use src\Repositories\PostRepository;

session_start();
$posts = [];
if (isset($_SESSION['user_id'])) {
	$userId = $_SESSION['user_id'];
    $postsRepository = new PostRepository();
	$posts = $postsRepository->getPostsForUser($userId);
} else {
	header('Location: login.php');
}
?>

<body>

<?php require_once 'nav.php' ?>

<div class="grid grid-cols-12 mt-20">
    <ul role="list" class="divide-y divide-gray-200 space-y-6 col-start-4 col-span-6">
        <span class="font-extrabold"><?php echo count($posts) === 0 ? 'No posts yet.' : 'Your Posts:' ?></span>

		<?php foreach ($posts as $post): ?>
            <li class="py-4 flex">
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900"><?= $post->title ?></p>
                    <p class="text-sm text-gray-500"><?= $post->body ?></p>
                </div>
            </li>
		<?php endforeach; ?>

    </ul>
</div>

</body>
