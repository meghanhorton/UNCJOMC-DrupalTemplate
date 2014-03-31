<form id="login" class="form-horizontal" accept-charset="UTF-8" method="post" action="/node?destination=node">
  <div class="form-group">
    <label class="sr-only" for="name">Username</label>
    <input type="text" class="form-control" maxlength="60" size="15" value="" name="name" id="edit-name" placeholder="username">

    <label class="sr-only" for="pass">Password</label>
    <input type="password" class="form-control" maxlength="60" size="15" name="pass" id="edit-pass" placeholder="password">

    <label class="sr-only" for="op">Submit</label>
    <button type="submit" class="form-control btn" name="op" id="edit-submit"><i class="glyphicon glyphicon-chevron-right"></i></button>
  </div>
  <input type="hidden" value="<?php print $elements['form_build_id']['#value']; ?> " name="form_build_id">
  <input type="hidden" value="user_login_block" name="form_id">
</form>