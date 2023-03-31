        <?php
        if(isset($_SESSION['user'])) {?>
            <footer>
                <div class="footer-section">
                    <div id="google_translate_element" style=""></div>
                    <script type="text/javascript" src="js/translate.js"></script>
                    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    <div class="contact">
                        <p>Any questions ?</p>
                        <a href="#">Contact us</a>
                    </div>
                    <div class="footer-nav">
                        <ul>
                            <li><a href="">About us</a></li>
                            <li><a href="">Newsletter</a></li>
                            <li><a href="">Events</a></li>
                            <li><a href="">Certifications</a></li>
                        </ul>
                    </div>
                </div>
                <div class="credits">
                    <p>&copy; Helmo Hackaton 2023 (Trasis Project) | All Rights Reserved</p>
                </div>
            </footer>
        </div>
        <?php } ?>
    </body>
</html>