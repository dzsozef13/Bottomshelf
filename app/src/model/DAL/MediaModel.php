<?php
include_files(array(
	"Console",
	"DbConnectionController",
	"CoreModel",
    "Media"
));

class MediaModel extends CoreModel
{

    public function uploadMedia($data)
    {
        try {
			$conn = CoreModel::openDbConnetion();

			$query = "INSERT INTO Media (Image, UserId) VALUES (:image, :userId)";

			$handle = $conn->prepare($query);

			$handle->bindParam(':image', $data['image']);
			$handle->bindValue(':userId', $data['userId']);

			$handle->execute();
            $lastInsertedMediaId = $conn->lastInsertId();

			//close the connection
			CoreModel::closeDbConnection();
			$conn = null;

            return $lastInsertedMediaId;
		} catch (PDOException $e) {
			echo  $e->getMessage();
		}
    }

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
					$row->UserId);
				$result[] = $media;
			}
			//close the connection
			CoreModel::closeDbConnection();
			$conn = null;

			return $result;
		} catch (PDOException $e) {
			print($e->getMessage());
		}
    }

}