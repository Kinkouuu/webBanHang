<div class="container-fluid ">
    <ul class="nav nav-tabs d-flex justify-content-evenly" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">
                <a href="index.php" style="text-decoration: none">Home</a>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">
                <a href="index.php?action=onGB" style="text-decoration: none">Group By</a>
            </button>
        </li>
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="color: #0d6efd;">
                Product
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <?php
                $types = $db->query("SELECT * FROM `type` WHERE `type` != '' ORDER BY `t_id` ASC");
                foreach ($types as $type) {
                    $t=$type['type'];

                ?>
                    <li>
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">
                            <a href="index.php?action=<?= $t ?>" style="text-decoration: none"><?= $t ?></a>
                        </button>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">
                <a href="index.php?action=whole" style="text-decoration: none">Start Sourcing</a>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">
                <a href="index.php?action=intro" style="text-decoration: none">About Us</a>
            </button>
        </li>
    </ul>

</div>