/**
 * BBcode tag
 * 
 * @author: 	chiplove.9xpro <chiplove.9xpro@gmail.com>
 * @released: 	July 11, 2012
*/

CKEDITOR.dialog.add( 'buttonbbcode', function( api ) {	
	
	return {
		title : 'BBCode',
		minWidth : 390,
		minHeight : 200,
		contents : [
			{
				id: "info",
				name: 'info',
				label: 'Hello',
				
				elements :
				[
					{
						type : 'hbox',
						id: 'hbox',
						widths : ['50%', '50%' ],
						children :
						[
							{
								type : 'select',
								label: 'Choose a BBcode tag',
								id : 'bbcode',
								items :  [ 
									['<other>', ''], 
									['[CODE]', 'CODE'], 
									['[SPOILER]', 'SPOILER'],
									['[DOWNLOAD]', 'DOWNLOAD'] 
								] ,
								onChange: function(){
									var bbcode_other = this.getDialog().getContentElement('info','bbcode_other').getElement();
									if(this.getValue() == '') 
									{
										bbcode_other.show();
									}
									else
									{
										bbcode_other.hide();
									}
									
								},	
							},
							{
								type : 'text',
								label: 'Other',
								id : 'bbcode_other',
								onKeyup: function() {
									this.setValue(this.getValue().replace(new RegExp(/[^a-z]+/i), '').toUpperCase());
								}
							},

						]
					},
					{
						type : 	'text',
						label : 'Option of the tag.<br /><span>Example: [CODE="{option}"] your content [/CODE]</small>',
						id : 	'option',
					},
					{
						type : 'textarea',
						id : 'content',
						label : 'Content',
						rows : 4,
						cols : 40
					}
				]
			}
		],
		buttons : [ CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton ],
		onShow: function() 
		{
			var selected_text = api.getSelection().getSelectedText();
			var contentObj = this.setValueOf('info', 'content', selected_text);	
		},
		onOk : function() 
		{
			var content = this.getContentElement('info', 'content').getValue();
			var option = this.getContentElement('info', 'option').getValue();
			var bbcode = this.getContentElement('info', 'bbcode').getValue().toUpperCase();
			var bbcode_other = this.getContentElement('info', 'bbcode_other').getValue().toUpperCase();
			if(bbcode == '') 
			{
				bbcode = bbcode_other;
			}
			bbcode = bbcode.replace(new RegExp(/[^a-z]+/i), '');
			if(bbcode == '') 
			{
				alert('Please choose an BBcode tag or input a BBcode name');
				return false;
			}
			// build tag
			var html = '<p>[' + bbcode + (option != '' ? '="'+CKEDITOR.tools.trim(option)+'"' : '')  + ']</p>';
			if(content)
			{
				var lines = content.split("\n");
				for( i in lines)
				{
					if(CKEDITOR.tools.trim(lines[i]) != '')
					{
						html += '<p>' + lines[i].replace(/\s/g, '&nbsp;')+ '</p>';
					}
				}
			}
			html += '<p>[/' + bbcode + ']</p>';
			api.insertHtml(html);
		}
	};
});