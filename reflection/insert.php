<?php

    session_start();

    function redirect($url, $permanent = false)
    {
        if (headers_sent() === false)
        {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
            setFlash('Dodano Refleksję');
        }

        exit();
    }

    function setFlash($message)
    {
        $_SESSION['message'] = $message;
    }
    $ref = $_SERVER['HTTP_REFERER'];

    redirect($ref, false);