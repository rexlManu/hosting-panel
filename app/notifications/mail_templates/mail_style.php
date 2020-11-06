<?php

$name = 'SiteName';
$siteDomain = 'SiteName.de';
$url = 'https://kd1126-1.sylvan.ooo/';
$cdnUrl = $url.'assets/style/';
$picUrl = $url.'assets/images/';

$emailBody = '
<!DOCTYPE html>
<html>
   <body style="background-color: #222533; padding: 20px; font-family: font-size: 14px; line-height: 1.43; font-family: &quot;Helvetica Neue&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif;">
      <div style="max-width: 600px; margin: 0px auto; background-color: #fff; box-shadow: 0px 20px 50px rgba(0,0,0,0.05);">
         <table style="width: 100%;">
            <tr>
               <td style="background-color: #fff;">
                  <img alt="" src="'.$picUrl.'logo/logo.png" style="width: 100px; padding: 20px">
               </td>
            </tr>
         </table>
'.$mailContent.'
        <div style="background-color: #F5F5F5; padding: 40px; text-align: center;">
            <div style="margin-bottom: 20px;">
               <a href="'.$url.'login" style="text-decoration: underline; font-size: 14px; letter-spacing: 1px; margin: 0px 15px; color: #261D1D;">Support</a><a href="'.$url.'datenschutz" style="text-decoration: underline; font-size: 14px; letter-spacing: 1px; margin: 0px 15px; color: #261D1D;">Datenschutz</a>
            </div>
         </div>
      </div>
   </body>
</html>
';
