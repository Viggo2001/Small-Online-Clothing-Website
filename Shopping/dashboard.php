<?php

    include('config/db_connect.php');

    $sql = 'SELECT image_load, name, price, created_at, id FROM dashboard ORDER BY created_at';

    $result = mysqli_query($conn, $sql);

    $dashboard = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    

    if (isset($_POST['delete'])) {

        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM dashboard WHERE id = $id_to_delete";

        if (mysqli_query($conn, $sql)) {
            // stay here
        } else {
            echo 'query error ' . mysqli_error($conn);
        }

    }

    if (isset($_POST['checkout'])) {
        
        $sql = 'DELETE FROM dashboard';

        if (mysqli_query($conn, $sql)) {
            // redirect
            header('Location: purchased.php');

            require_once('PHPMailer/');
        } else {
            echo 'query error ' . mysqli_error($conn);
        }


    }



?>



<?php include('templates/header.php'); ?>
<style>
    <?php include('templates/style.css'); ?>
</style>

    <main class="items-dash-section">
        
        <?php $counter = 0; ?>
        <?php $sum = 0; ?>
        

        <section class="dash-sec1">

            <div class="details-dash">
            
                <?php foreach($dashboard as $item): ?>
                
                <div class="card-dash">

                    <div class="image-dash">
                        <?php $blobimg = $item['image_load']; ?>
                        <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'"/>'; ?>
                    </div>
            
                    <div class="information">
                        <p>Name: <?php echo $item['name']; ?></p>
                        <p>Price: R <?php echo $item['price']; ?></p>
                        <p>In stock since: <?php echo $item['created_at']; ?></p>
                        <form action="dashboard.php" method="POST">
                            <input type="hidden" name="id_to_delete" value="<?php echo $item['id']; ?>">
                            <input type="submit" name="delete" value="delete item" class="delete-btn">
                        </form>
                    </div>
                        <?php $counter++;?>
                        <?php $sum += intval($item['price']); ?>


                </div>

                <?php endforeach; ?>
                
            
            </div>

        </section> 

        <section class="dash-sec2">

            <div class="info">
                <h3>Number of items selected: <?php echo $counter; ?></h3>
                <h3>Balance: R <?php echo $sum; ?></h3>
                <form action="dashboard.php" method="POST">
                    <input type="hidden" name="delete_all" value="<?php echo $dashboard; ?>">
                    <input type="submit" name="checkout" value="checkout">
                </form>
                
                <a href="store-men.php" class="add-more">add more items</a>

            </div>        


        
        </section>

        
        

        
    </main>

<?php include('templates/footer.php'); ?>