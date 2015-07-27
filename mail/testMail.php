<?php
if (mb_send_mail('delldell201507@gmail.com','EST SUBJECT','TEST BODY')) {
echo "送信完了";
} else {
echo "送信失敗";
}