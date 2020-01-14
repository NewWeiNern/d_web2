<div class="nav-cover">
    <nav>
        <h1 class="unique"><a href=""><span class="title">Teacher Review</span></a><span class="hamburger-menu close">☰</span></h1>
        <ul class="main-nav close">
        <li><a href="about">About</a></li>
        <li><a href="reviews">Reviews</a></li>
        <li><a href="teachers">Teachers</a></li>
        <?php if(!isset($_SESSION["name"])): ?>
        <li>
            <ul class="sec-nav">
            <li><a href="javascript:void(0)" data-type="login">Login</a></li>
            <li><a href="javascript:void(0)" data-type="signup">Sign Up</a></li>
            </ul> 
        </li>
        <?php else: ?>
        <li><a href="javascript:void(0)" onclick="$([this, this.nextElementSibling]).toggleClass('close')"><?= $_SESSION["name"]; ?></a>
            <ul class="sec-nav cli close">
            <li><a href="setting">Setting</a></li>
            <li><a href="logout">Logout</a></li>
            </ul>
        </li>
        <?php endif; ?>
        </ul> 
    </nav>
</div>