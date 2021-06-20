<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Новости</h2>

                    <?php foreach ($newsList as $news): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <p>
                                            <a href="/news/<?php echo $news['id']; ?>">
                                                <?php echo $news['title']; ?>
                                            </a>
                                        </p>
                                        <p> 
                                            <?php echo $news['subject']; ?>
                                        </p>
                                        <p> 
                                            <?php echo $news['pub_date']; ?>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>                              
                </div><!--features_items-->

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>