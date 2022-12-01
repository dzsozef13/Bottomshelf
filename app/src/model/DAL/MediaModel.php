<?php
include_files(array(
	"Console",
	"DbConnectionController",
	"CoreModel",
	"Media"
));

class MediaModel extends CoreModel
{

	/**
	 * Uploads a single Media
	 * Returns the inserted media's ID
	 */
	public function uploadMedia($data)
	{
		try {
			$conn = CoreModel::openDbConnetion();

			$query =
				"INSERT 
				INTO Media (Image, UserId) 
				VALUES (:image, :userId)";

			$handle = $conn->prepare($query);

			$handle->bindParam(':image', $data['media']);
			$handle->bindValue(':userId', $data['userId']);

			$handle->execute();
			$lastInsertedMediaId = $conn->lastInsertId();

			CoreModel::closeDbConnection();
			$conn = null;

			return $lastInsertedMediaId;
		} catch (PDOException $e) {
			echo  $e->getMessage();
		}
	}

	/**
	 * Returns with an array of Media connected to passed post ID
	 */
	public function getMediaForPost(int $postId)
	{
		try {
			$conn = CoreModel::openDbConnetion();
			$query =
				"SELECT *
				FROM Media
				INNER JOIN `PostHasImage` 
                ON PostHasImage.PostId = :postId
				WHERE Media.ImageId = PostHasImage.ImageId";

			$handle = $conn->prepare($query);
			$handle->bindParam(':postId', $postId);
			$handle->execute();

			$result = array();
			while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
				$media = new Media(
					$row->ImageId,
					$row->Image,
					$row->UserId
				);
				$result[] = $media;
			}

			CoreModel::closeDbConnection();
			$conn = null;

			return $result;
		} catch (PDOException $e) {
			print($e->getMessage());
		}
	}
}
