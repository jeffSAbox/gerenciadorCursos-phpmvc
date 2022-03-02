<?php include __DIR__."/../inicio-html.php"; ?>

  <a href="novo-curso" class="btn btn-primary mb-2">
      Novo Curso
  </a>
  <ul class="list-group">
      <?php foreach ($cursos as $curso): ?>
          <li class="list-group-item d-flex justify-content-between">
              
            <span>
                <?= $curso->getDescricao(); ?>
                <i><small style="color:gray">Nota: <?= $curso->getNota(); ?></small></i>
            </span>

            <span>
            <a href="/alterar-curso?id=<?=$curso->getId()?>" class="btn btn-info">
                Alterar
            </a>
            <a href="/exclusao?id=<?=$curso->getId()?>" class="btn btn-danger">
                Excluir
            </a>
            </span>
          </li>
      <?php endforeach; ?>
  </ul>

<?php include __DIR__."/../fim-html.php"; ?>
