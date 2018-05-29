      
      <footer>
        <p>&copy; Copyright Jonas Lehmann</p>
        <?php
        if (isset($_SESSION['error'])) {
          echo "<div class='alert alert-danger'>$_SESSION[error]</div>";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "<div class='alert alert-success'>$_SESSION[success]</div>";
          unset($_SESSION['success']);
        }
        ?>
      </footer>
    </div>
    <script src="<?=$GLOBALS['appurl']?>/js/jquery.min.js"></script>
  </body>
</html>