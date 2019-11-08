<button onclick="topFunction()" id="myBtn"><i class="fas fa-angle-up fa-lg"></i></button>
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
                <a href="login.php" class="btn btn-dark mr-3 shadow-none btn-logreg">
                    Login <i class="fa fa-sign-in" aria-hidden="true"></i>
                </a>
                <a href="register.php" class="btn btn-dark shadow-none btn-logreg">
                    Register <i class="fa fa-registered" aria-hidden="true"></i>
                </a>
            </div>
            <nav class="navbar navbar-expand-sm">
                <ul class="navbar-nav">
                    <li class="nav-item active"><a class="nav-link text-white" href="home.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="general.php?type=Latest&category=All&status=All">LATEST MANGA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="general.php?type=Hot%20Manga&category=All&status=All">HOT MANGA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="general.php?type=Newest&category=All&status=All">NEW MANGA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="general.php?type=Latest&category=All&status=Completed">COMPLETED MANGA</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="home.php">MANGAKAKALOT</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>