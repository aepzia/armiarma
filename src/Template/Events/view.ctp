<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<head>
<style>
.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}
</style>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container center-block">
</br>
    <div class="row ">
                <div class="row">
                    <div class="well-sm">
                      <img src="<?=$event ->fitx ?>" class="img-rounded img-responsive" />

                        <h4><?=$event ->izenburua ?></h4>
                        <small><?=$event ->tokia?><i class="glyphicon glyphicon-map-marker">
                        </i></small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i>email@example.com
                            <br />
                            <i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p>
                    </div>
                </div>
        </div>
    </div>
</div>
