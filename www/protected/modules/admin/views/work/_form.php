<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'work-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="help-block">Поля обязательные для заполнения <span class="required">*</span></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>128)); ?>
    
    <?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>128)); ?>
	
	<br>
	<?php echo $form->fileFieldRow($model, 'icon'); ?>
	<br><br>
	
	<br><br>
	<?php //Если картинка для данного товара загружена, предложить её удалить, отметив чекбокс 
		if(isset($model->img) and $model->img != '' and file_exists($_SERVER['DOCUMENT_ROOT'].Yii::app()->getBaseUrl().'/Image/Work/'.$model->img)){
				echo CHtml::image(Yii::app()->getBaseUrl(true).'/Image/Work/'.$model->img, $model->title,
					array(
						'width'=>360,
						'class'=>225,
						'id' => 'preview'
						)
					);
			} 
			else
			{
				echo CHtml::image(Yii::app()->getBaseUrl(true).'/Image/No_work.jpg','Нет картинки',
				array(
					'width'=>302,
					'class'=>200
					)
				);
			}
			
	?>
    
    <br><br>
	<input name="AttachmentWork[attachment][]" type="file"/>
    <br>
    <input name="AttachmentWork[attachment][]" type="file"/>
    <br>
    <input name="AttachmentWork[attachment][]" type="file"/>
	<br><br>
    
    <?php //Если картинка для данного товара загружена, предложить её удалить, отметив чекбокс 
		if(isset($model->attachment)){
            foreach ($model->attachment as $key => $value) {
                if (file_exists($_SERVER['DOCUMENT_ROOT'].Yii::app()->getBaseUrl().'/Image/AttachmentWork/'.$value->img)) {
                    echo '<div style="width: 400px;margin-bottom:10px;">'.CHtml::image(Yii::app()->getBaseUrl(true).'/Image/AttachmentWork/mini-'.$value->img, $value->id,
					array(
						'class' => 'f_left'
						)
					).'<a onclick="deleteAttach($(this),'.$value->id.');" style="float:right;cursor:pointer"><img src="/Image/delete_16x16.gif"/></a></div>';
                }
            }
        }
			
	?>
    
    <script>
        function deleteAttach(elem, id) {
            $.post(
            '/ajax2/deleteAttachWork',
            {
                id: id
            },
            function(data) {
                var response = jQuery.parseJSON(data);

                if (response.result == "success") {
                    elem.parent().remove();
                } else {
                    alert(response.error);
                }
            });
        }
    </script>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
