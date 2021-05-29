<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$email = $_POST['email'];
$emailstwo = $_POST['emailstwo'];
// Формирование самого письма
$title = "Новое обращение Best Tour Plan";
$body = "
<h2>Новое обращение</h2>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $phone<br>
<b>Сообщение:</b> $message
";
$body1 = "<h2>Новое обращение</h2><br>
<b>Адрес почты: </b>$email
";
$body2 = "
<h2>Новое обращение</h2>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $phone<br>
<b>Сообщение:</b> $message<br>
<b>Адрес почты: </b> $emailstwo
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'alexsiteformail@gmail.com'; // Логин на почте
    $mail->Password   = 's3b5b81ax'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('alexsiteformail@gmail.com', 'Алексей Ружейников'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('alexei_ruzheynikov@mail.ru');  
    //$mail->addAddress('youremail@gmail.com'); // Ещё один, если нужен

    // Прикрипление файлов к письму
// if (!empty($file['name'][0])) {
//     for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
//         $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
//         $filename = $file['name'][$ct];
//         if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
//             $mail->addAttachment($uploadfile, $filename);
//             $rfile[] = "Файл $filename прикреплён";
//         } else {
//             $rfile[] = "Не удалось прикрепить файл $filename";
//         }
//     }   
// }





// Отправка сообщения
// $mail->isHTML(true);
// $mail->Subject = $title;
// $mail->Body = $body; 

// if(isset($_POST['name']['phone']['message']['email'])) {
// if(isset($_POST['email'])($_POST['phone'])($_POST['message'])($_POST['email'])){


if(isset($_POST['emailstwo'])){
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body2; 
}
 else {
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body; 
}
if(isset($_POST['email'])){
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body1;    
}


// Проверяем отправленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}



// Отображение результата
// echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);
header('Location: thankyou.html');
