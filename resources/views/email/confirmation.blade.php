<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Confirmaciòn</title>
  <!-- Designed by https://github.com/kaytcat -->
  <!-- Robot header image designed by Freepik.com -->

  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

    /* Take care of image borders and formatting */

    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    a {
      text-decoration: none;
      border: 0;
      outline: none;
      color: #bbbbbb;
    }

    a img {
      border: none;
    }

    /* General styling */

    td,
    h1,
    h2,
    h3 {
      font-family: Helvetica, Arial, sans-serif;
      font-weight: 400;
    }

    td {
      text-align: center;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #ffffff;
      font-size: 16px;
    }

    table {
      border-collapse: collapse !important;
    }

    .headline {
      color: #ffffff;
      font-size: 28px;
    }

    .force-full-width {
      width: 98% !important;
    }

    .btn {
    background:#4dbfbf;
    padding:10px;
    border-radius:15px;
    color:white;
  }

  </style>

  <style type="text/css" media="screen">
    @media screen {

      /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
      td,
      h1,
      h2,
      h3 {
        font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class="w320"] {
        width: 320px !important;
      }


    }
  </style>
</head>

<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
  <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td align="center" valign="top" bgcolor="#ffffff" width="100%">
        <center>
          <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
            <tr>
              <td align="center" valign="top">

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#4dbfbf">
                  <tr>
                    <td>
                      <img align="center" src="https://www.filepicker.io/api/file/XXpJ4RwWQqlVoWN8psfj" width="80" height="100" alt="robot picture">
                    </td>

                  </tr>
                  <tr>
                    <td class="headline">
                      <br>
                      <?php $upperCaseLastName = ucfirst($lastName); ?>
                      {{$upperCaseLastName}}, tu codigo es {{$code}}
                      <br>
                      <br>


                    </td>
                    <td>

                      <center>
                        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
                          <tr>
                            <td>
                              <br>
                              <br>
                              <br>
                              <br>
                            </td>
                          </tr>
                        </table>
                      </center>

                    </td>
                  </tr>

                </table>

                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#414141" style="margin: 0 auto">
                  <tr>
                    <td style="background-color:#414141;">
                      <br>
                      <br>
                      <center>
                        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="70%">
                          <tr>
                            <td style="color:#fff;">
                              <br>
                              Para verificar que <a style="color:#fff;text-decoration:none;">{{$email}}</a> te pertenece, copiá este código y continuá la creación de tu cuenta
                              <br>
                              
                            </td>
                          </tr>
                        </table>
                      </center>
                      <br>
                      <br>
                    </td>
                  </tr>
                  <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#414141" style="margin: 0 auto">
                    <tr>
                      <td style="background-color:#414141;">
                        <br>
                       
                        <center>
                          <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="70%">
                            <tr>
                              <td style="color:#fff;">
                                <br>
                                <a style="color:white;text-decoration:none;" href="https://macrocomercio.netlify.app/registration/<?= $token ?>" class="btn">Ó ingrese aqui</a>
                                <br>
                                <br>

                                <br>
                                
                              </td>
                            </tr>
                          </table>
                        </center>
                        <br>
                        <br>
                      </td>
                    </tr>
                  </table>
                </table>
              </td>
            </tr>
          </table>
        </center>
      <td>
    </tr>
    <tr>
        <center>
            <br>
        ¿Necesitas ayuda? <a href="https://google.com" style="color:blue">Contactanos</a>
        </center>
        
    </tr>
  </table>
  
</body>

</html>