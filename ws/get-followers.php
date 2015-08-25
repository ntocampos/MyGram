<?php
  // Get user followers
  ini_set('display_errors', 'On');
  session_start();
  require_once('config.php');


  if (!isset($_SESSION['access_token']))
    header('Location: ../login.php');

  $token = $_SESSION['access_token'];
  $instagram->setAccessToken($token);

  $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_SESSION['user']->id;

  $cursor = isset($_GET['cursor']) ? $_GET['cursor'] : null;

  //$followers = $instagram->getUserFollower($user_id, 92, $cursor);
  getFollowers($user_id, $cursor);
  function getFollowers($user_id, $cursor) {
    global $instagram, $connection;
    $query = "  SELECT u.id as id, u.username as username, u.profile_picture as profile_picture, u.full_name as full_name
                FROM relation r JOIN user u ON r.followed_by = u.id
                WHERE r.user_id = ".$user_id;

    $result = mysqli_query($connection, $query);
    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
      $rows[] = $r;
    }
    $data = new stdClass();
    $data->data = $rows;
    echo json_encode($data);
    //print_r($_SESSION);
  }
  //2055047480
  //echo count($test->data);
  //echo json_encode($test);
  //echo json_encode($followers);
?>
