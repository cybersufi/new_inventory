Ext.define('App.Monitoring.Diskusage', {
	requires: [
        'Ext.data.*',
        'Ext.container.Viewport',
        'Ext.layout.container.Border',
    	],
    
	init: function() {
        	Ext.QuickTips.init();
        	
        	var tb = Ext.create('Ext.toolbar.Toolbar',{
			border: true,
			enableOverflow: true,
			items: [ new Ext.menu.TextItem({
				text: 'usname'
			})]
		});
        	
        	Ext.create('Ext.Viewport', {
        		layout: {
        			type: 'border',
        			padding: 5
        		},
        		defaults: {
	            	split: true
	       	},
            	items:[{
				region: 'west',
				collapsible: true,
				title: 'Server List',
				width: '20%',
				html: 'blah',
			}, {
				region: 'center',
				layout: 'border',
				border: false,
				defaults: {
					split: true,
				},
				items: [{
					region: 'east',
					width: '30%',
					items: [{
						xtype: 'diskusage-usagepanel',
						border: false,
						id: 'diskusage-usagepanel'
					}]
				}, {
					region: 'south',
					height: '35%',
					html: 'blah'
				}]
			}]
		});
	},
});