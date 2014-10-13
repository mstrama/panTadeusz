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


    $to      = 'jakub.kanclerz@gmail.com';
    $subject = 'the subject';
    $message = 'hello';
    $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    $con = mysqli_connect("127.0.0.1", "user", "pass", "baza");// Check connection

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    mysqli_query(
        $con,
        sprintf(
            "INSERT INTO Reflection (title, reflection) VALUES ('%s', '%s')",
            $_POST['title'],
            $_POST['reflection']
        )
    );

    mysqli_close($con);
    redirect($ref, false);
