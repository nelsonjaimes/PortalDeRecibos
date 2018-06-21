<?php

                      $email =isset($_POST['info_email'])?$_POST['info_email']:null;

                      require 'php2/PHPMailerAutoload.php';
                      $mail = new PHPMailer;

                      //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                       $mail->isSMTP(); 
                      $mail->Host = 'smtp.gmail.com'; 
                      $mail->SMTPAuth = true; 
                      $mail->Username = 'nelsonjaimesgonzales@gmail.com'; 
                      $mail->Password = 'Chin0st0nE2016'; 
                      $mail->SMTPSecure = 'tls'; 
                      $mail->Port = 587;

                      $mail->addAddress($email, 'Joe User');     // Add a recipient
                      

                      $mail->addAttachment('../files/pack.rar');         // Add attachments
                      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                      $mail->isHTML(true);                                  // Set email format to HTML

                      $mail->Subject = 'Here is the subject';
                      $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                      if(!$mail->send()) {
                          echo 0;
                          //echo 'Mailer Error: ' . $mail->ErrorInfo;
                      } else {
                          echo 1;
                      }
                       
                    



                    


                    ?>