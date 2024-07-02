<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set and not empty
    if (isset($_POST["name"]) && !empty($_POST["name"]) &&
        isset($_POST["email"]) && !empty($_POST["email"])) {
        
        // Sanitize and validate the email address
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email address!";
            exit(); // Stop further execution
        }

        // Process other fields
        $name = $_POST["name"];
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
        $address = isset($_POST["address"]) ? $_POST["address"] : "";

        // Prepare the email message
        $to = "information@expensevisor.com";
        $subject = "New Contact Form Submission";
        $message = "Name: $name\n";
        $message .= "Email: $email\n";
        $message .= "Phone Number: $phone\n";
        $message .= "Address: $address\n";

        // Send email
        if (mail($to, $subject, $message)) {
            // Redirect to expensevisor.com after successful submission
            header("Location: https://expensevisor.com");
            exit(); // Ensure that subsequent code is not executed after redirection
        } else {
            echo "Failed to send email. Please try again later.";
        }
    } else {
        echo "Name and email are required fields!";
    }
} else {
    // If someone tries to access submit_contact.php directly
    echo "This page can't be accessed directly!";
}
?>