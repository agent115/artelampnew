<?php
$mail="root10@inbox.ru"; 
$subject ="Test from artelamp" ; 
$text= "Sample text"; 
$headers = "From: info@artelamp.ru \r\n";

echo('Отправляем на '.$mail.' ...<br>');
if( mail($mail, $subject, $text, $headers) ) { 
echo 'Успешно отправлено!'; 
} else{ 
echo 'Отправка не удалась!'; 
}

?>