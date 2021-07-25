<?php

    // info
    include('config/db_connect.php');

    if (isset($_POST['delete'])) {

        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'query error ' . mysqli_error($conn);
        }

    }

    if (isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM pizzas WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        mysqli_close($conn);

    }

?>


<?php include('templates/header.php'); ?>

<style>
<?php include('templates/style.css'); ?>
</style>

<?php if($pizza): ?>
    <div class="more-info">
        <h1 class="id-title"><?php echo htmlspecialchars($pizza['title']); ?></h1>
        <p><?php echo htmlspecialchars($pizza['email']); ?></p>
        <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>
        <p><?php echo htmlspecialchars($pizza['created_at']); ?></p>
    </div>

<?php else: ?>
    <h1 class="else-class">NO SUCH PIZZA!</h1>
<?php endif; ?>

<form action="details.php" method="POST">
    <div class="delete">
        <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>" class="del">
        <input type="submit" name="delete" value="DELETE" class="del">
    </div>
</form>


<?php include('templates/footer.php'); ?>