<?php
$title = "Trasis - trainings";
include '../inc/header.inc.php'
?>

<body>

<h1 class ="centered_titles push_top">My Trainings</h1>
<div class = "trainings_form">
            <section>
                <?php
                //TODO: get all my trainings
                $length = 5;//to change to amount of trainings i have
                for($i = 0;$i<$length;$i++){
                    $title = "to change";
                    $description = "to change but longer";
                    echo
                    '<article>
                    <img src="../pics/1+1=3.jpeg" alt="1+1=3">
                    <h3>Quantum Physics</h3>
                    <p>so easy to learn quantum Physics</p>
                    </article>';
                }
                ?>
            </section>
</div>
<h1 class ="centered_titles push_top">available trainings</h1>
<div class = "trainings_form">
    <section>
        <?php
        //TODO: get all available trainings

        $length = 5;//to change to amount of trainings i have
        for($i = 0;$i<$length;$i++){
            $title = "to change";
            $description = "to change but longer";
            echo
            '<article>
                    <img src="../pics/1+1=3.jpeg" alt="1+1=3">
                    <h3>Quantum Physics</h3>
                    <p>so easy to learn quantum Physics</p>
                    </article>';
        }
        ?>

    </section>
</div>
</body>
</html>