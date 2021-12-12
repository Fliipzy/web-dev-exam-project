<script defer src="../public/js/navbar.js"></script>

<div class="navbar-container">
    <nav id="navbar">
        <ul>
            <li><a class="active" href="home.php"><i class="fas fa-home"></i>&nbsp; TuneStore</a></li>
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

                    <!-- If cart has been set -->
                    
                        <li <?php if(!isset($_SESSION["cart"])) : ?> hidden <?php endif; ?> id="cartNavLink" class="right">
                            <a href="cart.php"><i class="fas fa-shopping-cart"></i>&nbsp; 
                                <span class="minimizable-text">Cart</span>
                                <span id="cartPill" class="pill pill-danger pill-top">
                                    <?php
                                        if (isset($_SESSION["cart"])) {
                                            echo count($_SESSION["cart"]); 
                                        }
                                    ?>
                                </span>
                            </a>
                        </li>
                    

                </section>
            <?php endif; ?>
        </ul>
    </nav>
</div>