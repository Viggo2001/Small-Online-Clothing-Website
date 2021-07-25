<?php

    include('config/db_connect.php');

    $sql = 'SELECT image_load, name, price, id FROM items_w ORDER BY created_at ';

    $result = mysqli_query($conn, $sql);

    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);

?>


<?php include('templates/header.php'); ?>
<style>
    <?php include('templates/style.css'); ?>
</style>

    <main class="items-body-section">
        <section class="section1">
            <nav class="left-side">
                <ul class="gender-list">
                    <li><a href="store-men.php" class="men">Men</a></li>
                    <li><a href="store-women.php" class="women">Women</a></li>
                </ul>
            </nav>
        </section>
        <section class="section2">

        <h1 class="items-header">ITEMS AVAILABLE IN STORE</h1>
            <div class="card-wrapper">

                <?php foreach($items as $item): ?>
                    <?php $blobimg = $item['image_load']; ?>
                    <div class="card">
                        <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'"/>'; ?>
                        <h3 class="item-name"><?php echo $item['name']; ?></h3>
                        <p class="price">R <?php echo $item['price']; ?></p>

                        <a href="details_women.php?id=<?php echo $item['id']; ?>" class="purchase1">ADD TO CART</a>

                        <?php ?>
                        
                    </div>
                <?php endforeach; ?>

            </div>
            
        </section>
        <section class="section3">
            <div class="card-sec3-wrap">
                <div class="card-sec3">
                    <h1>More Options</h1>
                    <a href="dashboard.php">GO TO DASHBOARD</a>
                </div>
            </div>

            <div class="icons">
                <a href="https://www.facebook.com/profile.php?id=100007101915734" target="_blank"><img src="templates/images/facebook.png" alt="can't load image"></a>
                <a href="https://www.instagram.com/odwasiyotula/" target="_blank"><img src="templates/images/instagram.png" alt="can't load image"></a>
                <a href="https://www.youtube.com/channel/UCErVi3YiUOS1l3nt8nt-usg" target="_blank"><img src="templates/images/youtube.png" alt="can't load image"></a>
                <a href="gmail.com" target="_blank" ><img src="templates/images/gmail.png" alt="can't load image"></a>
            </div>

        </section>
    </main>

<?php include('templates/footer.php'); ?>