<?php
  ini_set('display_errors', 'On');
  // Get user followers
  session_start();
  require_once('config.php');

  if (!isset($_SESSION['access_token']))
		header('Location: ../login.php');

	$token = $_SESSION['access_token'];
	$instagram->setAccessToken($token);


  print_r(addFollowers(307735471));

  function addUser($user_id) {
    global $instagram, $connection;

    $user = $instagram->getUser_mod('self');

    if ($user->meta->code == '200') {
      $user = $user->data;
      $values = $user->id . ', "' . $user->username . '", "' . $user->bio . '", "' . $user->website . '", "' . $user->profile_picture . '",
               "' . $user->full_name .'", ' . $user->counts->media . ', ' . $user->counts->followed_by . ', ' . $user->counts->follows;
      $query = 'INSERT INTO user (id, username, bio, website, profile_picture, full_name, media, followed_by, follows)' .
                'VALUES  (' . $values . ')';

      mysqli_query($connection, $query);
    }
  }

  function addFollowers($user_id) {
    global $instagram, $connection;

    $next_cursor = null;
    $values = '';
    do {
      $followers = $instagram->getUserFollower($user_id, 92, $next_cursor);
      $next_cursor = isset($followers->pagination->next_cursor) ? $followers->pagination->next_cursor : null;

      foreach ($followers->data as $follower) {
        $values .= '(' . $user_id . ', ' . $follower->id . '),';
      }
    } while ($next_cursor);

    $values = rtrim($values, ',');
    $query = 'INSERT INTO relation (user_id, followed_by) VALUES ' . $values;
    mysqli_query($connection, $query);
  }
?>
