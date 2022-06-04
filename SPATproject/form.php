<?php

session_start();
$view = new stdClass();
$view->pageName = 'form';
require_once('Models/formDataSet.php');

//Include required phpmailer files
require('includes/PHPMailer.php');
require('includes/SMTP.php');
require('includes/Exception.php');

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function submitForm()
{
    $view = new stdClass();
    $view->pageName = 'form';

    if (isset($_SESSION['username'])) {
        if (isset($_POST['submit'])) {

            if (!isset($_POST['form'])) {
                echo "Please select at least one task type.";
            }

            else {
                $formDataSet = new formDataSet();
                $formArray = $_POST['form'];
                $task = implode(",", $formArray);

                $userid = $formDataSet->insertForm((htmlentities($_POST['companyName'])), (htmlentities($_POST['contactName'])),
                    (htmlentities($_POST['contactNo'])), (htmlentities($_POST['Address'])), (htmlentities($_POST['Date'])),
                    $task , (htmlentities($_POST['Quantity'])), (htmlentities($_POST['Vehicle'])),
                    (htmlentities($_POST['Sim'])), (htmlentities($_POST['IMEI'])), (htmlentities($_POST['Remarks'])),
                    (htmlentities($_POST['Technician'])), (htmlentities($_POST['email'])));
                if ($userid > 0) {
                    // Send email to client and company

                    // Creating instance of phpmailer
                    $mail = new PHPMailer();
                    // Set mailer to use smtp
                    $mail->isSMTP();
                    //define smtp host
                    $mail->Host = "smtp.gmail.com";
                    // SMTP authentication
                    $mail->SMTPAuth = "true";
                    // set type of encryption
                    $mail->SMTPSecure = "tls";
                    // Set port to connect smtp
                    $mail->Port = "587";
                    // set gmail username
                    $mail->Username = "spatialnoreply@gmail.com";
                    // set gmail pass
                    $mail->Password = "sts12345";
                    // Email subject
                    $mail->Subject = 'STS Service Receipt';
                    // Email sender
                    $mail->setFrom("spatialnoreply@gmail.com");


                    // Email message body (edit this as per your requirements)
                    $mail->Body = "Your service receipt \r\n Company Name: ".htmlentities($_POST['companyName']). "\r\n Task Type: ".$task."\r\n Vehicle No: ".htmlentities($_POST['Vehicle'])."\r\n Remarks: ".htmlentities($_POST['Remarks']);

                    // Email client
                    $mail->addAddress(htmlentities($_POST['email']));
                    // Email company (edit it below)
                    $mail->addAddress("companyEmailHere");

                    // Send email
                    if (!$mail->Send()) {
                        // Send error (this can be edited too)
                        echo "Error!";
                    } else {
                        // Redirect user
                        header("Location:record.php");
                    }
                }
            }
        }
    }
    return $view;
}

$view = submitForm();
require_once('Views/form.phtml');

?>
