<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["path"])) {
        $file_path = $_GET["path"];

        // Check if the file path is provided and valid
        if (file_exists($file_path)) {
            $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));


                    
            // HTML content for displaying the file
            echo "<h1>File Content:</h1>";
            echo "<h1 hidden>hii</h1>";


            if (in_array($file_extension, array("pdf", "jpg", "jpeg", "png", "gif"))) {
                // Display images and PDF using <iframe> or <img>
                if ($file_extension == "pdf") {
                    echo '<iframe src="data:application/pdf;base64,' . base64_encode(file_get_contents($file_path)) . '" width="100%" height="600px"></iframe>';
                } else {
                    echo '<img src="data:image/' . $file_extension . ';base64,' . base64_encode(file_get_contents($file_path)) . '" alt="' . $file_path . '">';
                }
            } elseif (in_array($file_extension, array("mp4", "webm", "ogg"))) {
                // Display videos using <video> tag
                echo '<video width="100%" controls>
                          <source src="' . $file_path . '" type="video/' . $file_extension . '">
                      </video>';
            } elseif (in_array($file_extension, array("mp3", "wav", "ogg"))) {
                // Display audio using <audio> tag
                echo '<audio controls>
                          <source src="' . $file_path . '" type="audio/' . $file_extension . '">
                      </audio>';
            } elseif (in_array($file_extension, array("txt", "log", "csv", "html", "xml", "json"))) {
                // Display text-based formats
                $file_content = file_get_contents($file_path);
                echo "<pre>" . htmlspecialchars($file_content) . "</pre>";
            } else {
                // For unsupported file types
                echo "<span style='color:red;'>Unsupported file type.</span>";
            }
            echo "</div>";
            echo "</div>";


        } else {
            echo "<span style='color:red;'>File not found.</span>";
        }
    } else {
        echo "<span style='color:red;'>File path not provided.</span>";
    }
}
?>