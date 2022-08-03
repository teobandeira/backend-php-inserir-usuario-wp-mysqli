<?php

function cadastra_user_wp($user_email, $display_name, $user_pass, $id_cliente_sis){
    
    # Dados acesso servidor WP
    $servidor_db = 'localhost';
    $banco_db = 'server';
    $usuario_db = 'server_site';
    $senha_db = 'Hffr645454545';

    // Conecta-se ao banco de dados MySQL
    $conecta_wp = new mysqli($servidor_db, $usuario_db, $senha_db, $banco_db);

    if ($conecta_wp->connect_error) {
        die("Falha ao conectar ao banco de dados WP: " . $conecta_wp->connect_error);
    }

    # Recebe os dados para cadastro
    $user_pass = md5($user_pass);
    $user_url = "https://avoip.com.br";
    $user_registered = date('Y-m-d H:i:s');
    $user_activation_key = rand();
    
    # Grava o usuário
    $sql1 = "INSERT INTO wp_users SET user_login='$user_email', user_pass='$user_pass', user_nicename='$display_name', user_email='$user_email', user_url='$user_url', user_registered='$user_registered', user_activation_key='$user_activation_key', user_status='$user_status', display_name='$display_name' ";
    $ret1 = $conecta_wp->query($sql1);

    // Pega o ID inserido
    $user_id = $conecta_wp->insert_id; 

    # Grava os campos personalizados
    $sql2 = "INSERT INTO wp_usermeta SET user_id='$user_id', meta_key='wp_capabilities', meta_value='a:1:{s:10:\"subscriber\";b:1;}' ";
    $ret2 = $conecta_wp->query($sql2);

    $sql3 = "INSERT INTO wp_usermeta SET user_id='$user_id', meta_key='id_cliente_sis', meta_value='$id_cliente_sis'";
    $ret3 = $conecta_wp->query($sql3);

    // Fecha conexão
    $conecta_wp -> close();

}
?>
