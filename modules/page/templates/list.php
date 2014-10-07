<div class="span6" style="margin-top: 20px;">
	<h1>Páginas do site</h1>
	<?php if ( count($pages) > 0) : ?>
		<table class="table table-bordered" style="margin-top: 60px;">
			<thead>
				<tr>
					<td>Título</td>
					<td>Autor</td>
					<td>Data</td>
					<td>Visível</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($pages as $page) : ?>
					<tr>
						<td><?php echo $page['page_title']; ?></td>
						<td><?php echo $page['admin_name']; ?></td>
						<td><?php echo date('d/m/Y', $page['page_register_date']); ?></td>
						<?php if ( $page['page_active'] == 1) : ?>
							<td><?php HtmlHelper::link('page', 'changeVisibility', '<i class="icon-ban-circle"></i>', null, array($page['page_id'], 0)); ?>
						<?php else : ?>
							<td><?php HtmlHelper::link('page', 'changeVisibility', '<i class="icon-ok"></i>', null, array($page['page_id'], 1)); ?></td>
						<?php endif; ?>
						<td><?php HtmlHelper::link('page', 'delete', '&times;', array('class' => 'close'), array($page['page_id'])); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p class="lead">Você não criou nenhuma página ainda. <br /> <?php HtmlHelper::link('page', 'index', 'Criar nova página'); ?></p>
	<?php endif; ?>
</div>