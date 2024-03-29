<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel log viewer</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet"
        href="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    body {
      padding: 25px;
    }

    h1 {
      font-size: 1.5em;
      margin-top: 0;
    }

    .stack {
      font-size: 0.85em;
    }

    .date {
      min-width: 75px;
    }

    .text {
      word-break: break-all;
    }

    a.llv-active {
      z-index: 2;
      background-color: #f5f5f5;
      border-color: #777;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <h1><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Laravel Log Viewer</h1>
      <p class="text-muted"><i>by Rap2h</i></p>
      <div class="list-group">
        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="?l=<?php echo e(base64_encode($file)); ?>"
             class="list-group-item <?php if($current_file == $file): ?> llv-active <?php endif; ?>">
            <?php echo e($file); ?>

          </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <div class="col-sm-9 col-md-10 table-container">
      <?php if($logs === null): ?>
        <div>
          Log file >50M, please download it.
        </div>
      <?php else: ?>
        <table id="table-log" class="table table-striped">
          <thead>
          <tr>
            <th>Level</th>
            <th>Context</th>
            <th>Date</th>
            <th>Content</th>
          </tr>
          </thead>
          <tbody>

          <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr data-display="stack<?php echo e($key); ?>">
              <td class="text-<?php echo e($log['level_class']); ?>"><span class="glyphicon glyphicon-<?php echo e($log['level_img']); ?>-sign"
                                                               aria-hidden="true"></span> &nbsp;<?php echo e($log['level']); ?></td>
              <td class="text"><?php echo e($log['context']); ?></td>
              <td class="date"><?php echo e($log['date']); ?></td>
              <td class="text">
                <?php if($log['stack']): ?> <a class="pull-right expand btn btn-default btn-xs"
                                       data-display="stack<?php echo e($key); ?>"><span
                      class="glyphicon glyphicon-search"></span></a><?php endif; ?>
                <?php echo e($log['text']); ?>

                <?php if(isset($log['in_file'])): ?> <br/><?php echo e($log['in_file']); ?><?php endif; ?>
                <?php if($log['stack']): ?>
                  <div class="stack" id="stack<?php echo e($key); ?>"
                       style="display: none; white-space: pre-wrap;"><?php echo e(trim($log['stack'])); ?>

                  </div><?php endif; ?>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </tbody>
        </table>
      <?php endif; ?>
      <div>
        <?php if($current_file): ?>
          <a href="?dl=<?php echo e(base64_encode($current_file)); ?>"><span class="glyphicon glyphicon-download-alt"></span>
            Download file</a>
          -
          <a id="delete-log" href="?del=<?php echo e(base64_encode($current_file)); ?>"><span
                class="glyphicon glyphicon-trash"></span> Delete file</a>
          <?php if(count($files) > 1): ?>
            -
            <a id="delete-all-log" href="?delall=true"><span class="glyphicon glyphicon-trash"></span> Delete all files</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script>
  $(document).ready(function () {
    $('.table-container tr').on('click', function () {
      $('#' + $(this).data('display')).toggle();
    });
    $('#table-log').DataTable({
      "order": [1, 'desc'],
      "stateSave": true,
      "stateSaveCallback": function (settings, data) {
        window.localStorage.setItem("datatable", JSON.stringify(data));
      },
      "stateLoadCallback": function (settings) {
        var data = JSON.parse(window.localStorage.getItem("datatable"));
        if (data) data.start = 0;
        return data;
      }
    });
    $('#delete-log, #delete-all-log').click(function () {
      return confirm('Are you sure?');
    });
  });
</script>
</body>
</html>
