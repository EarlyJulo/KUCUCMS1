<?php
if(isset($_POST['send'])) {
    // Establish a database connection
    $conn = mysqli_connect("localhost", "root", "", "cman");

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    if (strtotime($date) < strtotime(date("Y-m-d"))) {
        echo "<script type='text/javascript'>alert('The date is invalid. Please enter a date equal or greater than today');</script>";
        exit();
    } else {
        // Insert data into the event table
        $qry = "INSERT INTO event (Title, Date, content) VALUES('$title', '$date', '$content')";
        $result = mysqli_query($conn, $qry) or die(mysqli_error($conn));

        if($result == TRUE){
            // Retrieve email addresses from members table
            $emailQuery = "SELECT email FROM members";
            $emailResult = mysqli_query($conn, $emailQuery);

            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';
            require 'phpmailer/src/Exception.php';

            // Initialize PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kucucms@gmail.com';
            $mail->Password = 'hgmx llxr jduj hzdv';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('kucucms@gmail.com');

            if ($emailResult) {
                while ($row = mysqli_fetch_assoc($emailResult)) {
                    $recipient_email = $row['email'];
                    $mail->addAddress($recipient_email);
                }
            }

            // Set email subject and content
            $mail->isHTML(true);
            $mail->Subject = $title;
            $mail->Body = $content;

            // Send email
            if ($mail->send()) {
                echo "<script type = \"text/javascript\">
                        alert(\"Email sent successfully.\");
                        window.location = (\"events.php\");
                      </script>";
            } else {
                echo "<script type = \"text/javascript\">
                        alert(\"Email sending failed. Please try again.\");
                      </script>";
            }
        } else {
            echo "<script type = \"text/javascript\">
                    alert(\"Event not saved. Please try again.\");
                  </script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<div class="row-fluid">
    <!-- block -->
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><i class="icon-plus-sign icon-large"> ADD EVENT</i></div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
                <form method="post">
                    <table>
                        <tr>
                            <td style="color: #003300; font-weight: bold; font-size: 16px">Add Event Here:</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="title" placeholder="Title"></td>
                        </tr>

                        <tr>
                            <td><input type="date" name="date" value="Date"></td>
                        </tr>
                        <tr>
                            <td>
                                <textarea name="content" placeholder="Description" class="text"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="send" value="SAVE"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <!-- /block -->
</div>
