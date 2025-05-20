<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Replace this with your real email address
  $to = "mohamed.ahmed.abdelrazek.dev@gmail.com";

  // Sanitize input
  $name = strip_tags(trim($_POST["name"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

  // Validate
  if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
    http_response_code(400);
    echo "Please fill out the form correctly.";
    exit;
  }

  // Email content
  $email_content = "From: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";

  // Email headers
  $headers = "From: $name <$email>";

  // Send email
  if (mail($to, $subject, $email_content, $headers)) {
    http_response_code(200);
    echo "Your message has been sent.";
  } else {
    http_response_code(500);
    echo "Sorry, something went wrong. Please try again.";
  }
} else {
  http_response_code(403);
  echo "There was a problem with your submission.";
}
?>
