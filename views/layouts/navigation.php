<!-- navbar -->
<div class="row mb-4">
    <div class="col-md-12">
        <nav class="navbar navbar-dark bg-primary">
            <div class="col-md-1">
                <input hidden id="currentLang" value="<?php echo $_SESSION['lang']; ?>"/>
                <select id="lang" class="custom-select">
                    <option value="en">en</option>
                    <option value="ru">ru</option>
                </select>
            </div>
            <?php if ($_SESSION['user']): ?>
                <a class="btn btn-outline-light ml-auto" href="/user/logout" role="button">
                    <?php echo $NAVIGATION_LOGOUT; ?>
                </a>
                <a class="btn btn-outline-light ml-3" href="/user/profile" role="button">
                    <?php echo $NAVIGATION_HELLO; ?>
                    <span class="font-weight-bold"><?php echo $user['username']; ?></span>!
                </a>
            <?php else: ?>
                <a class="btn btn-outline-light ml-auto" href="/user/registerForm" role="button">
                    <?php echo $NAVIGATION_REGISTER; ?>
                </a>
                <a class="btn btn-outline-light ml-3" href="/user/loginForm" role="button">
                    <?php echo $NAVIGATION_LOGIN; ?>
                </a>
            <?php endif; ?>
        </nav>
    </div>
</div>
<!-- /navbar -->

