<?php

include 'db_conn.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $middleName = $_POST["middleName"];
  $emailAddress = $_POST["emailAddress"];
  $phoneNumber = $_POST["phoneNumber"];
  $address = $_POST["address"];
  $dateOfBirth = $_POST["dateOfBirth"];
  $gender = $_POST["gender"];
  $contactInfo = $_POST["contactInfo"];
  $bio = $_POST["bio"];
  $socialMedia = $_POST["socialMedia"];

  // Prepare SQL statement
  $sql = "INSERT INTO user_profile (firstname, lastname, middlename, email, phonenumber, address, date_of_birth, gender, contact_info, bio, social_media)
  VALUES ('$firstName', '$lastName', '$middleName', '$emailAddress', '$phoneNumber', '$address', '$dateOfBirth', '$gender', '$contactInfo', '$bio', '$socialMedia')";

  // Execute SQL statement
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error:" . $sql . "<br>" . $conn->error;
  }
}

// Close connection
$conn->close();
?>
