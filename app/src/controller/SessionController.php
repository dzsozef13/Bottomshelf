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
    public function setUser($userId, $username)
    {
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
    }

    /**
     * Returns array of user data
     */
    public function getUser()
    {
        $userId = $_SESSION['userId'];
        $username = $_SESSION['username'];

        if (isset($userId, $username)) {
            return  array(
                'userId' => $userId,
                'username' => $username
            );
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
        $_SESSION['selected'] = $postId;
    }
    public function getSelectedPostId()
    {
        return $_SESSION['selected'] ?? null;
    }

    /**
     * Set - Get explore filter
     * 
     * Use to fetch a specific collection posts in explore view
     */
    public function setExploreFilter($filter)
    {
        $_SESSION['filter'] = $filter;
    }
    public function getExploreFilter()
    {
        return $_SESSION['filter'] ?? null;
    }

    /**
     * Set - Get explore search key
     * 
     * Use to fetch posts containing the key in explore view
     */
    public function setExploreSearchKey($key)
    {
        $_SESSION['searchKey'] = $key;
    }
    public function getExploreSearchKey()
    {
        return $_SESSION['searchKey'] ?? null;
    }

    /**
     * Set - Get explore search tag
     * 
     * Use to fetch a collection of tagged posts in explore view
     */
    public function setExploreSearchTag($tag)
    {
        $_SESSION['searchTag'] = $tag;
    }
    public function getExploreSearchTag()
    {
        return $_SESSION['searchTag'] ?? null;
    }

    public function setUploadedMediaIdArray($mediaIDs)
    {
        $_SESSION['uploadedMediaIdArray'] = $mediaIDs;
    }
    public function getUploadedMediaIdArray()
    {
        return $_SESSION['uploadedMediaIdArray'];
    }

    /**
     * Set - Get system message
     * 
     * Use to display error or other messages from the system in view
     */
    public function setSystemMessage($message) {
        $_SESSION['systemMessage'] = $message;
    }
    public function getSystemMessage() {
        return $_SESSION['systemMessage'] ?? null;
        $_SESSION['systemMessage'] = null;
    }

}
