<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="col-md-12">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3 text-left">
                <div class="card-outline mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4 p-3">
                            <?php if ($user['avatar'] !== null): ?>
                                <img src="../public/images/user_images/<?php echo $user['avatar'] ?>"
                                     class="card-img" alt="">
                            <?php else: ?>
                                <img src="../public/images/user_images/default.png"
                                     class="card-img" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $user['username'] ?></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?php echo $user['email'] ?></li>
                                <li class="list-group-item"><?php echo $user['first_name'] ?></li>
                                <li class="list-group-item"><?php echo $user['last_name'] ?></li>
                                <?php if (!empty($user['gender'])): ?>
                                    <li class="list-group-item"><?php echo $user['gender'] ?></li>
                                <?php endif; ?>
                            </ul>
                            <div class="card-body">
                                <a class="btn btn-danger" href="#"
                                   role="button"><?php echo $PROFILE_DELETE_BUTTON; ?></a>
                                <a class="btn btn-success" href="#"
                                   role="button"><?php echo $PROFILE_EDIT_BUTTON; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

