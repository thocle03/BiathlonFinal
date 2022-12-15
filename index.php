<?php
require "./Vues/layout/header.php";

$posts = $postController->readAll();
//var_dump($_SESSION["username"]);
?>

<style>
    body {
        background-color: #87CEEB;
    }
</style>

<br>
<div class="d-flex flex-wrap justify-content-around">
    <? $userController = new UserController();
    $users = $userController->getAll();

    $manager = new PostController();
    $posts = $manager->readAll();
    //var_dump($post);


    if ($_POST) {
        //var_dump($_POST);
        $newComment = new Comment($_POST);
        $newComment->setPost_id($_GET["id"]);
        $commentController->add($newComment);
        //echo "<script>window.location.href='read.php?id=$id'</script>";
    }


    ?>


    <?php foreach ($posts as $post) {
        $comments = $commentController->getAllByPostId($post->getId());
    ?>

        <div class="col-m-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?= $post->getTitle() ?></h3>
                </div>
                <div class="card-text" style="text-align: center;">
                    <p><?= $post->getContent() ?></p>
                    <div id="comments">
                        <?php foreach ($comments as $comment) { ?>
                            <div>
                                <p><?= $comment->getTitle() ?>&emsp;<?= $comment->getContent() ?></p>
                                <a href="javascript:;" onclick="toggleCommentForm()" class="like"></a>
                            </div>
                        <?php } ?>
                    </div>
                    <? if ($_SESSION["username"] === "thomas") : ?>
                        <a href="javascript:;" onclick="toggleCommentForm()" class="btn btn-primary">Nouvelle ligne</a>
                    <?php endif ?>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <? if ($_SESSION["id"] === $post->getUser_id()) : ?>
                        <a href="read.php?id=<?= $post->getId() ?>" class="btn btn-success" style="width: 50px"> <i class="fa-sharp fa-solid fa-book-open"></i></a>
                        <a href="deletee.php?id=<?= $post->getId() ?>" class="btn btn-danger" style="width: 50px"><i class="fa-solid fa-trash"></i></a>
                        <a href="update.php?id=<?= $post->getId() ?>" class="btn btn-warning" style="width: 50px"> <i class="fa-solid fa-pen-to-square"></i></a>
                    <?php endif ?>
                    <i class="fa-solid fa-ranking-star"></i>

                    <form method="POST" action="index.php?id=<?= $post->getId() ?>" class="container" id="comment-form" style="display: none">
                        <label>Position :</label>
                        <input type="text" name="title" id="title" class="form-control">
                        <label>Nom :</label>
                        <textarea type="text" name="content" id="content" class="form-control"></textarea>
                        <input type="submit" value="Publish" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div id="commentaire-<?= $post->getId() ?>" style="display: none;">
                <br>
                <textarea></textarea>
            </div>
            <script src="script.js"></script>
            <br>
        </div>
    <?php } ?>
</div>
<script>
    function deleteArticle(id) {
        if (confirm("confirmer la suppression")) {
            window.location.href = "./delete.php?id=" + id
        }
    }
</script>

<script src="./javascript/acceuil.js"></script>


<?php require "./Vues/layout/footer.php"; ?>