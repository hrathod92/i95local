<?php
  // Open connection
  $mysqli = new mysqli('72.52.245.41', 'i95business_prod', 'x]GP4TThGKc~', 'i95business_prod');
  if ($mysqli->connect_errno) {
    die("Failed to connect with error: " . $mysqli->error . "\n");
  }

  $sqlSelect = "SELECT id, body FROM articles";
  $result = $mysqli->query($sqlSelect) or die("Failed to execute query with error: " . $mysqli->error . "\n");
  
  // Make directory if it does not exist
  if (!file_exists('./public/uploads/wp_content')) {
    mkdir('./public/uploads/wp_content', 0644);
    chmod('./public/uploads/wp_content', 0644);
    chown('./public/uploads/wp_content', "cgdev2");
    chgrp('./public/uploads/wp_content', "cgdev2");
    echo "directory made!";
  };
  
  // Loop through body fields
  $needle = 'http://i95business.com/wp-content/uploads';
  while ($article = $result->fetch_assoc()) {
    // Convert to DOM object
    $id = $article['id'];
    $HTML = new DOMDocument();
    $HTML->loadHTML($article['body']);
    $selector = new DOMXPath($HTML);

    // Select all img tages that contain the wordpress URL
    $collection = $selector->query('//img[contains(@src, "http://i95business.com/wp-content/uploads")]');
    if ($collection->length > 0) { 
      foreach ($collection as $key => $element) {
        $fileURL = $element->getAttribute('src');
        // Download the images fromt he WP install
        file_put_contents("./public/uploads/" . basename($fileURL), fopen($fileURL, 'r'));
        chown("./public/uploads/" . basename($fileURL), "cgdev2");
        chgrp("./public/uploads/" . basename($fileURL), "cgdev2");
        // Set the new path to the img element
        $element->setAttribute('src', '/uploads/' . basename($fileURL));
      }
      $body = $HTML->saveHTML($HTML->documentElement);
      $body = addslashes($body);
      
      $mysqli->set_charset('utf8');
      $sqlUpdate = "UPDATE articles SET body='$body' WHERE id=$id";
      if (!$output = $mysqli->query($sqlUpdate)) {
        die("Failed to execute query with error: " . $mysqli->error . "\n");
      }
    }
  }
  $result->free();
?>
