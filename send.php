<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$nameFooter = $_POST['name-footer'];
$phoneFooter = $_POST['phone-footer'];
$messageFooter = $_POST['message-footer'];
$emailNewsletter = $_POST['email-newsletter'];
$nameBooking = $_POST['name-booking'];
$phoneBooking = $_POST['phone-booking'];
$messageBooking = $_POST['message-booking'];
$emailBooking = $_POST['email-booking'];

// Формирование самого письма
if ($nameFooter) {
  $title = "Новое обращение Best Tour Plan";
  $body = "
<h2>Новое обращение</h2>
<b>Имя:</b> $nameFooter<br>
<b>Телефон:</b> $phoneFooter<br><br>
<b>Сообщение:</b><br>$messageFooter
";
} elseif ($emailNewsletter) {
  $title = "Новое обращение Best Tour Plan";
  $body = "
<h2>Новый подписчик</h2>
<b>Адрес почты подписчика:</b>$emailNewsletter<br>
";
} elseif ($nameBooking) {
  $title = "Новое обращение Best Tour Plan";
  $body = "
<h2>Новое обращение</h2>
<b>Имя:</b> $nameBooking<br>
<b>Телефон:</b> $phoneBooking<br>
<b>Почта:</b> $emailBooking<br><br>
<b>Сообщение:</b><br>$messageBooking
";
}


// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
  $mail->isSMTP();
  $mail->CharSet = "UTF-8";
  $mail->SMTPAuth   = true;
  // $mail->SMTPDebug = 2;
  $mail->Debugoutput = function ($str, $level) {
    $GLOBALS['status'][] = $str;
  };

  // Настройки вашей почты
  $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
  $mail->Username   = 'olesya.besttour@gmail.com'; // Логин на почте
  $mail->Password   = 'bestplant1'; // Пароль на почте
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;
  $mail->setFrom('olesya.besttour@gmail.com', 'Олеся Иванова'); // Адрес самой почты и имя отправителя

  // Получатель письма
  $mail->addAddress('vivalasdancers@gmail.com');
  // $mail->addAddress('youremail@gmail.com'); // Ещё один, если нужен

  // Отправка сообщения
  $mail->isHTML(true);
  $mail->Subject = $title;
  $mail->Body = $body;

  // Проверяем отравленность сообщения
  if ($mail->send()) {
    $result = "success";
  } else {
    $result = "error";
  }
} catch (Exception $e) {
  $result = "error";
  $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}
// Отображение результата
if ($nameFooter) {
  header('Location: thanksmessage.html');
} elseif ($emailNewsletter) {
  header('Location: thanksemail.html');
} elseif ($nameBooking) {
  header('Location: thanksbooking.html');
}
// echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);