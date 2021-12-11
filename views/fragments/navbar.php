<script defer src="../public/js/navbar.js"></script>

<div class="navbar-container">
    <nav id="navbar">
        <ul>
            <li><a class="active" href="home.php"><i class="fas fa-home"></i>&nbsp; MusicStore</a></li>
            <li><a href="tracks.php"><i class="fas fa-music"></i>&nbsp; Tracks</a></li>
    
            <!-- If user is logged in -->
            <?php if (isset($_SESSION["email"])) : ?> 
                <section class="float-right">
                    <li class="right">
                        <a href="" onclick="logout()"><i class="fas fa-sign-out-alt"></i>&nbsp; 
                            <span class="minimizable-text">Logout</span>
                        </a>
                    </li>
                    <li class="right">
                        <a href="profile.php"><i class="fas fa-user-circle"></i>&nbsp; 
                            <span class="minimizable-text">Profile</span>
                        </a>
                    </li>
                </section>
            <?php endif; ?>
        </ul>
    </nav>
</div>