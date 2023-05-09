<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title>Add Products</title>
    <style>
      /* Global Styles */

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #333;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  font-size: 36px;
  margin-bottom: 20px;
}

form label {
  display: block;
  margin-bottom: 10px;
  font-size: 18px;
}

form input,
form textarea {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form textarea {
  height: 200px;
}

form input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  font-size: 18px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

form input[type="submit"]:hover {
  background-color: #3e8e41;
}

/* Media Queries */

@media screen and (max-width: 600px) {
  .container {
    padding: 10px;
  }
  
  h1 {
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  form label {
    font-size: 16px;
    margin-bottom: 5px;
  }
  
  form input,
  form textarea {
    padding: 5px;
    margin-bottom: 10px;
    font-size: 14px;
  }
  
  form input[type="submit"] {
    font-size: 16px;
    padding: 10px 15px;
  }
  
}
form select {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form option {
  font-size: 16px;
}


    </style>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container">
      <h1>Add Products</h1>
      <form id="add-product-form">
        <label for="product-name">Product Name:</label>
        <input type="text" id="product-name" name="product-name">
        <label for="product-category">Category:</label>
<select id="product-category" name="product-category">
  <option value="option1">Tour</option>
  <option value="option2">Vehicles</option>
  <option value="option3">Party</option>

</select>

        
        <label for="product-price">Price:</label>
        <input type="number" id="product-price" name="product-price">
        
        <label for="product-description">Description:</label>
        <textarea id="product-description" name="product-description" rows="4" cols="50"></textarea>
        
        <label for="product-image">Image:</label>
        <input type="file" id="product-image" name="product-image">

        
        <input type="submit" value="Add Product">
      </form>
      
      
    </div>
    <?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data
  $name = $_POST['product-name'];
  $category = $_POST['product-category'];
  $price = $_POST['product-price'];
  $description = $_POST['product-description'];
  // Get the image file
  $image = $_FILES['product-image'];

  // Handle the image file upload
  $uploadDir = 'uploads/';
  $uploadFile = $uploadDir . basename($image['name']);
  if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
    // File upload successful
    // Add the product to the database
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'rentit';
    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    if ($conn) {
      $sql = "INSERT INTO products (name, category, price, description, image) VALUES ('$name', '$category', $price, '$description', '$uploadFile')";
      if (mysqli_query($conn, $sql)) {
        // Product added successfully
        echo 'Product added!';
      } else {
        echo 'Error adding product: ' . mysqli_error($conn);
      }
      mysqli_close($conn);
    } else {
      echo 'Error connecting to database: ' . mysqli_connect_error();
    }
  } else {
    // File upload failed
    echo 'Error uploading image file.';
  }
}
?>


    <script>
      const form = document.querySelector('#add-product-form');
      const category = document.querySelector('#product-category').value;

      const imagePreview = document.querySelector('#preview-image');
      const captionPreview = document.querySelector('#preview-caption');
      
      // Show image preview when user selects an image
      document.querySelector('#product-image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.addEventListener('load', function() {
            imagePreview.setAttribute('src', reader.result);
          });
          reader.readAsDataURL(file);
        }
      });
      
      // Update caption preview as user types in description
      document.querySelector('#product-description').addEventListener('input', function() {
        captionPreview.textContent = this.value;
      });
      
      form.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the form from submitting

        // Get the values from the form
        const name = document.querySelector('#product-name').value;
        const price = document.querySelector('#product-price').value;
        const description = document.querySelector('#product-description').value;

        // Do something with the values (e.g. send a request to the backend)
        console.log(`Adding product: ${name}, Price: ${price}, Description: ${description}`);

        // Reset the form
        form.reset();
        imagePreview.setAttribute('src', '#');
        captionPreview.textContent = '';
      });
    </script>
  </body>
</html>
