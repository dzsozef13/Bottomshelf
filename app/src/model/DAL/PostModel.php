<?php
include_files(array(
	"Console",
	"DbConnectionController",
	"CoreModel",
	"Post"
));

class PostModel extends CoreModel
{
	// Try to implement filter_var for more protection

	/**
	 * @param array data all values needed to create a post
	 */
	public function createPost($data)
	{
		try {
			$conn = CoreModel::openDbConnetion();

			$query = "INSERT INTO Post (Title, PostDescription, IsPublic, IsSticky, ReactionCount , CommentCount, UserId, StatusId) VALUES (:title, :postDescription, :isPublic, :isSticky, :reactionCount, :commentCount, :userId, :statusId)";

			$handle = $conn->prepare($query);

			$sanitizedTitle = htmlspecialchars($data['title']);
			$sanitizedDescription = htmlspecialchars($data['description']);

			$handle->bindParam(':title', $sanitizedTitle);
			$handle->bindParam(':postDescription', $sanitizedDescription);
			$handle->bindValue(':isPublic', $data['isPublic']);
			$handle->bindValue(':isSticky', $data['isSticky']);
			$handle->bindValue(':reactionCount', $data['reactionCount']);
			$handle->bindValue(':commentCount', $data['commentCount']);
			$handle->bindValue(':userId', $data['userId']);
			$handle->bindValue(':statusId', $data['statusId']);

			$handle->execute();
			$lastInsertedPostId = $conn->lastInsertId();
			return $lastInsertedPostId;
		} catch (PDOException $e) {
			echo  $e->getMessage();
		}
	}

	public function connectPostWithMedia(int $postId, $mediaId)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query =
				"INSERT 
				INTO PostHasImage (PostId, ImageId) 
				VALUES (:postId, :mediaId)";

			$handle = $conn->prepare($query);

			$handle->bindParam(':postId', $postId);
			$handle->bindValue(':mediaId', $mediaId);

			$handle->execute();
		} catch (PDOException $e) {
			echo  $e->getMessage();
		}
	}

	/**
	 * @param int postId is the id of the post you would like to fetch
	 * @return Post post with matching Id  (if none then false)
	 */
	public function getById(int $postId)
	{
		//Sanitize this and make sure is safe
		try {
			$conn = CoreModel::openDbConnetion();

			$query = "SELECT Post.*, User.Username FROM Post 
			INNER JOIN `User` ON User.UserId=Post.UserId
			WHERE Post.PostId = :PostId AND Post.StatusId = 1 AND User.StatusId = 1";

			$handle = $conn->prepare($query);
			$handle->bindParam(':PostId', $postId);
			$handle->execute();

			$row = $handle->fetch(PDO::FETCH_OBJ);
			$post = new Post(
				$row->PostId,
				$row->Title,
				$row->PostDescription,
				$row->ReactionCount,
				$row->CommentCount,
				$row->IsPublic,
				$row->IsSticky,
				$row->CreatedAt,
				$row->UserId,
				$row->Username,
				$row->LatestCommentId,
				$row->ChildPostId,
				$row->StatusId
			);
			return $post;
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}

	/**
	 * @return Post[]  (if none then empty array [])
	 */
	public function getAllByStatus(int $statusId, bool $isPublic)
	{
		// might improve the get all functions to avoid fetching too much
		try {
			$conn = CoreModel::openDbConnetion();
			$query =
				"SELECT Post.*, User.Username, Comment.Content
				FROM Post
				LEFT JOIN `User` ON User.UserId=Post.UserId
				LEFT JOIN Comment ON Comment.CommentId=Post.LatestCommentId
				WHERE Post.StatusId = :statusId AND Post.IsPublic = :isPublic AND User.StatusId = 1
				ORDER BY Post.IsSticky DESC, Post.CreatedAt DESC";

			$handle = $conn->prepare($query);
			$handle->bindParam(':statusId', $statusId);
			$handle->bindParam(':isPublic', $isPublic);
			$handle->execute();

			$result = array();
			while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
				$post = new Post(
					$row->PostId,
					$row->Title,
					$row->PostDescription,
					$row->ReactionCount,
					$row->CommentCount,
					$row->IsPublic,
					$row->IsSticky,
					$row->CreatedAt,
					$row->UserId,
					$row->Username,
					$row->Content,
					$row->ChildPostId,
					$row->StatusId
				);

				$result[] = $post;
			}
			return $result;
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}

	/**
	 * @return Post[]  (if none then empty array [])
	 */
	public function getAllActiveAndPublic()
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query =
				"SELECT Post.*, User.Username, Comment.Content
				FROM Post
				LEFT JOIN `User` ON User.UserId=Post.UserId
				LEFT JOIN Comment ON Comment.CommentId=Post.LatestCommentId
				WHERE User.StatusId = 1 AND Post.StatusId = 1 AND Post.isPublic = 1
				ORDER BY Post.Title DESC";

			$handle = $conn->prepare($query);
			$handle->execute();

			$result = array();
			while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
				$post = new Post(
					$row->PostId,
					$row->Title,
					$row->PostDescription,
					$row->ReactionCount,
					$row->CommentCount,
					$row->IsPublic,
					$row->IsSticky,
					$row->CreatedAt,
					$row->UserId,
					$row->Username,
					$row->Content,
					$row->ChildPostId,
					$row->StatusId
				);

				$result[] = $post;
			}
			return $result;
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}

	/**
	 * @return Post[]  (if none then empty array [])
	 */
	public function getAllActive()
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query =
				"SELECT Post.*, User.Username, Comment.Content
				FROM Post
				LEFT JOIN `User` ON User.UserId=Post.UserId
				LEFT JOIN Comment ON Comment.CommentId=Post.LatestCommentId
				WHERE User.StatusId = 1 AND Post.StatusId = 1
				ORDER BY Post.Title DESC";

			$handle = $conn->prepare($query);
			$handle->execute();

			$result = array();
			while ($row = $handle->fetch(PDO::FETCH_OBJ)) {

				$post = new Post(
					$row->PostId,
					$row->Title,
					$row->PostDescription,
					$row->ReactionCount,
					$row->CommentCount,
					$row->IsPublic,
					$row->IsSticky,
					$row->CreatedAt,
					$row->UserId,
					$row->Username,
					$row->Content,
					$row->ChildPostId,
					$row->StatusId
				);

				$result[] = $post;
			}
			return $result;
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}

	/**
	 * @param int userId
	 * @return Post[] (if none then empty array [])
	 */
	public function getAllByUserId(int $userId)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query = "SELECT Post.*, User.Username, Comment.content
			FROM Post 
			INNER JOIN `User` ON User.UserId=Post.UserId
			LEFT JOIN Comment ON Comment.CommentId=Post.LatestCommentId
			WHERE Post.UserId = :UserId AND Post.StatusId = 1 AND User.StatusId = 1
			ORDER BY Post.CreatedAt DESC";

			$handle = $conn->prepare($query);
			$handle->bindParam(':UserId', $userId);
			$handle->execute();

			$result = array();
			while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
				$post = new Post(
					$row->PostId,
					$row->Title,
					$row->PostDescription,
					$row->ReactionCount,
					$row->CommentCount,
					$row->IsPublic,
					$row->IsSticky,
					$row->CreatedAt,
					$row->UserId,
					$row->Username,
					$row->LatestCommentId,
					$row->ChildPostId,
					$row->StatusId
				);

				$result[] = $post;
			}
			return $result;
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}

	/**
	 * @return Post[] (if none then empty array [])
	 */
	public function getAllByPhrase(string $phrase)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query = "SELECT Post.*, User.Username, Comment.content
			FROM Post 
			INNER JOIN `User` ON User.UserId=Post.UserId
			LEFT JOIN Comment ON Comment.CommentId=Post.LatestCommentId
			WHERE Post.Title LIKE :TitlePhrase 
			OR Post.PostDescription LIKE :DescriptionPhrase
			ORDER BY Post.CreatedAt DESC";

			$sanitizedPhrase = '%' . htmlspecialchars($phrase) . '%';

			$handle = $conn->prepare($query);
			$handle->bindParam(':TitlePhrase', $sanitizedPhrase);
			$handle->bindParam(':DescriptionPhrase', $sanitizedPhrase);
			$handle->execute();

			$result = array();
			while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
				$post = new Post(
					$row->PostId,
					$row->Title,
					$row->PostDescription,
					$row->ReactionCount,
					$row->CommentCount,
					$row->IsPublic,
					$row->IsSticky,
					$row->CreatedAt,
					$row->UserId,
					$row->Username,
					$row->Content,
					$row->ChildPostId,
					$row->StatusId
				);

				$result[] = $post;
			}
			return $result;
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}

	/**
	 * @return Post[] (if none then empty array [])
	 */
	public function getAllByTag(string $tag)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query = "SELECT Post.*, User.Username, Comment.content
			FROM Post 
			INNER JOIN `User` ON User.UserId=Post.UserId
			LEFT JOIN Comment ON Comment.CommentId=Post.LatestCommentId
			INNER JOIN PostHasTag ON PostHasTag.PostId=Post.PostId
			WHERE PostHasTag.TagId=:Tag
			ORDER BY Post.CreatedAt DESC";

			$sanitizedTag = htmlspecialchars($tag);

			$handle = $conn->prepare($query);
			$handle->bindParam(':Tag', $sanitizedTag);
			$handle->execute();

			$result = array();
			while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
				$post = new Post(
					$row->PostId,
					$row->Title,
					$row->PostDescription,
					$row->ReactionCount,
					$row->CommentCount,
					$row->IsPublic,
					$row->IsSticky,
					$row->CreatedAt,
					$row->UserId,
					$row->Username,
					$row->Content,
					$row->ChildPostId,
					$row->StatusId
				);

				$result[] = $post;
			}
			return $result;
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}

	/**
	 * @param int postId
	 * @param array updatable data
	 */
	public function updatePost($id, $data)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query = "UPDATE Post SET Title = :title, PostDescription = :postDescription, IsPublic = :isPublic WHERE PostId = :postId";

			$handle = $conn->prepare($query);

			$sanitizedTitle = htmlspecialchars($data['title']);
			$sanitizedDescription = htmlspecialchars($data['description']);

			$handle->bindParam(':title', $sanitizedTitle);
			$handle->bindParam(':postDescription', $sanitizedDescription);
			$handle->bindValue(':isPublic', $data['isPublic']);
			$handle->bindParam(':postId', $id);

			$handle->execute();
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}


	/**
	 * @param int postId
	 * @param int statusId
	 */
	public function updatePostStatus(int $id, $statusId)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query = "UPDATE Post SET StatusId = :statusId WHERE PostId = :postId";

			$handle = $conn->prepare($query);

			$handle->bindParam(':statusId', $statusId);
			$handle->bindParam(':postId', $id);

			$handle->execute();
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}


	public function markAsSticky(int $id)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query = "UPDATE Post SET IsSticky = 1 WHERE PostId = :PostId";

			$handle = $conn->prepare($query);

			$handle->bindParam(':PostId', $id);

			$handle->execute();
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}

	public function markAsNotSticky(int $id)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query = "UPDATE Post SET IsSticky = 0 WHERE PostId = :PostId";

			$handle = $conn->prepare($query);

			$handle->bindParam(':PostId', $id);

			$handle->execute();
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}


	/**
	 * Hard delete post (not used)
	 */
	public function deletePost($id)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query1 = "DELETE FROM Post WHERE PostId = :PostId;";
			$query2 = "DELETE FROM Comment WHERE PostId = :PostId";
			$query3 = "DELETE FROM PostHasImage WHERE PostId = :PostId";
			//Delete tags and reactions too

			$conn->beginTransaction();

			$handle2 = $conn->prepare($query2);
			$handle2->bindParam(':PostId', $id);
			$handle2->execute();

			$handle3 = $conn->prepare($query3);
			$handle3->bindParam(':PostId', $id);
			$handle3->execute();

			$handle1 = $conn->prepare($query1);
			$handle1->bindParam(':PostId', $id);
			$handle1->execute();

			$conn->commit();
			//close the connection
			CoreModel::closeDbConnection();
		} catch (PDOException $e) {
			$conn->rollback();
			print($e->getMessage());
		}
	}
}
