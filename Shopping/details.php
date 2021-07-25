<?php

    include('config/db_connect.php');

    if (isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM items WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        $item = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        mysqli_close($conn);

    }

    if (isset($_POST['submit'])) {

        $id_to_add = mysqli_real_escape_string($conn, $_POST['id_to_add']);

        $sql = "INSERT INTO dashboard(name, price, image_load, created_at) SELECT name, price, image_load, created_at FROM items WHERE id = $id_to_add ";

        if (mysqli_query($conn, $sql)) {
            header('Location: dashboard.php');
        } else {
            echo 'query error ' . mysqli_error($conn);
        }

    }

?>


<?php include('templates/header.php'); ?>
<style>
    <?php include('templates/style.css'); ?>
</style>

    <main class="items-body-section">

        <?php if($item): ?>
        <div class="details">

            <div class="image">
                <?php $blobimg = $item['image_load']; ?>
                <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'"/>'; ?>
            </div>
            
            <div class="information">
                <p>Name: <?php echo $item['name']; ?></p>
                <p>Price: R <?php echo $item['price']; ?></p>
                <p>In stock since: <?php echo $item['created_at']; ?></p>

                <div class="add-cart">
                    <form action="details.php" method="POST">
                        <input type="hidden" name="id_to_add" value="<?php echo $item['id']; ?>" class="del">
                        <input type="submit" name="submit" value="add to cart">
                    </form>
                </div>
            </div>
    
                
        </div>
        <?php else: ?>
            <div class="error-message"><?php echo 'No such item exists'?></div>
        <?php endif; ?>

    </main>
    



<?php include('templates/footer.php'); ?>