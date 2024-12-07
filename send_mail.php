<?php
// 引入 PHPMailer 的自動加載文件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

// 創建 PHPMailer 實例
$mail = new PHPMailer(true);

try {
    // 設定 SMTP 伺服器的配置
    $mail->isSMTP();                                      // 設定使用 SMTP
    $mail->Host       = 'smtp.gmail.com';               // SMTP 伺服器
    $mail->SMTPAuth   = true;                             // 開啟 SMTP 驗證
    $mail->Username   = 'a0987293061@gmail.com';         // SMTP 帳號
    $mail->Password   = 'mrvbleikhfokoiib';            // SMTP 密碼
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // 開啟加密 (SSL/TLS)
    $mail->Port       = 465;                              // SMTP 伺服器端口號，SSL 通常是 465，TLS 是 587

    // 設定收件人和寄件人
    $mail->setFrom('a0987293061@gmail.com', '寄件人名稱');
    $mail->addAddress('s532019@icloud.com', '收件人名稱');   // 收件人

    // 附加檔案（可選）
    // $mail->addAttachment('/path/to/file.pdf');         // 附加文件

    // 設定郵件內容
    $mail->isHTML(true);                                  // 設定郵件格式為 HTML
    $mail->Subject = '測試測試信件';                   // 郵件主題
    $mail->Body    = '這是一封 <b>HTML</b> 格式的測試信件喔喔喔喔。';  // 郵件內容（HTML 格式）
    $mail->AltBody = '這是一封純文字的測試信件喔喔。';            // 若不支援 HTML 時顯示的純文字內容

    // 發送郵件
    $mail->send();
    echo '信件已成功寄出';
} catch (Exception $e) {
    echo "信件寄送失敗: {$mail->ErrorInfo}";
}
?>