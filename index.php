<?php
session_start();

include("db_con.php");
include("data/recieve.php");

$projects = recieveAllProjects($conn);
$services = recieveAllServices($conn);
$aboutData = recieveAboutData($conn);
$welcomeData = recieveWelcomeData($conn);
$comments = recieveComments($conn);

$user = recieveProfile($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shaka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="assets/js/swal.js"></script>
</head>

<body>
    <!-- ------------------------------------nav starts---------------------- -->
    <nav class="navbar navbar-expand-lg navbar-light p-3 bg_white fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text_blue" href="#">Shaka.com</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if (isset($_GET['success'])) { ?>

                <script>
                    setTimeout(function () {
                        swal("Success", "<?= $_GET['success'] ?>", "success");
                    },
                        100);
                </script>

            <?php } ?>

            <?php if (isset($_GET['error'])) { ?>

                <script>
                    setTimeout(function () {
                        swal("Failed", "<?= $_GET['error'] ?>", "error");
                    },
                        100);
                </script>

            <?php } ?>


            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-link" href="#projects">Projects</a>

                    <a class="nav-link" href="#about" tabindex="-1" aria-disabled="true">About Freelancer</a>
                </div>
            </div>

            <div class="float-end">
                <input class="form-control mt-2" type="search" placeholder="Search" aria-label="Search">
            </div>
        </div>
    </nav>
    <!------------------------------ end nav----------------------------------- -->

    <!-- -----------------------------main body--------------------------- -->
    <div class="container-fluid">
        <div class="bg_white">
            <div class="container main_body">
                <div class="row pt-5 pb-5">
                    <div class="col-md-6">
                        <h2 class="wlcm">
                            <?= $welcomeData['welcome_message'] ?>
                        </h2>
                        <p class="mt-5">
                            <?= $welcomeData['slug'] ?>
                        </p>

                        <input type="search" class="form-control p-3" name="searchKeyword" id="searchInput"
                            onkeyup="searchTable()" placeholder="search for projects,Topics &ideas">
                    </div>
                    <div class="col-md-6 image_space">
                        <img src="assets/images/<?= $user['profile'] ?>" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-light">
            <div class="container p-3">
                <h6 class="text-center text-secondary">SERVICES WHICH I PROVIDE</h6>
                <h3 class="text-center mb-5">Sercices</h3>
                <?php
                foreach ($services as $service) {
                    ?>
                    <P><strong>
                            <?= $service['service_title'] ?>:
                        </strong>
                        <?= $service['service_description'] ?>
                    </p>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="bg-white mb-5" id="projects">
            <div class="container p-3">
                <h3 class="text-center mb-5">Projects</h3>
                <p class="text-center">These free php projects are academic projects for final year computer science
                    students. Various academic php projects are free for download, including the source code. It is too
                    convenient for students to use php projects with free source code. As it comes with database and
                    project
                    reports. This simple process saves time and is easy to execute. These free PHP projects can be used
                    by
                    students for learning purposes. For beginners and developers alike, you can find several free PHP
                    project ideas.</p>


                <div class="row my-5">
                    <div class="col-md-6">
                        <h4>Free php programming projects with source code</h4>
                        <table class="table table-striped bg_white">
                            <thead>
                                <th>
                                    <h6 class="bg_blue p-3 text-white">Name of Project</h6>
                                </th>
                            </thead>
                            <tbody>
                                <?php
                                if ($projects) {
                                    foreach ($projects as $project) {
                                        if ($project['status'] == "Free") {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php printf("<a href='project.php?id=%s' class='nav-link'>$project[1]</a>", $project['id']) ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                } else {
                                    echo "<tr>No free Project Yet</td>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h4>Paid latest php live project download Source Code and Database</h4>
                        <table class="table table-striped bg_white">
                            <thead>

                                <th>
                                    <h6 class="bg_blue p-3 text-white">Name of Project</h6>
                                </th>
                                <th>
                                    <h6 class="bg_blue p-3 text-white">price</h6>
                                </th>

                            </thead>
                            <tbody>

                                <?php
                                if ($projects) {
                                    foreach ($projects as $project) {
                                        if ($project['status'] == "Paid") {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php printf("<a href='project.php?id=%s' class='nav-link'>$project[1]</a>", $project['id']) ?>
                                                </td>
                                                <td>$
                                                    <?= $project['project_price'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                } else {
                                    echo "<tr>No free Project Yet</td>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-light" id="about">
            <div class="container p-3">
                <h4 class="text-secondary">ABOUT ME</h4>

                <div class="row">
                    <div class="col-md-8">
                        <p>
                            <?php echo $aboutData['about_text']; ?>
                        </p>
                    </div>

                    <div class="col-md-4">
                        <h6 class="text-center">Contact</h6>
                        <div class="bg_white mx-5 p-3">
                            <a href="#" class="nav-link text_blue">
                                <p><i class="fa fa-phone"></i>
                                    <?php echo $aboutData['phone'] ?>
                                </p>
                            </a>
                            <a href="#" class="nav-link text_blue">
                                <p><i class="fa fa-twitter"></i>Twitter</p>
                            </a>
                            <a href="#" class="nav-link text_blue">
                                <p><i class="fa fa-linkedin"></i>LinkedIn</p>
                            </a>
                            <a href="" class="nav-link text_blue">
                                <p><i class="fa fa-facebook"></i>Facebook</p>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mb-3 p-5 about_banner bg-light">

                <div class="col-md-4 p-4">
                    <div class="d-flex">
                        <h2>60+</h2>
                        <p>Projects,Source codes & much more available on our platform</p>
                    </div>
                </div>

                <div class="col-md-4 p-4">
                    <div class="d-flex">
                        <h2>100+</h2>
                        <p>Projects Delivered till Date</p>
                    </div>
                </div>

                <div class="col-md-4 p-4">
                    <div class="d-flex">
                        <h2>98%</h2>
                        <p>Customers are happy with my service</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-white pb-5">
            <div class="container">
                <h3 class="text-center ">What My Clients Say</h3>
                <div class="row p-5">
                    <?php
                    if ($comments) {
                        $counter = 0;
                        foreach ($comments as $comment) {
                            if ($counter < 3) {
                                ?>
                                <div class="col-md-3  m-3 p-3 bg_white" style="height: 20rem;">
                                    <h5 class="text-center text_blue">
                                        <?= $comment['client_name'] ?>
                                    </h5>
                                    <p class="p-2">
                                        <?= $comment['message'] ?>
                                    </p>
                                </div>
                                <?php
                                $counter++;
                            } else {
                                break;
                            }
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <!-- ------------main body end ---------------------- -->

    <!------------------------------- footer starts ------------------------ -->
    <footer class="text-center pt-3 bg_blue">

        <div class="container p-4 pb-0">
            <section class="">
                <form action="data/send.php" method="POST">
                    <div class="row d-flex justify-content-center">
                        <div class="col-auto">
                            <p class="pt-2 text-white">
                                <strong>Sign up for our newsletter</strong>
                            </p>
                        </div>

                        <div class="col-md-5 col-12">
                            <div class="form-outline mb-4">
                                <input type="email" name="email" placeholder="eg.shaka@gmail.com"
                                    class="form-control" />

                            </div>
                        </div>
                        <div class="col-auto">
                            <button name="subscribe" type="submit" class="btn bg_white mb-4 text_blue">
                                Subscribe
                            </button>
                        </div>

                    </div>
                </form>
            </section>
        </div>
        <div class=" p-3 text-white">
            <p class="text-center">&copy;2023 Copyright: <a class="text-white"
                    href="https://shaka.hakateq.com/">shaka.com</a>
            </p>

        </div>
    </footer>

    <!-- ----------------------------footer ends ------------------------------------ -->


    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("projects");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    var cell = td[j];
                    if (cell) {
                        txtValue = cell.textContent || cell.innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";

                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
</body>

</html>