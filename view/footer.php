      <hr>
      <?php
        if (isset($_SESSION['error'])) {
          echo "<div class='alert alert-danger'>$_SESSION[error]</div>";
        }
      ?>
      <footer>
        <p>&copy; Copyright Jonas Lehmann</p>
      </footer>
    </div>
    <script src="<?=$GLOBALS['appurl']?>/js/jquery.min.js"></script>
  </body>
</html>
