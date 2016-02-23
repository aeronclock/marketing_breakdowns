<?php 

use yii\helpers\Html;

?>
<div class="row">
  <div class="col-md-12">
    <h4>Breakdown - Color Details</h4>
  </div>
</div>

<p>
  <?= Html::a('Create Color', ['create-color', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
</p>

<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered">
      <thead>
        <th>No</th>
        <th>Color Name</th>
        <th>Action</th>
      </thead>
      <tbody>
        <?php foreach ($model->colors as $idx => $color) : ?>
          <tr>
            <td><?= $idx+1; ?></td>
            <td><?= $color->color_name; ?></td>
            <td>
              <!-- <?= Html::a('Show Detail', '#', ['class' => 'btn btn-default btn-xs']) ?>
              <?= Html::a('Import Detail', ['import-detail', 'id' => $color->id], ['class' => 'btn btn-primary btn-xs']) ?> -->
              <?= Html::a('Delete', ['delete-color', 'id' => $color->id], [
                  'class' => 'btn btn-danger btn-xs',
                  'data' => [
                      'confirm' => 'Are you sure you want to delete this color?',
                      'method' => 'post',
                  ],
              ]) ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>