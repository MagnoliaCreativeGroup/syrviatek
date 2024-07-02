<?php
// Initialize variables
$name = $email = $phone = $address = "";
$nameErr = $emailErr = "";
$successMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set and not empty
    if (isset($_POST["name"]) && !empty($_POST["name"]) &&
        isset($_POST["email"]) && !empty($_POST["email"])) {
        
        // Sanitize and validate the email address
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email address!";
        } else {
            // Process other fields
            $name = $_POST["name"];
            $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
            $address = isset($_POST["address"]) ? $_POST["address"] : "";

            // Prepare the email message
            $to = "info@Syrviatek.com";
            $subject = "New Contact Form Submission";
            $message = "Name: $name\n";
            $message .= "Email: $email\n";
            $message .= "Phone Number: $phone\n";
            $message .= "Address: $address\n";

            // Additional headers
            $headers = "From: Syrviatek.com <noreply@syrviatek.com>\r\n";
            $headers .= "Reply-To: $name <$email>\r\n";

            // Send email
            if (mail($to, $subject, $message, $headers)) {
                // Redirect to Thank You after successful submission
                header("Location: https://syrviatek.com/contact/thankyou");
                exit(); // Ensure that subsequent code is not executed after redirection
            } else {
                echo "Failed to send email. Please try again later.";
            }
        }
    } else {
        $nameErr = "Name and email are required fields!";
    }
}
?>