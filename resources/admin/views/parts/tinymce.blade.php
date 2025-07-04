<script type="text/javascript" src="{{ URL::asset($asset_path.'js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
//--Tiny MCE
	tinymce.init({
		selector: "textarea.wysiwyg",
		theme: "modern",
		width: 600,
		height: 200,
		menubar: true,
		plugins: [
			"advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker",	//image print
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor"
		],
		//content_css: "css/content.css",
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image thumbnail | print preview media fullpage | forecolor backcolor emoticons",
		image_advtab: true ,
		convert_urls : false,
		relative_urls: false,
    	remove_script_host: false,

		style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		],

		external_filemanager_path:"{{ URL::asset('resources/admin/assets/filemanager')}}/",
		filemanager_title:"Responsive Filemanager" ,
		external_plugins: { "filemanager" : "{{ URL::asset('resources/admin/assets/filemanager/plugin.min.js') }}"}
	});
</script>
