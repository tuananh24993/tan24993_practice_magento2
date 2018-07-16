<?php
namespace OpenTechiz\Blog\Api\Data;

interface NotificationInterface
{

    const NOTI_ID                  = 'notification_id';
    const CONTENT                  = 'content';
    const POST_ID                  = 'post_id';
    const COMMENT_ID			   = 'comment_id';
    const IS_VIEWED				   = 'is_viewed';
    const USER_ID                  = 'user_id';
    const CREATION_TIME            = 'creation_time';
    function getID();
    function getContent();
    function getPostID();
    function getCommentID();
	function isViewed();
    function getUserID();
    function getCreationTime();
    function setID($id);
    function setContent($content);
    function setCommentID($commentID);
	function setIsViewed($isViewed);
    function setPostID($postID);
    function setUserID($userID);
    function setCreationTime($creatTime);
}