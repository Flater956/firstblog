<header class="masthead" style="background-image: url('/public/materials/<?php if (file_exists('public/materials/'.$list['id'].'.jpg')) {echo $list['id'];} else{echo 'def';} ?>.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">

                    <h1><?php echo htmlspecialchars($list['name'], ENT_QUOTES); ?></h1>
                    <span class="subheading"><?php echo htmlspecialchars($list['description'], ENT_QUOTES); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p><?php echo htmlspecialchars($list['text'], ENT_QUOTES); ?></p>
        </div>
        <div class="col-lg-8 col-md-10 mx-auto">
            <p> Дата добавления <?php echo htmlspecialchars($list['date'], ENT_QUOTES); ?></p>
        </div>
    </div>
</div>