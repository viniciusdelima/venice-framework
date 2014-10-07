<div class="span9">
	<h1>Perguntas Frequentes</h1>
	
	<div class="span6">
		<?php $this->getMessage(); ?>
		
		<form action="<?php echo HtmlHelper::createsValidURL('page', 'addFAQ'); ?>" method="post" class="form-horizontal">
			<fieldset style="margin-top: 40px;">
				<div class="control-group">
					<label class="control-label" style="margin-left: 0px; text-align: left;">Página:</label>
					<div class="controls" style="margin-left: 0px;">
						<select name="page">
							<option value="1">Página 1</option>
							<option value="2">Página 2</option>
						</select>
					</div>
				</div>
				<div class="controls" style="margin-left: 0px; margin-bottom: 20px;">
					<input type="text" name="question" placeholder="Digite uma pergunta" class="span12" required>
				</div>
				<div class="controls" style="margin-left: 0px; margin-bottom: 20px;">
					<textarea name="response" rows="3" placeholder="Resposta" class="span12" required></textarea>
				</div>
				<p><input type="submit" value="Add Pergunta" class="btn btn-medium"></p>
			</fieldset>
		</form>		
	</div>
	<div class="span5">
		<h2>Perguntas cadastradas</h2>
		<?php if ( count($faq) <= 0) : ?>
			Você não configurou nenhuma pergunta.
		<?php else : ?>
				<table class="table table-bordered">
					<tbody>
						<?php foreach ($faq as $entrie) : ?>
							<?php foreach ($entrie as $faqElement) : ?>
								<tr>
									<td><?php HtmlHelper::link('page', 'removeFAQ', '<i class="icon-remove"></i>', array('class' => 'btn'), array($faqElement['id'], $faqElement['page'])); ?> <?php echo $faqElement['question']; ?></td>
								</tr>
							<?php endforeach; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php HtmlHelper::link('page', 'listfaq', 'Ver todas', array('class' => 'pull-right')); ?>
		<?php endif; ?>
		<br />
	</div>
</div>
