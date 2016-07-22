<?php 
	return[
		'button' => '<button class="btn btn-primary" {{attrs}}>{{text}}</button>',
		'inputContainer' => '<div class="form-group" {{type}}{{required}}>{{content}}</div>',
		'formStart' => '<form role="form"{{attrs}}>',
		'input' => '<input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/>',
		'select' => '<select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select>',
		'textarea' => '<textarea class="form-control" name="{{name}}"{{attrs}}>{{value}}</textarea>',
		'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
		'dateContainer' => 
			'<div class="form-group" {{type}}{{required}}">
					<div class="input-group date">{{content}}</div>
			</div>',
		'dateWidget' => '<input class="form-control" type="text" name="{{name}}"{{attrs}}>' 
		];
 ?>