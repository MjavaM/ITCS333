<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>UOB Student Nationality Data</title>

    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
   <link rel="stylesheet" href="styles.css">
 >
 

</head>
<body>
<?php
// Define the API endpoint URL
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch the data from the API endpoint
$response = file_get_contents($URL);

// Check if the response is valid
if ($response === FALSE) {
    die("Error: Unable to retrieve data.");
}

// Decode the JSON response to an associative array
$result = json_decode($response, true);

// Check if the JSON decoding was successful
if ($result === NULL) {
    die("Error: Unable to parse JSON data.");
}

// Display the retrieved data (for debugging purposes)
echo "<pre>";
print_r($result);
echo "</pre>";

?>

<main class="container">
        <h1>UOB IT Bachelor Students by Nationality</h1>
        <?php if (!empty($studentData)): ?>
            <div class="table-container">
                <table role="grid">
                    <thead>
                        <tr>
                            <th>Academic Year</th>
                            <th>College</th>
                            <th>Nationality</th>
                            <th>Total Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($studentData as $entry): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($entry['academic_year'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($entry['colleges'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($entry['nationalities'] ?? 'N/A'); ?></td>
                            
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No data available.</p>
        <?php endif; ?>
    </main>
</body>
</html>