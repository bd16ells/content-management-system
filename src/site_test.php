<?
require_once('site_core.php');
echo_head('Site Test');
echo '
    <div class="container">
        <div class="alert alert-primary" role="alert">
          This is a primary alert—check it out!
        </div>

        <button type="button" class="btn btn-warning">Warning</button>
    </div>';
echo_foot();
?>