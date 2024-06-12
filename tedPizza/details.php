<?php
include("config/db_connect.php");

if(isset($_POST['delete'])){
    // escape sql inputs 
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM pizzas where id = $id_to_delete";
    if(mysqli_query($conn, $sql)){
        // success
        // after deleting redirect to index.php file.
        header('Location: index.php');
    } else {
        // failuer 
        echo 'query error: ' / mysqli_error($conn);
    }
}

// check GET request id param
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // sql query
    $sql = "SELECT * FROM pizzas where id = $id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch the result in array format (gets only one result as an associative array)
    $pizza = mysqli_fetch_assoc($result);

    // free memory;
    mysqli_free_result($result);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include("templates/header.php"); ?>

<div class="container center grey-text">
    <?php if ($pizza) : ?>
        <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
        <p>Created by : <?php echo htmlspecialchars($pizza['email']); ?></p>
        <p><?php echo date($pizza['created_at']); ?></p>
        <h5>Ingredients:</h5>
        <ul>
            <?php foreach (explode(',', $pizza['ingredients']) as $ing) :  ?>
                <li><?php echo $ing ?></li>
            <?php endforeach ?>
        </ul>

        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>
    <?php else: ?>
        <h5>No such pizza exists !:(</h5>
    <?php endif ?>
</div>

<?php include("templates/footer.php"); ?>

</html>