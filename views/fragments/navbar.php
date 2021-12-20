<script defer src="/webexam/public/js/navbar.js"></script>

<div class="navbar-container">
    <nav id="navbar">
        <ul>
            <li><a class="active" href="/webexam/views/home.php"><i class="fas fa-home"></i>&nbsp; TuneStore</a></li>

            <?php if (!isset($_SESSION["role"]) || $_SESSION["role"] == "CUSTOMER") : ?> 
                <li><a href="/webexam/views/tracks.php"><i class="fas fa-music"></i>&nbsp; Tracks</a></li>
            <?php endif; ?>
            
            <!-- If logged in as admin show admin dashboard -->
            <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "ADMIN") : ?> 
                <li><a href="/webexam/views/admin/dashboard.php"><i class="fas fa-user-cog"></i>&nbsp; Dashboard</a></li>
            <?php endif; ?>
    
            <!-- If user is logged in -->
            <?php if (isset($_SESSION["role"])) : ?> 

                <section class="float-right">

                    <li class="right">
                        <a href="" onclick="logout()"><i class="fas fa-sign-out-alt"></i>&nbsp; 
                            <span class="minimizable-text">Logout</span>
                        </a>
                    </li>

                    <!-- only render profile button if user is customer -->
                    <?php if ($_SESSION["role"] == "CUSTOMER") : ?>

                        <li class="right">
                            <a href="/webexam/views/profile.php"><i class="fas fa-user-circle"></i>&nbsp; 
                                <span class="minimizable-text">Profile</span>
                            </a>
                        </li>

                    <?php endif; ?>

                    <!-- If cart has been set -->
                    <li <?php if(!isset($_SESSION["cart"])) : ?> hidden <?php endif; ?> id="cartNavLink" class="right">
                        <a href="/webexam/views/cart.php"><i class="fas fa-shopping-cart"></i>&nbsp; 
                            <span class="minimizable-text">Cart</span>
                            
                                <!-- I know i know, but i wanted to do this with php conditionals -->
                                <span 
                                <?php if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) == 0) : ?> 
                                    hidden 
                                <?php endif; ?> 
                                    id="cartPill" class="pill pill-danger pill-top">
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