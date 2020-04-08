            </div>
            <script src="resources/js/search.js"></script>
            <?php if ($currentPage == 'index' || $currentPage == 'download_page') {
                echo '<script src="resources/js/upload.js"></script>';
            } ?>
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

            <div id="footer">
                <div id="c-notice"><p>&copy; Copyright <?php echo date("Y"); ?> by Shree Ramkrishna Institute of Science and Technology.</br>All Rights Reserved.</p></div>
                <div id="social">
                    <span class="social-icon icon-facebook">
                        <a href="#">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                    </span>
                    <span class="social-icon icon-google">
                        <a href="#">
                            <i class="fa fa-google" aria-hidden="true"></i>
                        </a>
                    </span>
                    <span class="social-icon icon-twitter">
                        <a href="#">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                    </span>
                </div>
            </div>
        </body>
    </html>