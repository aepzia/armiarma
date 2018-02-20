<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<html>
    <head>
      <title> Table </title>
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <h2 style="color: #448aff;text-align: center;"> Erabiltzaile lista</h2>
<hr>
  <table class="table table-striped">
    <div class="dropdown">
      <a class="btn-top" style="margin-right: 15px;" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'add')) ?>" class="btn btn-primary btn-success pull-right"> <span class="glyphicon glyphicon-plus"></span> &nbsp Erabiltzaile berria</a>
  </div>
</br>
</div>
   <thead>
        <tr class="row-name">
          <th scope="col"><?= $this->Paginator->sort('name') ?></th>
          <th scope="col"><?= $this->Paginator->sort('email') ?></th>
          <th scope="col"><?= $this->Paginator->sort('active') ?></th>
          <th scope="col"><?= $this->Paginator->sort('role') ?></th>
          <th scope="col" class="actions"><?= __('') ?></th>
        </tr>
     </thead>
     <tbody>
        <tr class="row-content">
          <?php foreach ($users as $user): ?>
          <tr>
              <td><?= h($user->name) ?></td>
              <td><?= h($user->email) ?></td>
              <td><?= h($user->active) ?></td>
              <td><?= h($user->role) ?></td>
              <td class="actions">
                  <a class="btn btn-danger edit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'delete',$user->id)) ?>" aria-label="Settings">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                  <a class="btn btn-info edit" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'edit',$user->id)) ?>" aria-label="Settings">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tr>
     </tbody>
  </table>
    </body>
</html>
