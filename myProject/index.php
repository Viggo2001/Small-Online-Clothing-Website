<?php

    include('config/db_connect.php');

    $sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

    $result = mysqli_query($conn, $sql);

    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);

?>

<?php include('templates/header.php'); ?>

<style>
    <?php include('templates/style.css'); ?>
</style>

<h1 class="pizzas-head">Pizzas You Selected</h1>

<div class="card-wrapper">
    <?php $counter = 0; ?>
    <?php foreach($pizzas as $pizza): ?>
    <div class="card">
            <h1><?php echo $pizza['title']; ?></h1>
            <!-- <ul> -->
                <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                    <p><?php echo $ing; ?></p>
                <?php endforeach; ?>
            <!-- </ul> -->
            <?php $counter++; ?>
            <hr><br>
            <a href="details.php?id=<?php echo $pizza['id']; ?>" class="more">MORE INFO</a>
    </div>
    <?php endforeach; ?>
</div>
<div class="counter"><h1>Number of selected pizzas: <?php echo $counter; ?></h1></div>


<?php include('templates/footer.php'); ?>