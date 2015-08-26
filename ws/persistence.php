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
      $values = $user->id . ', "' . $user->username . '", "' . $user->profile_picture . '", "' . $user->full_name .'"';
      $query =  'INSERT INTO user (id, username, profile_picture, full_name)' .
                'VALUES  (' . $values . ')' .
                'ON DUPLICATE KEY UPDATE username = "'.$user->username.'", profile_picture = "'.$user->profile_picture.'", full_name = "'.$user->full_name.'"';

      mysqli_query($connection, $query);
    }
  }

  function addFollowers($user_id) {
    global $instagram, $connection;

    $next_cursor = null;
    $values_relation = '';
    $values_user = '';
    do {
      $followers = $instagram->getUserFollower($user_id, 92, $next_cursor);
      $next_cursor = isset($followers->pagination->next_cursor) ? $followers->pagination->next_cursor : null;

      foreach ($followers->data as $follower) {
        $values_relation .= '("'.$user_id.'", "'.$follower->id.'"),';
        $values_user .= '("'.$follower->id.'", "'.$follower->username.'", "'.$follower->profile_picture.'", "'.$follower->full_name.'"),';
      }
    } while ($next_cursor);

    $values_relation = rtrim($values_relation, ',');

    // ?Antes do delete, salvar em outro canto para comparação futura
    $delete = "DELETE FROM relation WHERE user_id = ".$user_id;
    mysqli_query($connection, $delete);

    $query_relation = 'INSERT INTO relation (user_id, followed_by) VALUES' . $values_relation;
    $query_user =   'INSERT INTO user (id, username, profile_picture, full_name) VALUES '.trim($values_user, ',').' ' .
                    'ON DUPLICATE KEY UPDATE username = VALUES(username), profile_picture = VALUES(profile_picture), full_name = VALUES(full_name)';
    echo $query_user;

    mysqli_query($connection, $query_relation);
    mysqli_query($connection, $query_user);
  }

  function addFollows($user_id) {
    global $instagram, $connection;

    $next_cursor = null;
    $values_relation = '';
    $values_user = '';
    do {
      $follows = $instagram->getUserFollows($user_id, 92, $next_cursor);
      $next_cursor = isset($follows->pagination->next_cursor) ? $follows->pagination->next_cursor : null;

      foreach ($follows->data as $follower) {
        $values_relation .= '("'.$follower->id.'", "'.$user_id.'"),';
        $values_user .= '("'.$follower->id.'", "'.$follower->username.'", "'.$follower->profile_picture.'", "'.$follower->full_name.'"),';
      }
    } while ($next_cursor);

    $values_relation = rtrim($values_relation, ',');

    // ?Antes do delete, salvar em outro canto para comparação futura
    $delete = "DELETE FROM relation WHERE user_id = ".$user_id;
    mysqli_query($connection, $delete);

    $query_relation = 'INSERT INTO relation (user_id, followed_by) VALUES' . $values_relation;
    $query_user =   'INSERT INTO user (id, username, profile_picture, full_name) VALUES '.trim($values_user, ',').' ' .
                    'ON DUPLICATE KEY UPDATE username = VALUES(username), profile_picture = VALUES(profile_picture), full_name = VALUES(full_name)';
    echo $query_user;

    mysqli_query($connection, $query_relation);
    mysqli_query($connection, $query_user);
  }
?>
