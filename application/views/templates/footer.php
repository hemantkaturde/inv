<footer class="main-footer" style="position: initial">
    <div class="pull-right ">
      <b>Welcome, </b><?php echo $_SESSION['username']; ?>
    </div>
    <strong><?php echo $_SESSION['company_name']; ?></strong>
  </footer>


  <script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){
      $('.alert').remove();
    }, 3000);
  })
</script>