<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-up fa-lg"></i></button>
<header>
    <div class="container-fluid row p-5">
        <div class="mr-3">
            <a href="home.php" title="Manga Online">
                <img src="images/logo.png" alt="Manga Online" title="Manga Online">
            </a>
        </div>
        <div class="nb">
            <div class="row mb-1">
                <form class="form-inline">
                    <button class="btn btn-info btn-md my-2 my-sm-0 ml-3 btn-find">
                        <i class="fa fa-search"></i>
                    </button>
                    <div class="md-form my-0">
                        <input class="form-control mr-sm-2 shadow-none search" type="text" required placeholder="Search Manga..." aria-label="Search">
                    </div>
                </form>
                <a href="user.php">
                    <div class="bg-light text-center p-2">
                        <i class="fas fa-user text-dark"></i> 
                    </div>
                </a>
                <div class="bg-info p-2"><a class="text-white text-decoration-none" href="user.php"><?php echo $_SESSION["username"] ?></a></div>
                <a class="bg-info p-2 ml-2 text-white rounded-circle icon" href="bookmark.php" title="Bookmark"><i class="fas fa-bell fa-lg"></i></a>
                <a class="bg-info p-2 ml-2 text-white rounded-circle icon" href="history.php" title="History"><i class="fa fa-history fa-lg" aria-hidden="true"></i></a>
                <a name="logout" class="bg-light p-2 ml-2 text-danger rounded-circle icon" href="component/logout.php" title="Log out"><i class="fas fa-power-off fa-lg"></i></a>
            </div>
            <nav class="navbar navbar-expand-sm">
                <ul class="navbar-nav">
                    <li class="nav-item active"><a class="nav-link text-white" href="home.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="general.php?type=Latest&category=All&status=All">LATEST MANGA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="general.php?type=Top%20View&category=All&status=All">HOT MANGA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="general.php?type=Newest&category=All&status=All">NEW MANGA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="general.php?type=Latest&category=All&status=Completed">COMPLETED MANGA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="home.php">MANGAKAKALOT</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>