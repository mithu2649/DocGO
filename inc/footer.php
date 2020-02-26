    </div>
    <script src="app.js"></script>
    <?php if($currentPage == 'index'){
        echo '<script src="resources/js/upload.js"></script>';
    }?>
    <?php if($currentPage != 'login' && $currentPage != 'register'){
        echo '<script src="resources/js/search.js"></script>';
    }?>
</body>
</html>