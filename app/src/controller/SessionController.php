<?php
include_files(array(
    "DbConnectionController",
    "Console"
));

class SessionController
{

    /**
     * Start or continues session
     */
    function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Destroys all session data
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * Sets user data in session
     */
    public function setUser($userId, $username, $roleId)
    {
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['roleId'] = $roleId;
    }

    /**
     * Returns array of user data
     */
    public function getUser()
    {
        if (isset($_SESSION['userId']) && isset($_SESSION['username']) && isset($_SESSION['roleId'])) {
            $userId = $_SESSION['userId'];
            $username = $_SESSION['username'];
            $roleId = $_SESSION['roleId'];

            if (isset($userId, $username)) {
                return  array(
                    'userId' => $userId,
                    'username' => $username,
                    'roleId' => $roleId
                );
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * View configurable properties
     * 
     * Use the following methods to store parameters from the route query
     * Views will depend on these values when rendered 
     */

    /**
     * Set - Get selected post ID
     * 
     * Use to fetch a single post in selected post view
     */
    public function setSelectedPostId($postId)
    {
        $_SESSION['selectedPost'] = $postId;
    }
    public function getSelectedPostId()
    {
        return $_SESSION['selectedPost'] ?? null;
    }

    /**
     * Set - Get explore filter
     * 
     * Use to fetch a specific collection posts
     */
    public function setFilter($filter)
    {
        $_SESSION['filter'] = $filter;
    }
    public function getFilter()
    {
        return $_SESSION['filter'] ?? null;
    }

    /**
     * Set - Get explore search key
     * 
     * Use to fetch posts containing the key
     */
    public function setSearchPhrase($phrase)
    {
        $_SESSION['searchPhrase'] = $phrase;
    }
    public function getSearchPhrase()
    {
        if (isset($_SESSION['searchPhrase'])) {
            return $_SESSION['searchPhrase'];
        }
    }

    /**
     * Set - Get explore search tag
     * 
     * Use to fetch a collection of tagged posts
     */
    public function setSearchTag($tag)
    {
        $_SESSION['searchTag'] = $tag;
    }
    public function getSearchTag()
    {
        if (isset($_SESSION['searchTag'])) {
            return $_SESSION['searchTag'];
        }
    }

    public function setUploadedMediaIdArray($mediaIds)
    {
        $_SESSION['uploadedMediaIdArray'] = $mediaIds;
    }
    public function getUploadedMediaIdArray()
    {
        if (isset($_SESSION['uploadedMediaIdArray'])) {
            return $_SESSION['uploadedMediaIdArray'];
        }
    }

    public function setAssignedTagIdArray($tagIds)
    {
        $_SESSION['assignedTagIdArray'] = $tagIds;
    }
    public function getAssignedTagIdArray()
    {
        if (isset($_SESSION['assignedTagIdArray'])) {
            return $_SESSION['assignedTagIdArray'];
        }
    }

    /**
     * Set - Get other user profile
     * 
     * Use to fetch information to use other user's profile
     */
    public function setUserProfileId($userId)
    {
        $_SESSION['selectedUser'] = $userId;
    }
    public function getUserProfileId()
    {
        if (isset($_SESSION['selectedUser'])) {
            return $_SESSION['selectedUser'];
        }
    }


    /**
     * Set - Get system message
     * 
     * Use to display error or other messages from the system in view
     */
    public function setSystemMessage($message)
    {
        $_SESSION['systemMessage'] = $message;
    }
    public function getSystemMessage()
    {
        if (isset($_SESSION['systemMessage'])) {
            return $_SESSION['systemMessage'] ?? null;
        }
    }
}
