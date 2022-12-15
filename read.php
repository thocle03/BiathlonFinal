<?php
require "./Vues/layout/header.php";

$posts = $postController->readAll();

?>

<?php

$id = $_GET["id"];
$post = $postController->read($id);
//var_dump($post);
$comments = $commentController->getAllByPostId($id);

if ($_POST) {
    //var_dump($_POST);
    $newComment = new Comment($_POST);
    $newComment->setPost_id($id);
    $commentController->add($newComment);
    echo "<script>window.location.href='read.php?id=$id'</script>";
}
?>
<style>
    body {
        background-image: url("https://img.freepik.com/premium-vector/hand-painted-background-violet-orange-colours_23-2148427578.jpg?w=2000");
    }
</style>
<link rel="stylesheet" href="style.css">
<br>
<div class="d-flex justify-content-center">
    <div class="col-md-4" style="width: 40rem;">
        <div class="wsk-cp-product">
            <div class="wsk-cp-img">
                <img src="<?= $post->getUrl() ?>" alt="Product" class="img-responsive">
            </div>
            <div class="wsk-cp-text">
                <div class="category">
                    <span><?= $post->getAuthor() ?></span>
                </div>
                <div class="title-product">
                    <h3><?= $post->getTitle() ?></h3>
                </div>
                <div class="description-prod">
                    <p><?= $post->getContent() ?> <br> <?= $post->getCreate_at() ?></p>

                </div>
                <div class="card-footer d-flex justify-content-center">
                    <a href="read.php?id=<?= $post->getId() ?>" class="btn btn-success" style="width: 50px"> <i class="fa-sharp fa-solid fa-book-open"></i></a>
                    <? if ($_SESSION["id"] === $post->getUser_id()) : ?>
                        <a href="deletee.php?id=<?= $post->getId() ?>" class="btn btn-danger style=width: 50px"><i class="fa-solid fa-trash"></i></a>
                        <a href="update.php?id=<?= $post->getId() ?>" class="btn btn-warning" style="width: 50px"> <i class="fa-solid fa-pen-to-square"></i></a>
                    <?php endif ?>
                    <a href="javascript:;" onclick="toggleCommentForm()" class="btn btn-primary">New Comment</a>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success" id="mask">Display / Hide comments</button>
                </div>
                <div id="comments">
                    <?php foreach ($comments as $comment) { ?>
                        <div>
                            <br>
                            <h5 class="card-title"><?= $comment->getTitle() ?></h5>
                            <p class="card-text"><?= $comment->getContent() ?></p>
                            <p><?= $comment->getCreate_at() ?></p>
                            <p><?= $comment->getAuthor() ?> </p>
                            <br>
                            <a href="javascript:;" onclick="toggleCommentForm()" class="like"></a>
                            <? if ($_SESSION["id"] === $post->getUser_id()) : ?>
                                <a href="delete.php?id=<?= $comment->getId($id) ?>" class="btn btn-danger style=width: 50px"><i class="fa-solid fa-trash"></i></a>
                                <a href="updatec.php?id=<?= $comment->getId($id) ?>" class="btn btn-warning" style="width: 50px"> <i class="fa-solid fa-pen-to-square"></i></a>
                            <?php endif ?>

                        </div>
                    <?php } ?>
                </div>

                <form method="POST" class="container" id="comment-form" style="display: none">
                    <label>Title :</label>
                    <input type="text" name="title" id="title" class="form-control">
                    <label>Content :</label>
                    <textarea type="text" name="content" id="content" class="form-control"></textarea>
                    <label>Author :</label>
                    <input type="text" name="author" id="author" class="form-control">
                    <input type="submit" value="Publish" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="./script.js"></script>
<script type="text/javascript">
    let mask = document.getElementById("mask");
    let comments = document.getElementById("comments");
    mask.addEventListener("click", () => {
        if (getComputedStyle(comments).display != "none") {
            comments.style.display = "none";
        } else {
            comments.style.display = "block";
        }
    })
</script>
</body>

</html>
<br>



<?php require "./Vues/layout/footer.php"; ?>