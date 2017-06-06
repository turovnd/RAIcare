<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Заявка подана | <?=$GLOBALS['SITE_NAME']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body style="font-size: 16px;color: #212121;font-family: -apple-system, BlinkMacSystemFont, sans-serif;">

    <div style="width:100%;table-layout:fixed; text-align: center;">
        <table align="center" style="border-spacing:0;border-collapse:collapse;width:100%;max-width:580px;">
            <tbody>

                <!-- Main Info -->
                <tr align="left" style="text-align:left;">
                    <td align="left" valign="top" style="vertical-align:top;text-align:left;padding: 15px 0;">
                        <table width="100%" style="border-spacing: 0;border: 15px solid #008DA7;">
                            <tbody>
                                <tr align="left" style="text-align:left;">
                                    <td align="left" valign="top" style="vertical-align:top;text-align:left;background:#ffffff;padding: 35px; line-height: 1.5">
                                        <p style="margin:0 0 18px;font-weight: bold;font-size: 2em;">Заявка подана - <?=$GLOBALS['SITE_NAME']; ?>!</p>

                                        <p style="margin:12px 0 24px;font-size: 1.3em;"><?=$name; ?>,  Вы успешно подали заявку на сайте
                                            <a style="text-decoration: none;color: #008DA7;padding-bottom: 2px;border-bottom: 2px solid #008DA7;" href="<?=URL::base();?>"><?= 'https://' . $_SERVER['HTTP_HOST']; ?></a>!
                                        </p>

                                        <p style="margin:20px 0 0 0;font-size: .9em; line-height: 1.3; color: #777">
                                            Это сообщение сгенерировано автоматически и было отправлено на электронную почту:
                                            <a style="text-decoration: none; color: #777;" href="mailto:<?=$email; ?> "><?=$email; ?> </a> посредством отправки заявке на странице
                                            <a style="text-decoration: none; padding: 0 1px 2px; border-bottom: 1px solid #777;color: #777;" href="<?=URL::base();?>"><?='https://' . $_SERVER['HTTP_HOST'] . '/join'; ?></a>!
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</body>
</html>
