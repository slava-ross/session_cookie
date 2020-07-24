<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Authorisation</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<main>
			<div class="forms">
				<form method="post">
					<p>
						<label>
							<b>Логин:</b><br>
							<input type="text" name="login" value="<?php if (isset($_POST['login'])) print $_POST['login']?>">
						</label>
					</p>
					<p>
						<label><b>Пароль:</b><br>
						<input type="password" name="password">
						</label>
					</p>
					<p>
						<input type="submit" name="submit" value="Вход">
					</p>
				</form>
			</div>
		</main>
	</body>
</html>


            <?php
                if (isset($_POST['submit'])) {
                    $login = trim($_POST['login']);
                    $password = trim($_POST['password']);

                    $errors = array();

            
                    if (count($errors) === 0) {
                        $result = doOperation($operand1, $operand2, $operation);
                        $display = ($result === NULL) ? "Divider is zero!" : $result;
                    }
                    else {
                        foreach ( $errors as $errorMsg ) {
                            print('<p class="message error">'.$errorMsg.'</p>');
                        }
                    }
                }
            ?>



    public function logout( $key_session ) {
            $deleted = false;
            $errors = array();

                        
            if ( $res['success'] ) {
                setcookie("user_session", '', time()-3600);
                unset( $_SESSION['cart'] );

                $deleted = true;
            
        }