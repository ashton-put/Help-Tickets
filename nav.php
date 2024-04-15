<!-- this is the nav for the main folder -->
<!-- highlights the nav differently based on activePage -->
<nav>
    <section>
        <ul>
            <li><a class="<?php
                if($pathParts['filename'] == 'index') {
                    print 'activePage';
                }
                ?>" href="index.php">Home</a>
            </li>

            <li><a class="<?php
                if($pathParts['filename'] == 'form') {
                    print 'activePage';
                }
                ?>" href="form.php">Submit a Ticket</a>
            </li>

            <li class="login"><a class="<?php
                if($pathParts['filename'] == 'login') {
                    print 'activePage';
                }
                ?>" href="login.php">Mentor Login</a>
            </li>
        </ul>

    </section>

</nav>
