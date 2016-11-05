/**
 * BBcode tag
 * 
 * @author: 	chiplove.9xpro <chiplove.9xpro@gmail.com>
 * @released: 	July 11, 2012
*/
CKEDITOR.plugins.add( 'buttonbbcode',
{
	init: function( editor )
	{
		var name = 'buttonbbcode';
		editor.addCommand(name, new CKEDITOR.dialogCommand(name));
		
		editor.ui.addButton(name,
		{
			label: 'Insert BBcode tag',
			command: name,
			icon: this.path + 'images/html.gif'
		});
		
		CKEDITOR.dialog.add(name, this.path + 'dialogs/'+name+'.js');
	}
});




