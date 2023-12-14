<?php

function sessionStart() {
    // Set session cookie parameters
    $sessionParams = session_get_cookie_params();
    session_set_cookie_params(
        $sessionParams["lifetime"],
        $sessionParams["path"],
        $sessionParams["domain"],
        true,  
        true   
    );

    // Starting the session
    session_start();

    // Regenerate session ID to prevent session fixation attacks
    session_regenerate_id(true);

    // current session ID 
    $_SESSION['last_session_id'] = session_id();

    //checking if user agent is changed
    if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        // if session attack is detected (if user agent changed) then
        // performing this necessary actions (logout)
        session_unset();
        session_destroy();
        header("Location: ./login/"); // redirect to login page
        exit();
    } else {
        
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    }
}



?>
