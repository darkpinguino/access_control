<?php 
	return[
		'button' => '<button class="btn btn-primary" {{attrs}}>{{text}}</button>',
		'inputContainer' => '<div class="form-group" {{type}}{{required}}">{{content}}</div>',
		'formStart' => '<form role="form"{{attrs}}>',
		'input' => '<input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/>',
		'select' => '<select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select>',
		'textarea' => '<textarea class="form-control" name="{{name}}"{{attrs}}>{{value}}</textarea>',
		];
 ?>