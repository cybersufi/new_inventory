Ext.define('App.Monitoring.Diskusage', {
	requires: [
        'Ext.data.*',
        'Ext.container.Viewport',
        'Ext.layout.container.Border',
    	],
    
	init: function() {
        	Ext.QuickTips.init();
        	
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
				width: '15%',
				layout: 'fit',
				items: [{
					xtype: 'diskusage-serverlistpanel',
					border: false,
					id: 'diskusage-serverlist',
					listeners: {
						'navclick': function (grid, serverid) {
							this.syncNavigation(serverid);
						},
						scope: this,
					}
				}]
			}, {
				xtype: 'panel',
				id: 'content-panel',
				region: 'center',
				layout: 'border',
				border: false,
				defaults: {
					split: true,
				},
				items: [{
					region: 'center',
					layout: 'fit',
					items: [{
						xtype: 'diskusage-mplistpanel',
						border: false,
						id: 'diskusage-mplist',
						listeners: {
							'itmclick': function (grid, rec) {
								this.syncValue(rec);
							},
							scope: this,
						}
					}]
				}, {
					region: 'east',
					width: '35%',
					layout: 'fit',
					items: [{
						xtype: 'diskusage-usagepanel',
						border: false,
						id: 'diskusage-usagepanel'
					}]
				}, {
					region: 'south',
					height: '45%',
					layout: 'fit',
					items: [{
						xtype: 'diskusage-usagehistory',
						border: false,
						id: 'diskusage-historypanel'
					}]
				}]
			}]
		});
		
		Ext.getCmp('content-panel').getEl().mask();
		
	},
	
	syncNavigation: function(serverid) {
		Ext.getCmp('content-panel').getEl().unmask();
		var mplist = Ext.getCmp('diskusage-mplist'),
		    mpusage = Ext.getCmp('diskusage-usagepanel'),
		    mphistory = Ext.getCmp('diskusage-historypanel');
		mplist.setServerId(serverid);
		mpusage.setMpId(0);
		mphistory.setMpName(0,0);
	},
	
	syncValue: function(rec) {
		var mpid = rec.get('mpid'), 
		    mpusage = rec.get('mpusage'),
		    mpname = rec.get('mpname'),
		    serverid = rec.get('serverid'),
		    mpusage = Ext.getCmp('diskusage-usagepanel'),
		    mphistory = Ext.getCmp('diskusage-historypanel');
		    
	    mpusage.setMpId(mpid);
	    mphistory.setMpName(mpname, serverid);
	}
	
});