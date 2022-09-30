(function ()
{
	// create colShortcodes plugin
	tinymce.create("tinymce.plugins.colShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("colPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "col_button" )
			{	
				var a = this;
					
				// adds the tinymce button
				btn = e.createMenuButton("col_button",
				{
					title: "Insert Shortcode",
					image: "../wp-content/themes/iter/tinymce/images/icon.png",
					icons: false
				});
				
				// adds the dropdown to the button
				btn.onRenderMenu.add(function (c, b)
				{					
					a.addWithPopup( b, "Columns", "columns" );
					a.addWithPopup( b, "Buttons", "button" );
					a.addWithPopup( b, "Alerts", "alert" );
					a.addWithPopup( b, "Toggle Content", "toggle" );
					a.addWithPopup( b, "Tabbed Content", "tabs" );
				});
				
				return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("colPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo: function () {
			return {
				longname: 'Col Shortcodes'
			}
		}
	});
	
	// add colShortcodes plugin
	tinymce.PluginManager.add("colShortcodes", tinymce.plugins.colShortcodes);
})();