Ext.define('MemoryData', {
  	extend: 'Ext.data.Model',
  	fields: [
  		{name: 'memusage', type: 'number'},
  		{name: 'memidle', type: 'number'},
  		{name: 'memtotal', type: 'number'},
  	],
});

Ext.define('App.Monitoring.Dashboard.MemoryPanel', {
	requires: [
		'Ext.data.*',
		'Ext.panel.*',
	],
	
    	extend: 'Ext.panel.Panel',
    	alias: 'widget.dashboard-memorypanel',
    	border: false,
    	layout: 'fit',
    	
    	initComponent: function() {
    		this.items = [{
  			xtype: 'panel',
  			layout: 'border',
  			border: false,
  			defaults: {
  				split: true,
  			},
  			items: [{
  				region: 'north',
  				layout: 'fit',
  				border: false,
  				height: '34%',
  				items: [{
  					xtype: 'panel',
  					title: 'Total Memory',
  					html: '<table width="100%" height="100%"><tr><td align="center"><b><font size="5em">1234567</font></b></td></tr></table>a'
  				}]
  			}, {
  				region: 'center',
  				layout: 'fit',
  				border: false,
  				items: [{
  					xtype: 'panel',
  					title: 'Used Memory',
  					html: '<table width="100%" height="100%"><tr><td align="center"><b><font size="5em">1234567</font></b></td></tr></table>'
  				}]
  			}, {
  				region: 'south',
  				layout: 'fit',
  				border: false,
  				height: '34%',
  				items: [{
  					xtype: 'panel',
  					title: 'Free Memory',
  					html: '<table width="100%" height="100%"><tr><td align="center"><b><font size="5em">1234567</font></b></td></tr></table>'
  				}]
  			}]
   		}];
	   	
	   	this.callParent(arguments);
    	},
    	
    	setServerId: function(obj, serverid) {
    		//obj.cpustore.load({params: {serverid: serverid}});
    	},
});