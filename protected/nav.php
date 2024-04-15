<!-- this is the nav for the protected folder, displays pages for users to access -->
<!-- highlights the nav differently based on activePage -->

<nav>
    <section>
        <ul>
            <li><a  class="<?php
                if($pathParts['filename'] == 'index') {
                    print 'activePage';
                }
                ?>" href="index.php">Home</a>
            </li>

            <li><a  class="<?php
                if($pathParts['filename'] == 'helpTickets') {
                    print 'activePage';
                }
                ?>" href="helpTickets.php">Help Tickets</a>
            </li>

            <li><a  class="<?php
                if($pathParts['filename'] == 'complete') {
                    print 'activePage';
                }
                ?>" href="complete.php">Mark Complete</a>
            </li>

            <li class="logout"><a  class="<?php
                if($pathParts['filename'] == '../index') {
                    print 'activePage';
                }
                ?>" href="../index.php">Log Out</a>
            </li>

            </li>
        </ul>

    </section>

</nav>
