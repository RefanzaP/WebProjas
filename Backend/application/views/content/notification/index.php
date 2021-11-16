<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
        <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
        <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
        <title><?= lang("service_center_um")." | ".date("Y") ?></title>

        <style type="text/css">
            body {
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }


            table {
                border-spacing: 0;
            }

            table td {
                border-collapse: collapse;
            }

            .ExternalClass {
                width: 100%;
            }

            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
                line-height: 100%;
            }

            .ReadMsgBody {
                width: 100%;
                background-color: #ebebeb;
            }

            table {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }

            img {
                -ms-interpolation-mode: bicubic;
            }

            .yshortcuts a {
                border-bottom: none !important;
            }

            @media screen and (max-width: 599px) {
                .force-row, .container {
                    width: 100% !important;
                    max-width: 100% !important;
                }
            }
            @media screen and (max-width: 400px) {
                .container-padding {
                    padding-left: 12px !important;
                    padding-right: 12px !important;
                }
            }
            .ios-footer a {
                color: #aaaaaa !important;
                text-decoration: underline;
            }
            a[href^="x-apple-data-detectors:"], a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
        </style>
    </head>

    <body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
            <tr>
                <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;"><br>
                    <table style="border-top: 20px solid #64B5F6" border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
                        <tr>
                            <td colspan="2" class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff"><br>

                                <div class="title" style="float:left; line-height: 70px; font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:600;color:#374550;width: 50%">  
                                    <?= lang("service_center_um") ?>
                                </div>
                                <div class="title" style="float:left; line-height: 35px;font-family:Helvetica, Arial, sans-serif; text-align:right;font-size:15px;font-weight:600;color:#374550;width: 50%">
                                    <?= lang("notifikasi") ?> <?= $subject ?>
                                </div>
                                <div class="title" style="float:left; line-height: 25px; font-family:Helvetica, Arial, sans-serif;text-align:right;font-size:15px;color:#374550;width: 50%">
                                    <?= date("d M Y") ?>
                                </div>
                                <hr style="clear:both; background-color:#64B5F6; border:none; height: 3px" />
                                <br>

                                <div class="title" style="float:left; line-height: 30px; font-family:Helvetica, Arial, sans-serif;font-size:12px;font-weight:600;color:#374550;width: 85%">
                                    <?= lang("hai") ?><?php role($user['role']) ?><?= " ".$user['nama']."," ?>
                                </div>
                                <div class="body-text" style="clear:both;font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;">
                                    <span style="color:#374550"><?= $body ?></span>
                                </div>
                                <br><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
                                <br><br>
                                <?= lang("footer") ?>
                                <br><br>
                            </td>
                            <td>
                                <table width="150" border="0" cellspacing="0" cellpadding="0" align="right">
                                    <tr>
                                        <td width="33" align="center"><a href="#" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/1f9161ee-46b5-4bdf-86db-9e32d4b98336.jpg" alt="facebook" width="36" height="36" border="0" style="border-width:0; max-width:36px;height:auto; display:block; max-height:36px"/></a></td>
                                        <td width="34" align="center"><a href="#" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/4e449140-ec71-4978-97bf-8e0f15b5ff23.jpg" alt="twitter" width="36" height="36" border="0" style="border-width:0; max-width:36px;height:auto; display:block; max-height:36px"/></a></td>
                                        <td width="33" align="center"><a href="#" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/d21cca91-335e-4fa4-9313-b0ea37e0452b.jpg" alt="linkedin" width="36" height="36" border="0" style="border-width:0; max-width:36px;height:auto; display:block; max-height:36px"/></a></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>