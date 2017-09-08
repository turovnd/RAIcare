<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Вас исключили из организации на сайте <?= $GLOBALS['SITE_NAME']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>

    <body style="font-size: 16px;color: #212121;font-family: -apple-system, BlinkMacSystemFont, sans-serif;">

        <center style="width:100%;table-layout:fixed;">
            <table align="center" style="border-spacing:0;border-collapse:collapse;width:100%;max-width:580px;">
                <tbody>

                <tr align="left" style="text-align:left;">
                    <td align="left" valign="top" style="vertical-align:top;text-align:left;padding: 15px 0;">
                        <table width="100%" style="border-spacing: 0;border: 15px solid #008DA7;">
                            <tbody>
                            <tr align="left" style="text-align:left;">
                                <td align="left" valign="top" style="vertical-align:top;text-align:left;background:#ffffff;padding: 35px;">
                                    <p style="margin:0 0 18px;font-weight: bold;font-size: 1.3em;">Здравствуйте, <?= $uName; ?>!</p>
                                    <p style="margin:12px 0 24px;font-size: 1.15em;">Вас только что исключили из организации <?= $orgName; ?>. Если это произошло по какой-либо ошибке, пожалуйста, свяжитесь с <b><?= $ownerName; ?></b> для восстановления аккаунта.</p>
                                    <p style="margin:12px 0 0;font-size: .85em;">Ваш <b>логин</b> и <b>пароль</b> больше не действителен на сайте <?= strtolower($GLOBALS['SITE_NAME']) . '.ru'; ?></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                </tbody>
            </table>
        </center>

    </body>
</html>
