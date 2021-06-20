<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-lg-6">
                <h4><?php echo $news['title'] ?></h4>
                <p><?php echo $news['subject'] ?></p>
                <p><?php echo $news['pub_date'] ?></p>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>