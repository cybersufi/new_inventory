Ext.define('App.Inventory.SiteAdmin.Mainpage', {
	requires: [
        'Ext.data.*',
        'Ext.container.Viewport',
        'Ext.layout.container.Border',
    	],
    
	init: function() {
		Ext.QuickTips.init();
        	
    	var header = document.getElementById('header').innerHTML;
    	var usname = document.getElementById('session-user').innerHTML;
        	
    	var tb = Ext.create('Ext.toolbar.Toolbar',{
			border: true,
			enableOverflow: true,
			items: [ new Ext.menu.TextItem({
				text: usname
			}),'->' , {
				text: '<b>Logout</b>',
				id: 'logout-button',
				iconCls: 'icon-logout',
				handler: this.doLogout,
				scope: this
			}, '-', {
				text: 'Refresh Content',
				id: 'refresh-button',
				iconCls: 'icon-refresh',
				handler: this.refreshContent,
				scope: this
			}]
		});
        	
    		Ext.create('Ext.container.Viewport', {
            	layout:'border',
            	renderTo: Ext.getBody(),
            	items:[{
				xtype: 'box',
				region:'north',
				id: 'app-header',
				html: header,
				height: 55
            	}, {
				region: 'center',
				layout: 'border',
				border: false,
				items: [{
					xtype: 'inventory-siteadmin-navigationtree',
					id: 'app-navtree',
					listeners: {
						'navclick': function (tree, nodeId) {
							this.syncNavigation(nodeId);
						},
						'load': function(store, node) {
							Ext.defer(this.syncNavigation, 100, this, [node.firstChild.data.id]);
						},
						scope: this,
					}
				}, {
					region: 'center',
					xtype: 'panel',
					id: 'app-contentpanel',
					//border: false,
					tbar: tb,
					layout: 'fit',
					items: [{
						xtype: 'simpleiframe',
						border: false,
						id: 'iframe-panel',
						autoScroll: true,
					}]
				}]
			}]
		});
	},
	
	doLogout: function() {
		Ext.MessageBox.show({
			title: 'Logout Confirmation Form',
			msg: 'Are you sure you want logout from this site?',
			icon: Ext.MessageBox.QUESTION,
			buttons: Ext.Msg.YESNO,
			fn: function(btn) {
				if (btn == 'yes') {
					window.location=site_url+'/login/doLogout';
				}
			},
			scope: this,
			animateTarget: 'logout-button'
		});
	},
	
	refreshContent: function() {
		var ifrm = Ext.getCmp('iframe-panel');
		ifrm.reload();
	},
	
	syncNavigation: function(navItemId) {
		var tree = Ext.getCmp('app-navtree'),
			//ifrm = document.getElementById('iframe-div'),
			ifrm = Ext.getCmp('iframe-panel');
		  	navType = navItemId.split('-')[0];
        
	   	var node = tree.getStore().getNodeById(navItemId);
	   	if (node) {
	       	tree.getSelectionModel().select(node);
	   	}
	   	
		if (navType == 'node') {
			var navId = navItemId.split('-')[1];
			if (navId == 'logout') {
	        		this.doLogout();
	        	} else {
				ifrm.setSrc(site_url + "/" + navId);
	        	}
		}
	}
});