<?php
	$firstName = $_POST['fullName'];  // Getting first name from form input
	$registrationNo = $_POST['registrationNo'];  // Getting registration number from form input
	$semester = $_POST['semester'];  // Getting selected semester
	$course = $_POST['course'];  // Getting selected course

	// Database connection
	$conn = new mysqli('localhost', 'root', '', 'test');  // Adjust DB name if needed
	if ($conn->connect_error) {
		die("Connection Failed: " . $conn->connect_error);
	} else {
		// Prepare the SQL statement
		$stmt = $conn->prepare("INSERT INTO registration (fullName, registrationNo, semester, course) VALUES (?, ?, ?, ?)");

		// Check if prepare() failed
		if ($stmt === false) {
			die("Error preparing the statement: " . $conn->error);
		}

		// Binding parameters
		$stmt->bind_param("ssss", $firstName, $registrationNo, $semester, $course);

		// Execute the statement
		$execval = $stmt->execute();

		// Check if execution was successful
		if ($execval) {
			echo "Registration successful!";
		} else {
			echo "Error executing the statement: " . $stmt->error;
		}

		// Close the statement and connection
		$stmt->close();
		$conn->close();
	}
?>
