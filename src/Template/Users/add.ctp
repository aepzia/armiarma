<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" >
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
div {
    display: block;
}
</style>
<br />
<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <legend><?= __('Izena eman') ?></legend>
      <form>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
      </div>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <br>
      <div class="input-group">
        <span class="input-group-addon">Text</span>
        <input id="msg" type="text" class="form-control" name="msg" placeholder="Additional Info">
      </div>
      <?= $this->Form->button(__('Gorde')) ?>
    </form>
    </div>
</div>
