<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<html>
    <head>
      <title> Table </title>
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <h2 style="color: #448aff;text-align: center;"> Erakunde lista</h2>
<hr>
  <table class="table table-striped">
    <div class="dropdown">
      <a class="btn-top" style="margin-right: 15px;" href="<?php echo $this->Url->build(array('controller'=>'Users','action'=>'add')) ?>" class="btn btn-primary btn-success pull-right"> <span class="glyphicon glyphicon-plus"></span> &nbsp Erakunde berria</a>
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
                    <?= $this->Form->postLink('',
                      ['action' => 'delete', $user->id],
                      ['scape' => false, 'class' => 'btn btn-danger edit fa fa-trash','confirm' => __('Ziur zaude # {0} erabiltzailea ezabatu nahi duzula?', $user->name)]
                      ) ?>
                    <?= $this->Html->link('',
                      ['action' => 'edit', $user->id],
                      ['scape' => false, 'class' => 'btn btn-info edit fa fa-pencil-square-o']
                      ) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tr>
     </tbody>
  </table>
    </body>
</html>
