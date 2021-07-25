<?php

    include('config/db_connect.php');

    $email = $title = $ingredients = '';
    $errors = ['email' => '', 'title' => '', 'ingredients' => ''];
    if (isset($_POST['submit'])) {

        // check email
        if (empty($_POST['email'])) {
            $errors['email'] = 'required field';
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'please enter correct format';
            }
        }

        // check title
        if (empty($_POST['title'])) {
            $errors['title'] = 'required field';
        } else {
            $title = $_POST['title'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                $errors['title'] = 'please enter correct format';
            }
        }

        // check ingredients
        if (empty($_POST['ingredients'])) {
            $errors['ingredients'] = 'required field';
        } else {
            $ingredients = $_POST['ingredients'];
            if (!preg_match('/^([a-zA-z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                $errors['ingredients'] = 'please enter the correct format';
            }
        }
    
        if (array_filter($errors)) {
            // remain at this page
        } else {
            // redirect
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            $sql = "INSERT INTO pizzas(email, title, ingredients) VALUES('$email', '$title', '$ingredients')";

            if(mysqli_query($conn, $sql)){
                // success
                header('Location: index.php');
            } else {
                echo 'query error ' . mysqli_error($conn);
            }
            
        }
    
    }

?>

<?php include('templates/header.php'); ?>

<style>
<?php include('templates/style.css'); ?>
</style>

<div class="form-header">
    <h1>Add Your Pizza</h1>
</div>

<div class="form-wrapper">
    <form action="add.php" method="POST" class="add-form">
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>
        <label>Ingredients:</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>

        <div class="submit">
            <input type="submit" value="submit" name="submit" class="submit">
        </div>
        
    </form>
</div>


<?php include('templates/footer.php'); ?>