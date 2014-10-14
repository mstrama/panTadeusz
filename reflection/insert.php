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

    function sendApiEmail($title, $reflection)
    {
        $url = 'https://mandrillapp.com/api/1.0/messages/send.json';
        $params = [
            'message' => array(
                'subject' => $title,
                'text' => $reflection,
                'html' => '<p>'.$reflection.'</p>',
                'from_email' => 'uek@no-replay.com',
                'to' => array(
                    array(
                        'email' => 'jakub.kanclerz@gmail.com',
                        'name' => 'Jakub'
                    )
                )
            )
        ];

        $params['key'] = 'HEpZLrPrRBEa7W9fLAJKeQ';
        $params = json_encode($params);
        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

        $head = curl_exec($ch); 
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
        curl_close($ch); 
    }

    $ref = $_SERVER['HTTP_REFERER'];
    $to      = 'jakub.kanclerz@gmail.com';
    $subject = 'the subject';
    $message = 'hello';
    $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    sendApiEmail($_POST['title'], $_POST['reflection']);

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
