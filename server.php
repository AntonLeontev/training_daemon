<?php
    
    // Запускаться из консоли и отвязываться от неё
    // Всю информацию писать в логи, ничего не выводить в консоль
    // Уметь плодить дочерние процессы и контролировать их
    // Выполнять поставленную задачу
    // Корректно завершать работу

$address = '127.0.0.1';
$port = 10000;

$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($sock, $address, $port);
socket_listen($sock, 5);

do {
    $msgsock = socket_accept($sock)
    
    /* Отправляем инструкции. */
    $msg = "\nДобро пожаловать на учебный сервер Леонтьева Антона. \n" .
        "Чтобы отключиться, наберите 'end'. Чтобы выключить сервер, 
        наберите 'stop'.\n";
    socket_write($msgsock, $msg, strlen($msg));

    do {
        $buf = socket_read($msgsock, 2048, PHP_NORMAL_READ);         
        
        if (!$buf = trim($buf)) {
            continue;
        }
        if ($buf == 'end') {
            break;
        }
        if ($buf == 'stop') {
            socket_close($msgsock);
            break 2;
        }
        $talkback = "PHP: Вы сказали '$buf'.\n";
        socket_write($msgsock, $talkback, strlen($talkback));
        echo "$buf\n";
    } while (true);
    socket_close($msgsock);
} while (true);

socket_close($sock);

