<html>
<head><title>���O�A�E�g</title></head>
<body>

<?php

header("Content-Type: text/html; charset=Shift-JIS");
// �Z�b�V�����̏�����
// session_name("something")���g�p���Ă���ꍇ�͓��ɂ����Y��Ȃ��悤��!
session_start();

// �Z�b�V�����ϐ���S�ĉ�������
$_SESSION = array();

// �Z�b�V������ؒf����ɂ̓Z�b�V�����N�b�L�[���폜����B
// Note: �Z�b�V������񂾂��łȂ��Z�b�V������j�󂷂�B
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// �ŏI�I�ɁA�Z�b�V������j�󂷂�
session_destroy();
?>

���O�A�E�g���܂�...
<meta http-equiv="refresh" content="2;URL=http://localhost/haxeon/index.php">

</body>

</html>
