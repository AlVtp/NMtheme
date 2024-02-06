<footer class="footer">
    <?php
    wp_nav_menu(array('theme_location' => 'footerm'));
    ?>

    <?php wp_footer(); ?>

    <?php include "modale.php"; ?>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.open-modal').on('click', function(e) {
                e.preventDefault();
                $('#myModal').modal('show');
            });
        });
    </script>
</footer>
</body>

</html>
