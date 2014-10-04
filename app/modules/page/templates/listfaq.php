<div class="span6" style="margin-top: 20px;">
	<h2>Perguntas cadastradas</h2>
	<?php if ( count($pages) > 0) : ?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<td>Pergunta</td>
						<td>Resposta</td>
						<td>Excluir</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($pages as $page) : ?>
						<tr>
							<td><?php echo $page['question']; ?></td>
							<td><?php echo $page['response']; ?></td>
							<td><?php HtmlHelper::link('page', 'removeFAQ', '<i class="icon-remove"></i>', array('class' => 'btn'), array($page['id'], $page['page'])); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
	<?php else : ?>
		<p class="lead">
			Não há perguntas criadas no momento. <br/>
			<?php HtmlHelper::link('page', 'addFAQ', 'Adicionar nova pergunta.'); ?>
		</p>
	<?php endif; ?>
</div>