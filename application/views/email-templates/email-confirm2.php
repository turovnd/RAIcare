<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Подтверждение электронной почты</title>
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
                                            <p style="margin:0 0 18px;font-weight: bold;font-size: 1.3em;">Здравствуйте, <?= $user->name ?>!</p>
                                            <p style="margin:12px 0 24px;font-size: 1.15em;">Для подтверждения электронного адреса, просто перейдите по ссылке: </p>
                                            <p style="margin:12px 0 24px;font-size: 1em;"><a href="<?= $_SERVER['HTTP_HOST'].'/confirm/'.$hash ?>" style="text-decoration: none;color: #008DA7;padding-bottom: 2px;border-bottom: 2px solid #008DA7;"><?= $_SERVER['HTTP_HOST'].'/confirm/'.$hash ?></a></p>
                                            <p style="margin:12px 0 0;font-size: .85em;">Ссылка действительна в течение <b>одного дня</b>.</p>
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
